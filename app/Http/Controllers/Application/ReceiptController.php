<?php

namespace App\Http\Controllers\Application;

use App\Models\Receipt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mails\InvoiceToCustomer;
use App\Models\Driver;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\PaymentMethod;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\Trackinginfo;
use App\Models\PettyCash;
use App\Models\Site;
use App\Models\Company;
use App\Models\issue;
use App\Models\PlateNumber;
use App\Http\Requests\Application\Invoice\Store;
use App\Http\Requests\Application\Invoice\Update;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\DB;
use Auth;
use PDF;
use File;
use App;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        $receipts = Receipt::all();
    
        if(Auth::user()->roles =="superadmin"){
        // Query Invoices by Company and Tab
        if($request->tab == 'cash') {
            $query = Invoice::findByCompany($currentCompany->id)->whereNull('client_id')->latest('updated_at');
            // $query = Invoice::findByCompany($currentCompany->id)->latest('updated_at');
            $tab = 'cash';
        } else if($request->tab == 'contract') {
            // $query = Invoice::findByCompany($currentCompany->id)->whereNotNull('client_id')->where('paid_status','UNPAID')->orderBy('created_at', 'desc');
            $query = Invoice::findByCompany($currentCompany->id)->whereNotNull('client_id')->latest('updated_at');
            $tab = 'contract';
        } else {
            $query = Invoice::findByCompany($currentCompany->id)->latest('updated_at');
            $tab = 'all';
        }

        }elseif(Auth::user()->roles =="admin_company"){
            if($request->tab == 'cash') {
                $query = Invoice::findByCompany($currentCompany->id)->whereNull('client_id')->latest('updated_at');
                // $query = Invoice::findByCompany($currentCompany->id)->latest('updated_at');
                $tab = 'cash';
            } else if($request->tab == 'contract') {
                // $query = Invoice::findByCompany($currentCompany->id)->whereNotNull('client_id')->where('paid_status','UNPAID')->orderBy('created_at', 'desc');
                $query = Invoice::findByCompany($currentCompany->id)->whereNotNull('client_id')->latest('updated_at');
                $tab = 'contract';
            } else {
                $query = Invoice::findByCompany($currentCompany->id)->latest('updated_at');
                $tab = 'all';
            }
        }else {

            if($request->tab == 'cash') {
                $query = Invoice::findByCompany($currentCompany->id)->findBySite($currentSites)->whereNull('client_id')->latest('updated_at');
                // $query = Invoice::findByCompany($currentCompany->id)->latest('updated_at');
                $tab = 'cash';
            } else if($request->tab == 'contract') {
                // $query = Invoice::findByCompany($currentCompany->id)->whereNotNull('client_id')->where('paid_status','UNPAID')->orderBy('created_at', 'desc');
                $query = Invoice::findByCompany($currentCompany->id)->findBySite($currentSites)->whereNotNull('client_id')->latest('updated_at');
                $tab = 'contract';
            } else {
                $query = Invoice::findByCompany($currentCompany->id)->findBySite($currentSites)->latest('updated_at');
                $tab = 'all';
            }
        }
        // Apply Filters and Paginate
        $invoices = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::partial('invoice_number'),
                AllowedFilter::partial('do_number'),
                AllowedFilter::partial('receipt_number'),
                AllowedFilter::partial('invoice_date'),
                AllowedFilter::partial('paid_status'),
                AllowedFilter::partial('drivers.name'),
                AllowedFilter::partial('platenumbers.number_plate'),
                AllowedFilter::partial('clients.company_name'),
                AllowedFilter::partial('status'),
            ])
            ->paginate(10)
            ->appends(request()->query());
    
        return view('application.receipts.index', [
            'invoices' => $invoices,
            'tab' => $tab,
            'receipts' => $receipts,
        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    { 
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;
        
        if(Auth::user()->roles =="superadmin"){

            $client = Client::all();
            $payment_type = PaymentMethod::all();
            $payment_status = PaymentStatus::all();
            // $invoices =   Invoice::where('status', 'COMPLETED')->where('client_id', $request->id)->get();
            $month_year = DB::table('invoices')
            ->select(DB::raw('YEAR(created_at) as year'))
            ->distinct()
            ->get();

        }elseif(Auth::user()->roles =="admin_company"){
            $sites_id = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $client = Client::whereIn('sites_id', $sites_id)->get();
            $payment_type = PaymentMethod::all();
            $payment_status = PaymentStatus::all();
            // $invoices =   Invoice::where('status', 'COMPLETED')->where('client_id', $request->id)->get();
            $month_year = DB::table('invoices')
            ->select(DB::raw('YEAR(created_at) as year'))
            ->whereIn('sites_id', $sites_id)
            ->distinct()
            ->get();

        }else {

            $client = Client::where('sites_id', $currentSites)->get();
            $payment_type = PaymentMethod::all();
            $payment_status = PaymentStatus::all();
            // $invoices =   Invoice::where('status', 'COMPLETED')->where('client_id', $request->id)->get();
            $month_year = DB::table('invoices')
            ->select(DB::raw('YEAR(created_at) as year'))
            ->where('sites_id', $currentSites)
            ->distinct()
            ->get();
        }


        $invoices =  '';
        return view('application.receipts.create', [
            'client' => $client,
            'payment_type' => $payment_type,
            'invoices' => $invoices,
            'payment_status' => $payment_status,
            'month_year' => $month_year,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }

        foreach($request->ids as $id => $value){
            $invoice = Invoice::findOrFail($id);
            //$sites_id = $invoice->$sites_id;
            $sites_id = ($invoice->sites_id);
        }

        if($request->payment_status == 2) //partial payment
        {
            //dd('2');
            $request->validate([
                'total_amount_pay' => 'required|numeric|same:total',
                'amount' => 'required|numeric|not_in:0',
                'payment_number' => 'required',
                'payment_method_id' => 'required',
                'payment_status' => 'required',
                'blance' => 'required|min:0|not_in:0',
            ]);

            $count = Receipt::count();
            if($count > 0){
                $rec_no = Receipt::latest()->first()->id;
                $date =date("dmY");
                $invoice_number = sprintf('%06d', intval($rec_no) + 1);
                $rc_number = "REC-CT-".$date.'/'.$invoice_number;
            }else{
                $rec_no = 0;
                $date =date("dmY");
                $invoice_number = sprintf('%06d', intval($rec_no) + 1);
                $rc_number = "REC-CT-".$date.'/'.$invoice_number;
            }

            foreach($request->ids as $id => $value){
                $invoice = Invoice::findOrFail($id);

    
                   $invoices = DB::table('invoices')
                   ->where('id', $id)
                   ->update([
                       'receipt_number' => $rc_number,
                       'paid_status' => Invoice::STATUS_PAID,
                       'payment_status_id' => $request->payment_status,
                       'discount' => $request->discount*100,
                       'updated_at' => date('Y-m-d H:i:s'),
                       ]);

                $count_rec = Receipt::where('invoice_id', $id)->count();

                if($count_rec > 0){
                    $last_record = Receipt::where('invoice_id', $id)->latest()->first();

                   // $last_record_rec = Receipt::where('reference_number', $last_record->reference_number)->get();
    
                  // dd($last_record);
                    
                    // foreach($last_record as $record_data)
                    // {
                        //dd('here1');
                        $date =date("dmYhis");
                        $receipt = new Receipt;
                        $receipt->invoice_id = $last_record->invoice_id;
                        $receipt->receipt_number = $rc_number;
                        $receipt->sites_id = $sites_id;
                        $receipt->reference_number = $date;
                        if($last_record->balance != 0 || $last_record->balance != NULL){
                           // dd('take blance');
                            $receipt->total = $last_record->balance;  //ambil balance utk display $record_data->total;
                        }else{
                           // dd($record_data->invoice_id.'take total');
                            $receipt->total = $invoice->total;
                        }
                        
                        $receipt->supposed_amount = $request->total*100;
                        $receipt->balance = $request->blance*100;
                        $receipt->discount = $request->discount*100;
                        $receipt->paid_amount = $request->amount;
                        if($last_record->last_paid_amount != NULL){
                            $receipt->last_paid_amount = $last_record->last_paid_amount.','.$last_record->paid_amount;
                            
                        }else{
                            $receipt->last_paid_amount = $last_record->paid_amount;
                        }
                        $receipt->last_paid_amount = $last_record->paid_amount;
                        $receipt->payment_number = $request->payment_number;
                        $receipt->payment_status = $request->payment_status;
                        $receipt->receipt_status = "PAID";
                        $receipt->payment_method_id = $request->payment_method_id;
                        $receipt->payment_date = $request->payment_date;
                        $receipt->save();
                   // }

                }else{

                    //dd('here2');
                    $date =date("dmYhis");
                    $receipt = new Receipt;
                    $receipt->invoice_id = $id;
                    $receipt->receipt_number = $rc_number;
                    $receipt->sites_id = $sites_id;
                    $receipt->reference_number = $date;
                    $receipt->total = $invoice->total;
                    $receipt->supposed_amount = $request->total*100;
                    $receipt->balance = $request->blance*100;
                    $receipt->discount = $request->discount*100;
                    $receipt->paid_amount = $request->amount;
                    $receipt->payment_number = $request->payment_number;
                    $receipt->payment_status = $request->payment_status;
                    $receipt->receipt_status = "PAID";
                    $receipt->payment_method_id = $request->payment_method_id;
                    $receipt->payment_date = $request->payment_date;
                    $receipt->save();
                }

                $payment = new Payment;
                $payment->payment_date = $request->payment_date;
                $payment->sites_id = $sites_id;
                $payment->payment_number = $request->payment_number;
                $payment->client_id =$invoice->client_id;
                $payment->amount = $request->amount;
                //$payment->blance = $request->blance*100;
                $payment->discount = $request->discount*100;
                $payment->payment_status = $request->payment_status;
                $payment->invoice_id = $id;
                $payment->payment_method_id = $request->payment_method_id;
                $payment->save();
    
                $trackinginfo = new Trackinginfo;
                $trackinginfo->invoice_id = $id;
                $trackinginfo->activities = "Receipt Number";
                $trackinginfo->remark = $rc_number;
                $trackinginfo->save();
                
             }
                $invoices = DB::table('invoices')
                ->where('id', $id)
                ->update([
                    'paid_status' => Invoice::STATUS_PARTIALLY_PAID,
                    'payment_status_id' => $request->payment_status,
                    'blance' => $request->blance*100,
                    'updated_at' => date('Y-m-d H:i:s'),
                    ]);

                $receipts = DB::table('receipts')
                ->where('invoice_id', $id)
                ->update([
                    'receipt_status' => 'PARTIALLY PAID',
                    ]);

                    if($request->payment_method_id == 1){
    
                        $last_balance = PettyCash::where('sites_id', $sites_id)->latest()->first();
                        if(empty($last_balance)){
                            $balance = 0;
                        }else{
                            $balance = $last_balance->balance;
                        }
                        $pettyCash = new PettyCash;
                        $pettyCash->detail = "Sales Contract($rc_number)";
                        $pettyCash->sites_id = $sites_id;
                        $pettyCash->date = date("Y-m-d");
                        $pettyCash->time = date("h:i:s");
                        $pettyCash->debit = $request->amount;
                        $pettyCash->balance = $balance+$request->amount;
                        $pettyCash->save();
            
                    }
    
        }elseif($request->payment_status == 3){ //discount
            //dd("3");
            $request->validate([
                //'total_amount' => 'required|numeric|gte:total',
                'total_pay' => 'required|numeric|same:total',
                'payment_number' => 'required',
                'payment_method_id' => 'required',
                'payment_status' => 'required',
                'discount' => 'required|min:0|not_in:0',
            ]);

            $count = Receipt::count();
            if($count > 0){
                $rec_no = Receipt::latest()->first()->id;
                $date =date("dmY");
                $invoice_number = sprintf('%06d', intval($rec_no) + 1);
                $rc_number = "REC-CT-".$date.'/'.$invoice_number;
            }else{
                $rec_no = 0;
                $date =date("dmY");
                $invoice_number = sprintf('%06d', intval($rec_no) + 1);
                $rc_number = "REC-CT-".$date.'/'.$invoice_number;
            }

            foreach($request->ids as $id => $value){
                $invoice = Invoice::findOrFail($id);
                // $invoice_num = explode("/", $invoice->invoice_number);
                // $invoice_number = $invoice_num[1];
                //$invoice_num = preg_replace("/[^\d]/", "", $invoice_number);
                //$rc_number = "REC-CT-".$date.'/'.$invoice_number;
                //dd($rc_number);
    
                   $invoices = DB::table('invoices')
                   ->where('id', $id)
                   ->update([
                       'receipt_number' => $rc_number,
                       'paid_status' => Invoice::STATUS_PAID,
                       'payment_status_id' => $request->payment_status,
                       'discount' => $request->discount*100,
                       'updated_at' => date('Y-m-d H:i:s'),
                       ]);
    
                    //dd('here2');
                    $date =date("dmYhis");
                    $receipt = new Receipt;
                    $receipt->invoice_id = $id;
                    $receipt->receipt_number = $rc_number;
                    $receipt->sites_id = $sites_id;
                    $receipt->reference_number = $date;
                    $receipt->total = $value;
                    $receipt->supposed_amount = $request->total*100;
                    $receipt->balance = $request->blance*100;
                    $receipt->discount = $request->discount*100;
                    $receipt->paid_amount = $request->amount;
                    $receipt->payment_number = $request->payment_number;
                    $receipt->payment_status = $request->payment_status;
                    $receipt->receipt_status = "PAID";
                    $receipt->payment_method_id = $request->payment_method_id;
                    $receipt->payment_date = $request->payment_date;
                    $receipt->save();
    
                $payment = new Payment;
                $payment->payment_date = $request->payment_date;
                $payment->sites_id = $sites_id;
                $payment->payment_number = $request->payment_number;
                $payment->client_id =$invoice->client_id;
                $payment->amount = $request->amount;
                //$payment->blance = $request->blance*100;
                $payment->discount = $request->discount*100;
                $payment->payment_status = $request->payment_status;
                $payment->invoice_id = $id;
                $payment->payment_method_id = $request->payment_method_id;
                $payment->save();
    
                $trackinginfo = new Trackinginfo;
                $trackinginfo->invoice_id = $id;
                $trackinginfo->activities = "Receipt Number";
                $trackinginfo->remark = $rc_number;
                $trackinginfo->save();
                
             }

             if($request->payment_method_id == 1){
    
                $last_balance = PettyCash::where('sites_id', $sites_id)->latest()->first();
                if(empty($last_balance)){
                    $balance = 0;
                }else{
                    $balance = $last_balance->balance;
                }
                $pettyCash = new PettyCash;
                $pettyCash->detail = "Sales Contract($rc_number)";
                $pettyCash->sites_id = $sites_id;
                $pettyCash->date = date("Y-m-d");
                $pettyCash->time = date("h:i:s");
                $pettyCash->debit = $request->amount;
                $pettyCash->balance = $balance+$request->amount;
                $pettyCash->save();
    
                }

        }else{ 
            //dd("1");
            $request->validate([
                //'total_amount' => 'required|numeric|gte:total',
                //'total_amount' => 'required|numeric|same:total',
                'payment_number' => 'required',
                'payment_method_id' => 'required',
                'payment_status' => 'required',
            ]);

            $count = Receipt::count();
            if($count > 0){
                $rec_no = Receipt::latest()->first()->id;
                $date =date("dmY");
                $invoice_number = sprintf('%06d', intval($rec_no) + 1);
                $rc_number = "REC-CT-".$date.'/'.$invoice_number;
            }else{
                $rec_no = 0;
                $date =date("dmY");
                $invoice_number = sprintf('%06d', intval($rec_no) + 1);
                $rc_number = "REC-CT-".$date.'/'.$invoice_number;
            }

          
            foreach($request->ids as $id => $value){
                $invoice = Invoice::findOrFail($id);
                // $invoice_num = explode("/", $invoice->invoice_number);
                // $invoice_number = $invoice_num[1];
                //$invoice_num = preg_replace("/[^\d]/", "", $invoice_number);
                //$rc_number = "REC-CT-".$date.'/'.$invoice_number;
                //dd($rc_number);
    
                   $invoices = DB::table('invoices')
                   ->where('id', $id)
                   ->update([
                       'receipt_number' => $rc_number,
                       'paid_status' => Invoice::STATUS_PAID,
                       'payment_status_id' => $request->payment_status,
                       'discount' => $request->discount*100,
                       'updated_at' => date('Y-m-d H:i:s'),
                       ]);

                    //dd('here2');
                    $date =date("dmYhis");
                    $receipt = new Receipt;
                    $receipt->invoice_id = $id;
                    $receipt->receipt_number = $rc_number;
                    $receipt->sites_id = $sites_id;
                    $receipt->reference_number = $date;
                    $receipt->total = $value;
                    $receipt->supposed_amount = $request->total*100;
                    $receipt->balance = $request->blance*100;
                    $receipt->discount = $request->discount*100;
                    $receipt->paid_amount = $request->total*100;
                    $receipt->payment_number = $request->payment_number;
                    $receipt->payment_status = $request->payment_status;
                    $receipt->receipt_status = "PAID";
                    $receipt->payment_method_id = $request->payment_method_id;
                    $receipt->payment_date = $request->payment_date;
                    $receipt->save();
    
                $payment = new Payment;
                $payment->payment_date = $request->payment_date;
                $payment->sites_id = $sites_id;
                $payment->payment_number = $request->payment_number;
                $payment->client_id =$invoice->client_id;
                $payment->amount = $request->total*100;
                //$payment->blance = $request->blance*100;
                $payment->discount = $request->discount*100;
                $payment->payment_status = $request->payment_status;
                $payment->invoice_id = $id;
                $payment->payment_method_id = $request->payment_method_id;
                $payment->save();
    
                $trackinginfo = new Trackinginfo;
                $trackinginfo->invoice_id = $id;
                $trackinginfo->activities = "Receipt Number";
                $trackinginfo->remark = $rc_number;
                $trackinginfo->save();
                
            }

             if($request->payment_method_id == 1){
    
                $last_balance = PettyCash::where('sites_id', $sites_id)->latest()->first();
                if(empty($last_balance)){
                    $balance = 0;
                }else{
                    $balance = $last_balance->balance;
                }
                $pettyCash = new PettyCash;
                $pettyCash->detail = "Sales Contract($rc_number)";
                $pettyCash->sites_id = $sites_id;
                $pettyCash->date = date("Y-m-d");
                $pettyCash->time = date("h:i:s");
                $pettyCash->debit = $request->total*100;
                $pettyCash->balance = $balance+$request->total*100;
                $pettyCash->save();
    
                }

        }

        
        session()->flash('alert-success', __('messages.invoice_added'));
        return redirect()->route('receipts', $invoice->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt,$id,$refrence)
    {
        //dd($id);
        $rec = Receipt::where('reference_number', $refrence)->latest('id')->first();

        $rec_id = Receipt::where('invoice_id', $id)->latest('id')->first();

        // dd($rec_id->invoice_id);

        return view('application.receipts.details', [
            'rec' => $rec,
            'rec_id' => $rec_id->invoice_id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
    }

    public function filterbyclient(Request $request)
    {
        //dd($request->contractname);
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if(Auth::user()->roles =="superadmin"){

            $client = Client::all();
            $payment_type = PaymentMethod::all();
            $payment_status = PaymentStatus::all();
            $invoices =  Invoice::where('client_id', $request->contractname)->where('paid_status', '!=','PAID')->where('status', 'COMPLETED')->get();
            $month_year = DB::table('invoices')
            ->select(DB::raw('YEAR(created_at) as year'))
            ->where('sites_id', $currentSites)
            ->distinct()
            ->get();

        }elseif(Auth::user()->roles =="admin_company"){
            $sites_id = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $client = Client::whereIn('sites_id', $sites_id)->get();
            $payment_type = PaymentMethod::all();
            $payment_status = PaymentStatus::all();
            $invoices =  Invoice::findByCompany($currentCompany->id)->where('client_id', $request->contractname)->where('paid_status', '!=','PAID')->where('status', 'COMPLETED')->get();
            $month_year = DB::table('invoices')
            ->select(DB::raw('YEAR(created_at) as year'))
            ->where('sites_id', $currentSites)
            ->distinct()
            ->get();

        }else {
            
            $client = Client::where('sites_id', $currentSites)->get();
            $payment_type = PaymentMethod::all();
            $payment_status = PaymentStatus::all();
            $invoices =  Invoice::findBySite($currentSites)->where('client_id', $request->contractname)->where('paid_status', '!=','PAID')->where('status', 'COMPLETED')->get();
            $month_year = DB::table('invoices')
            ->select(DB::raw('YEAR(created_at) as year'))
            ->where('sites_id', $currentSites)
            ->distinct()
            ->get();
        }


        return view('application.receipts.create', [
            'client' => $client,
            'payment_type' => $payment_type,
            'invoices' => $invoices,
            'payment_status' => $payment_status,
            'month_year' => $month_year,
        ]);
        
    
    }

    public function report(Request $request)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }        
        $request->validate([
            'month' => 'required',
            'year' => 'required',
            'contractname' => 'required',

        ]);

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if(Auth::user()->roles =="superadmin"){

            $client = Client::where('id', $request->contractname)->first();
            $sites = Site::where('id', $client->sites_id)->first();
            $companys = Company::where('id',$sites->company_id)->first();
            $payment_type = PaymentMethod::all();
            $payment_status = PaymentStatus::all();
            $product = Product::where('client_id', $request->contractname)->get();
    
            $data =  Invoice::where('client_id', $request->contractname)->where('status', 'COMPLETED')->whereYear('created_at', '=', $request->year)->whereMonth('created_at', '=', $request->month)->get()->groupBy(function($item) {
            return $item->invoice_date->format('Y-m-d');
            });
    
    
            $paid_amount = Invoice::where('client_id', $request->contractname)->whereYear('created_at', '=', $request->year)->whereMonth('created_at', '=', $request->month)->where('status', 'COMPLETED')->where('paid_status', 'PAID')->sum('total');
            $outstanding = Invoice::where('client_id', $request->contractname)->whereYear('created_at', '=', $request->year)->whereMonth('created_at', '=', $request->month)->where('status', 'COMPLETED')->where('paid_status', 'PARTIALLY PAID')->sum('blance');
    
            $total_by_product = Invoice::select(DB::raw('SUM(invoice_items.quantity) As total_mt'),'products.name')
            ->leftJoin('invoice_items', 'invoice_items.invoice_id', '=', 'invoices.id')
            ->leftJoin('products', 'products.id', '=', 'invoice_items.product_id')
            ->where('invoices.client_id', '=', $request->contractname)
            ->whereYear('invoices.created_at', '=', $request->year)->whereMonth('invoices.created_at', '=', $request->month)
            ->groupBy('invoice_items.product_id')
            ->get();
    
            $total_mt = 0;
            $total_price = 0;
            foreach($data as $dat)
            {
                foreach ($dat as $databydate) 
                {
                    foreach ($databydate->items as $da) 
                    {
                        $total_mt += sprintf('%0.3f', $da->quantity);
                        $total_price += $da->total/100;
                    }
                }
            }

        }else{
        
        $client = Client::where('sites_id', $currentSites)->where('id', $request->contractname)->first();
        $sites = Site::where('id', $client->sites_id)->first();
        $companys = Company::where('id',$sites->company_id)->first();
        $payment_type = PaymentMethod::all();
        $payment_status = PaymentStatus::all();
        $product = Product::where('sites_id', $currentSites)->where('client_id', $request->contractname)->get();

        $data =  Invoice::where('sites_id', $currentSites)->where('client_id', $request->contractname)->where('status', 'COMPLETED')->whereYear('created_at', '=', $request->year)->whereMonth('created_at', '=', $request->month)->get()->groupBy(function($item) {
        return $item->invoice_date->format('Y-m-d');
        });


        $paid_amount = Invoice::findBySite($currentSites)->where('client_id', $request->contractname)->whereYear('created_at', '=', $request->year)->whereMonth('created_at', '=', $request->month)->where('status', 'COMPLETED')->where('paid_status', 'PAID')->sum('total');
        $outstanding = Invoice::findBySite($currentSites)->where('client_id', $request->contractname)->whereYear('created_at', '=', $request->year)->whereMonth('created_at', '=', $request->month)->where('status', 'COMPLETED')->where('paid_status', 'PARTIALLY PAID')->sum('blance');

        $total_by_product = Invoice::select(DB::raw('SUM(invoice_items.quantity) As total_mt'),'products.name')
        ->leftJoin('invoice_items', 'invoice_items.invoice_id', '=', 'invoices.id')
        ->leftJoin('products', 'products.id', '=', 'invoice_items.product_id')
        ->where('invoices.client_id', '=', $request->contractname)
        ->where('invoices.sites_id', '=', $currentSites)
        ->whereYear('invoices.created_at', '=', $request->year)->whereMonth('invoices.created_at', '=', $request->month)
        ->groupBy('invoice_items.product_id')
        ->get();

        $total_mt = 0;
        $total_price = 0;
        foreach($data as $dat)
        {
            foreach ($dat as $databydate) 
            {
                foreach ($databydate->items as $da) 
                {
                    $total_mt += sprintf('%0.3f', $da->quantity);
                    $total_price += $da->total/100;
                }
            }
        }
        }
        set_time_limit(300000); // Extends to 5 minutes.
        $pdf = PDF::loadView('application.receipts.report', ['data' => $data, 'companys' => $companys, 'client' => $client, 'product' => $product,'total_mt' => $total_mt, 'total_price' => $total_price,'currentCompany' => $currentCompany,'total_by_product' => $total_by_product,'paid_amount' => $paid_amount, 'outstanding' => $outstanding]);
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setpaper('A4', 'Landscape');
        return $pdf->download('report.pdf');

    }

    public function filterbyclient1(Request $request,$id)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if(Auth::user()->roles =="superadmin"){
            $data['client'] = Client::all();
            $data['payment_type'] = PaymentMethod::all();
            $data['invoices'] =  Invoice::where('paid_status', 'UNPAID')->orWhere('paid_status', 'PARTIALLY_PAID')->where('client_id', $id)->get();

        }elseif(Auth::user()->roles =="admin_company"){
            $sites_id = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $data['client'] = Client::whereIn('sites_id', $sites_id)->get();
            $data['payment_type'] = PaymentMethod::all();
            $data['invoices'] =  Invoice::findByCompany($currentCompany->id)->where('paid_status', 'UNPAID')->orWhere('paid_status', 'PARTIALLY_PAID')->where('client_id', $id)->get();

        }else {
            $data['client'] = Client::where('sites_id', $currentSites)->get();
            $data['payment_type'] = PaymentMethod::all();
            $data['invoices'] =  Invoice::findBySite($currentSites)->where('paid_status', 'UNPAID')->orWhere('paid_status', 'PARTIALLY_PAID')->where('client_id', $id)->get();
        }

        return redirect()->route('application.receipts.create', $data);
    
    }
}
