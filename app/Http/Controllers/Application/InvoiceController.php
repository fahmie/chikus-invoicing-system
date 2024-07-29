<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Mails\InvoiceToCustomer;
use App\Models\Driver;
use App\Models\Lorry;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\PaymentMethod;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\Trackinginfo;
use App\Models\PettyCash;
use App\Models\issue;
use App\Models\PlateNumber;
use App\Models\Receipt;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Invoice\Store;
use App\Http\Requests\Application\Invoice\Update;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\DB;
use App\Models\Transporter;
use App\Models\TransporterLocation;
use Auth;

class InvoiceController extends Controller
{
    /**
     * Display Invoices Page
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if (!Auth::user()->can('invoices-view')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;
        
        // Query Invoices by Company and Tab
        if(Auth::user()->roles =="superadmin")
        {
            $sites = Site::all();
            if($request->tab == 'all') {
                // $query = Invoice::findByCompany($currentCompany->id)->where('paid_status', 'PAID')->latest('updated_at');
                $query = Invoice::where('paid_status', 'PAID')->latest('updated_at', 'DESC');
                $tab = 'all';
            } else{
                // $query = Invoice::findByCompany($currentCompany->id)->where('paid_status', '!=','PAID')->latest('updated_at');
                $query = Invoice::where('paid_status', '!=','PAID')->latest('updated_at', 'DESC');
                $tab = 'due';
            }

        }elseif(Auth::user()->roles =="admin_company"){
            $sites = Site::where('company_id', $currentCompany->id)->get();
            if($request->tab == 'all') {
                // $query = Invoice::findByCompany($currentCompany->id)->where('paid_status', 'PAID')->latest('updated_at');
                $query = Invoice::findByCompany($currentCompany->id)->where('paid_status', 'PAID')->latest('updated_at', 'DESC');
                $tab = 'all';
            } else{
                // $query = Invoice::findByCompany($currentCompany->id)->where('paid_status', '!=','PAID')->latest('updated_at');
                $query = Invoice::findByCompany($currentCompany->id)->where('paid_status', '!=','PAID')->latest('updated_at', 'DESC');
                $tab = 'due';
            }
        }else {
            $sites = Site::where('id',$currentSites)->get();
            if($request->tab == 'all') {
                // $query = Invoice::findByCompany($currentCompany->id)->where('paid_status', 'PAID')->latest('updated_at');
                $query = Invoice::findByCompany($currentCompany->id)->findBySite($currentSites)->where('paid_status', 'PAID')->latest('updated_at', 'DESC');
                $tab = 'all';
            } else{
                // $query = Invoice::findByCompany($currentCompany->id)->where('paid_status', '!=','PAID')->latest('updated_at');
                $query = Invoice::findByCompany($currentCompany->id)->findBySite($currentSites)->where('paid_status', '!=','PAID')->latest('updated_at', 'DESC');
                $tab = 'due';
            }
        }
        

        // Apply Filters and Paginate
        $invoices = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::partial('invoice_number'),
                AllowedFilter::partial('invoice_date'),
                AllowedFilter::partial('paid_status'),
                AllowedFilter::partial('drivers.name'),
                AllowedFilter::partial('platenumbers.number_plate'),
                AllowedFilter::partial('clients.company_name'),
                AllowedFilter::partial('status'),

            ])
            ->paginate(10)
            ->appends(request()->query());


        return view('application.invoices.index', [
            'invoices' => $invoices,
            'tab' => $tab,
            'sites' => $sites,
        ]);
    }


    public function indexdo(Request $request)
    {
        if (!Auth::user()->can('delivery-order-view')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;
        // Query Invoices by Company and Tab
        if(Auth::user()->roles =="superadmin"){
            if($request->tab == 'all') {
                $query = Invoice::where('status', 'COMPLETED')->latest('updated_at');
                $tab = 'all';
            } else{
                $query = Invoice::where('status', 'OTW')->latest('updated_at');
                $tab = 'due';
            }
        }elseif(Auth::user()->roles =="admin_company"){
            if($request->tab == 'all') {
                $query = Invoice::findByCompany($currentCompany->id)->where('status', 'COMPLETED')->latest('updated_at');
                $tab = 'all';
            } else{
                $query = Invoice::findByCompany($currentCompany->id)->where('status', 'OTW')->latest('updated_at');
                $tab = 'due';
            }
        }else {
            if($request->tab == 'all') {
                $query = Invoice::findByCompany($currentCompany->id)->findBySite($currentSites)->where('status', 'COMPLETED')->latest('updated_at');
                $tab = 'all';
            } else{
                $query = Invoice::findByCompany($currentCompany->id)->findBySite($currentSites)->where('status', 'OTW')->latest('updated_at');
                $tab = 'due';
            }
        }

        // Apply Filters and Paginate
        $invoices = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::partial('invoice_number'),
                AllowedFilter::partial('accurate'),
                AllowedFilter::partial('items.quantity'),
                AllowedFilter::partial('invoice_date'),
                AllowedFilter::partial('updated_at'),
                AllowedFilter::partial('accurate_remark'),
                AllowedFilter::partial('do_number'),
                AllowedFilter::partial('drivers.name'),
                AllowedFilter::partial('platenumbers.number_plate'),
                AllowedFilter::partial('clients.company_name'),
            ])
            ->paginate(10)
            ->appends(request()->query());

        return view('application.invoices.indexdo', [
            'invoices' => $invoices,
            'tab' => $tab,
        ]);
    }

    public function indexreceipt(Request $request)
    {
        if (!Auth::user()->can('receipts-view')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if(Auth::user()->roles =="superadmin"){
        // Query Invoices by Company and Tab
        if($request->tab == 'all') {
            $query = Invoice::findByCompany($currentCompany->id)->orderBy('created_at', 'desc');
            $tab = 'all';
        } else if($request->tab == 'contract') {
            // $query = Invoice::findByCompany($currentCompany->id)->whereNotNull('client_id')->where('paid_status','UNPAID')->orderBy('created_at', 'desc');
            $query = Invoice::findByCompany($currentCompany->id)->whereNotNull('client_id')->latest('updated_at');
            $tab = 'contract';
        } else {
            $query = Invoice::findByCompany($currentCompany->id)->whereNull('client_id')->latest('updated_at');
            $tab = 'cash';
        }

        }elseif(Auth::user()->roles =="admin_company"){
            if($request->tab == 'all') {
                $query = Invoice::findByCompany($currentCompany->id)->orderBy('created_at', 'desc');
                $tab = 'all';
            } else if($request->tab == 'contract') {
                // $query = Invoice::findByCompany($currentCompany->id)->whereNotNull('client_id')->where('paid_status','UNPAID')->orderBy('created_at', 'desc');
                $query = Invoice::findByCompany($currentCompany->id)->whereNotNull('client_id')->latest('updated_at');
                $tab = 'contract';
            } else {
                $query = Invoice::findByCompany($currentCompany->id)->whereNull('client_id')->latest('updated_at');
                $tab = 'cash';
            }
        }else {

            if($request->tab == 'all') {
                $query = Invoice::findByCompany($currentCompany->id)->findBySite($currentSites)->orderBy('created_at', 'desc');
                $tab = 'all';
            } else if($request->tab == 'contract') {
                // $query = Invoice::findByCompany($currentCompany->id)->whereNotNull('client_id')->where('paid_status','UNPAID')->orderBy('created_at', 'desc');
                $query = Invoice::findByCompany($currentCompany->id)->findBySite($currentSites)->whereNotNull('client_id')->latest('updated_at');
                $tab = 'contract';
            } else {
                $query = Invoice::findByCompany($currentCompany->id)->findBySite($currentSites)->whereNull('client_id')->latest('updated_at');
                $tab = 'cash';
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

        return view('application.invoices.indexreceipts', [
            'invoices' => $invoices,
            'tab' => $tab,
        ]);
    }
    /**
     * Display the Form for Creating New Invoice
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id=NULL) //create invoice for contract
    {
        //dd($id);
        if (!Auth::user()->can('invoices-create')) {
            abort(403);
        }
        if(Auth::user()->roles =="superadmin"){
            $user = $request->user();
            $currentCompany = $user->currentCompany();
            $currentSites = $id;

        }elseif(Auth::user()->roles =="admin_company"){
            $user = $request->user();
            $currentCompany = $user->currentCompany();
            $currentSites = $id;
        }else {
            $user = $request->user();
            $currentCompany = $user->currentCompany();
            $currentSites = $user->sites_id;
        }

        $active_driver = Invoice::where('status', 'OTW')->where('sites_id',$currentSites)->get();
        $active[] = array();
        foreach($active_driver as $data){
            $active[] = $data->driver_id;
        }
       // dd($currentSites);
        $active1 = array_filter($active);
        // dd($active1);

        $client = Client::where('sites_id',$currentSites)->get();
        $drivers = Driver::where('sites_id',$currentSites)->get();
        $products = Product::where('sites_id',$currentSites)->get();
        $transporter = Transporter::where('sites_id',$currentSites)->get();
    

        // Get next Invoice number if the auto generation option is enabled
        $invoice_prefix = $currentCompany->getSetting('invoice_prefix');
        $next_invoice_number = Invoice::getNextInvoiceNumber($invoice_prefix,$currentSites);

        // Create new number model and set invoice_number and company_id
        // so that we can use them in the form
        $invoice = new Invoice();
        $invoice->invoice_number = $next_invoice_number;
        $invoice->company_id = $currentCompany->id;

        // Also for filling form data and the ui
        $customers = $currentCompany->customers;
       // $products = $currentCompany->products;
        $tax_per_item = (boolean) $currentCompany->getSetting('tax_per_item');
        $discount_per_item = (boolean) $currentCompany->getSetting('discount_per_item');
        
        return view('application.invoices.create', [
            'invoice' => $invoice,
            'customers' => $customers,
            'products' => $products,
            'tax_per_item' => $tax_per_item,
            'discount_per_item' => $discount_per_item,
            'drivers' => $drivers,
            'client' => $client,
            //'plate_num' => $plate_num,
            'transporter' => $transporter,
        ]);
    }

    public function createreceipt(Request $request)
    { 
        if (!Auth::user()->can('receipts-create')) {
            abort(403);
        }
        $client = Client::all();
        $payment_type = PaymentMethod::all();
        $payment_status = PaymentStatus::all();
        $invoices =  '';
        return view('application.invoices.createreceipts', [
            'client' => $client,
            'payment_type' => $payment_type,
            'invoices' => $invoices,
            'payment_status' => $payment_status,
        ]);
    }

    public function filterbyclient(Request $request)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        $client = Client::all();
        $payment_type = PaymentMethod::all();
        $payment_status = PaymentStatus::all();
        $invoices =  Invoice::where('paid_status', 'UNPAID')->where('client_id', $request->contractname)->get();
        // dd($invoices);

        return view('application.invoices.createreceipts', [
            'client' => $client,
            'payment_type' => $payment_type,
            'invoices' => $invoices,
            'payment_status' => $payment_status,
        ]);
        
    
    }

    public function filterbyclient1(Request $request,$id)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        $data['client'] = Client::all();
        $data['payment_type'] = PaymentMethod::all();
        $data['invoices'] =  Invoice::where('paid_status', 'UNPAID')->where('client_id', $id)->get();
        // return response()->json([
        //     'client' => $client,
        //     'payment_type' => $payment_type,
        //     'invoices' => $invoices,
        //   ]);
        // return view('application.invoices.createreceipts', [
        //     'client' => $client,
        //     'payment_type' => $payment_type,
        //     'invoices' => $invoices,
        // ]);

        return redirect()->route('application.invoices.createreceipts', $data);
    
    }

    public function createcash(Request $request, $id=NULL)
    {
        if (!Auth::user()->can('invoices-create')) {
            abort(403);
        }
        if(Auth::user()->roles =="superadmin"){
            $user = $request->user();
            $currentCompany = $user->currentCompany();
            $currentSites = $id;

        }elseif(Auth::user()->roles =="admin_company"){
            $user = $request->user();
            $currentCompany = $user->currentCompany();
            $currentSites = $user->sites_id;

        }else {
            $user = $request->user();
            $currentCompany = $user->currentCompany();
            $currentSites = $user->sites_id;
        }
            // dd($currentSites);

            $drivers = Driver::where('sites_id', $currentSites)->get();
            $plate_num = $drivers;
            $products = Product::where('client_id', NULL)->where('sites_id', $currentSites)->get();
        

        // Get next Invoice number if the auto generation option is enabled
        $invoice_prefix = $currentCompany->getSetting('invoice_prefix');
        $next_invoice_number = Invoice::getNextInvoiceNumber($invoice_prefix,$currentSites);
        // Create new number model and set invoice_number and company_id
        // so that we can use them in the form
        $invoice = new Invoice();
        $invoice->invoice_number = $next_invoice_number;
        $invoice->company_id = $currentCompany->id;

        // Also for filling form data and the ui
        $customers = $currentCompany->customers;
        $tax_per_item = (boolean) $currentCompany->getSetting('tax_per_item');
        $discount_per_item = (boolean) $currentCompany->getSetting('discount_per_item');
        
        return view('application.invoices.createcash', [
            'invoice' => $invoice,
            'customers' => $customers,
            'products' => $products,
            'tax_per_item' => $tax_per_item,
            'discount_per_item' => $discount_per_item,
            'drivers' => $drivers,
            'plate_num' => $plate_num,
        ]);
    }
    /**
     * Store the Invoice in Database
     *
     * @param \App\Http\Requests\Application\Invoice\Store $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Store $request) //store invoice contract
    {
        //dd($request->client_id);
        if (!Auth::user()->can('invoices-create')) {
            abort(403);
        }
        if($request->transporter == 2){
         
            $request->validate([
                'client_id' => 'required',
                'driver_id' => 'required',
                'plate_number' => 'required',
                'product.*' => 'required',
                'transporter_id' => 'required',
                'location_id' => 'required',
            ]);

        }else{

            $request->validate([
                'client_id' => 'required',
                'driver_id' => 'required',
                'plate_number' => 'required',
                'product.*' => 'required',
            ]);
        }

        $site = Client::where('id', $request->client_id)->first();

       if(!empty($request->transporter_id)){

        $invoice_num = preg_replace("/[^\d]/", "", $request->invoice_number);
        //dd($invoice_num);
        $date =date('dmY');
        $invoice_number = "INV-CT-".$date.'/'.$invoice_num;
        $do_number = "DO-CT-".$date.'/'.$invoice_num;
        //$rc_number = "REC-CT-".$invoice_num;
        //dd($do_number);
        if($request->drafs_input == 1){
            $status = Invoice::STATUS_SENT;
            $paid_status = Invoice::STATUS_UNPAID;
        }else{
            $status = Invoice::STATUS_DRAFT;
            $paid_status = Invoice::STATUS_UNPAID;
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Get company based settings
        $tax_per_item = (boolean) $currentCompany->getSetting('tax_per_item');
        $discount_per_item = (boolean) $currentCompany->getSetting('discount_per_item');
        $sites = Site::where('id',$site->sites_id)->first();

        $invoice = new Invoice;
        $invoice->type = 1;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->due_date = $request->due_date;
        $invoice->invoice_number = $invoice_number;
        $invoice->do_number = $do_number;
        $invoice->plate_number_id = $request->plate_number_id;
        $invoice->plate_number = $request->plate_number;
        $invoice->reference_number = $request->reference_number;
        $invoice->driver_id = $request->driver_id;
        $invoice->client_id = $request->client_id;
        $invoice->sites_id  = $site->sites_id;
        $invoice->customer_id = $request->customer_id;
        $invoice->company_id = $sites->company_id;
        $invoice->transporter_id = $request->transporter_id;
        $invoice->location_id = $request->location_id;
        $invoice->status = $status;
        $invoice->paid_status = $paid_status;
        $invoice->sub_total = $request->sub_total;
        $invoice->discount_type = 'percent';
        $invoice->discount_val = $request->total_discount ?? 0;
        $invoice->total = $request->grand_total;
        $invoice->due_amount = $request->grand_total;
        $invoice->accurate_amount = $request->grand_total;
        $invoice->notes = $request->notes;
        $invoice->private_notes = $request->private_notes;
        $invoice->tax_per_item = $tax_per_item;
        $invoice->discount_per_item = $discount_per_item;
        $invoice->save();

        $invoice_id = Invoice::where('invoice_number', $invoice_number)->first();
        $trackinginfo = new Trackinginfo;
        $trackinginfo->invoice_id = $invoice_id->id;
        $trackinginfo->activities = "Pick up by";
        $trackinginfo->remark = $invoice_id->driver_id;
        $trackinginfo->plate_number_id = $request->plate_number_id;
        $trackinginfo->save();

        $trackinginfo = new Trackinginfo;
        $trackinginfo->invoice_id = $invoice_id->id;
        $trackinginfo->activities = "Invoice Number";
        $trackinginfo->remark = $invoice_number;
        $trackinginfo->save();

        $trackinginfo = new Trackinginfo;
        $trackinginfo->invoice_id = $invoice_id->id;
        $trackinginfo->activities = "DO Number";
        $trackinginfo->remark = $do_number;
        $trackinginfo->save();

        // Arrays of data for storing Invoice Items
        $products = $request->product;
        $quantities = $request->quantity;
        $taxes = $request->taxes;
        $prices = $request->price;
        $totals = $request->total;
        $discounts = $request->discount;

        // Add products (invoice items)
        for ($i=0; $i < count($products); $i++) {
            $item = $invoice->items()->create([
                'product_id' => $products[$i],
                'company_id' => $sites->company_id,
                'quantity' => $quantities[$i],
                'discount_type' => 'percent',
                'discount_val' => $discounts[$i] ?? 0,
                'price' => $prices[$i],
                'total' => $totals[$i],
            ]);

            // Add taxes for Invoice Item if it is given
            if ($taxes && array_key_exists($i, $taxes)) {
                foreach ($taxes[$i] as $tax) {
                    $item->taxes()->create([
                        'tax_type_id' => $tax
                    ]);
                }
            }
        }

        // If Invoice based taxes are given
        if ($request->has('total_taxes')) {
            foreach ($request->total_taxes as $tax) {
                $invoice->taxes()->create([
                    'tax_type_id' => $tax
                ]);
            }
        }
       }else{
        $invoice_num = preg_replace("/[^\d]/", "", $request->invoice_number);
        //dd($invoice_num);
        $date =date('dmY');
        $invoice_number = "INV-CT-".$date.'/'.$invoice_num;
        $do_number = "DO-CT-".$date.'/'.$invoice_num;
        //$rc_number = "REC-CT-".$invoice_num;
        //dd($do_number);
        if($request->drafs_input == 1){
            $status = Invoice::STATUS_COMPLETED;
            $paid_status = Invoice::STATUS_UNPAID;
        }else{
            $status = Invoice::STATUS_DRAFT;
            $paid_status = Invoice::STATUS_UNPAID;
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Get company based settings
        $tax_per_item = (boolean) $currentCompany->getSetting('tax_per_item');
        $discount_per_item = (boolean) $currentCompany->getSetting('discount_per_item');
        $sites = Site::where('id',$site->sites_id)->first();

        $invoice = new Invoice;
        $invoice->type = 1;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->due_date = $request->due_date;
        $invoice->invoice_number = $invoice_number;
        $invoice->do_number = $do_number;
        $invoice->plate_number_id = $request->plate_number_id;
        $invoice->plate_number = $request->plate_number;
        $invoice->reference_number = $request->reference_number;
        $invoice->driver_id = $request->driver_id;
        $invoice->client_id = $request->client_id;
        $invoice->sites_id  = $site->sites_id;
        $invoice->customer_id = $request->customer_id;
        $invoice->company_id = $sites->company_id;
        $invoice->transporter_id = $request->transporter_id;
        $invoice->location_id = $request->location_id;
        $invoice->status = $status;
        $invoice->paid_status = $paid_status;
        $invoice->sub_total = $request->sub_total;
        $invoice->discount_type = 'percent';
        $invoice->discount_val = $request->total_discount ?? 0;
        $invoice->total = $request->grand_total;
        $invoice->due_amount = $request->grand_total;
        $invoice->accurate_amount = $request->grand_total;
        $invoice->notes = $request->notes;
        $invoice->private_notes = $request->private_notes;
        $invoice->tax_per_item = $tax_per_item;
        $invoice->discount_per_item = $discount_per_item;
        $invoice->save();

        $invoice_id = Invoice::where('invoice_number', $invoice_number)->first();
        $trackinginfo = new Trackinginfo;
        $trackinginfo->invoice_id = $invoice_id->id;
        $trackinginfo->activities = "Pick up by";
        $trackinginfo->remark = $invoice_id->driver_id;
        $trackinginfo->plate_number_id = $request->plate_number_id;
        $trackinginfo->save();

        $trackinginfo = new Trackinginfo;
        $trackinginfo->invoice_id = $invoice_id->id;
        $trackinginfo->activities = "Invoice Number";
        $trackinginfo->remark = $invoice_number;
        $trackinginfo->save();

        $trackinginfo = new Trackinginfo;
        $trackinginfo->invoice_id = $invoice_id->id;
        $trackinginfo->activities = "DO Number";
        $trackinginfo->remark = $do_number;
        $trackinginfo->save();

        // Arrays of data for storing Invoice Items
        $products = $request->product;
        $quantities = $request->quantity;
        $taxes = $request->taxes;
        $prices = $request->price;
        $totals = $request->total;
        $discounts = $request->discount;

        // Add products (invoice items)
        for ($i=0; $i < count($products); $i++) {
            $item = $invoice->items()->create([
                'product_id' => $products[$i],
                'company_id' => $sites->company_id,
                'quantity' => $quantities[$i],
                'discount_type' => 'percent',
                'discount_val' => $discounts[$i] ?? 0,
                'price' => $prices[$i],
                'total' => $totals[$i],
            ]);

            // Add taxes for Invoice Item if it is given
            if ($taxes && array_key_exists($i, $taxes)) {
                foreach ($taxes[$i] as $tax) {
                    $item->taxes()->create([
                        'tax_type_id' => $tax
                    ]);
                }
            }
        }

        // If Invoice based taxes are given
        if ($request->has('total_taxes')) {
            foreach ($request->total_taxes as $tax) {
                $invoice->taxes()->create([
                    'tax_type_id' => $tax
                ]);
            }
        }
       }

        session()->flash('alert-success', __('messages.invoice_added'));
        return redirect()->route('invoices.details', $invoice->id);
    }

    public function store2(Store $request) //store invoice cash
    {
        if (!Auth::user()->can('invoices-create')) {
            abort(403);
        }
        $invoice_num = preg_replace("/[^\d]/", "", $request->invoice_number);
        //dd($invoice_num);
        $date =date("dmY");
        $invoice_number = "INV-CS-".$date.'/'.$invoice_num;
        $do_number = "DO-CS-".$date.'/'.$invoice_num;
        $rc_number = "REC-CS-".$date.'/'.$invoice_num;

        if($request->drafs_input == 1){
            $status = Invoice::STATUS_COMPLETED;
            $paid_status = Invoice::STATUS_PAID;
        }else{
            $status = Invoice::STATUS_DRAFT;
            $paid_status = Invoice::STATUS_UNPAID;
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        $site = Driver::where('id', $request->driver_id)->first();

        // Get company based settings
        $tax_per_item = (boolean) $currentCompany->getSetting('tax_per_item');
        $discount_per_item = (boolean) $currentCompany->getSetting('discount_per_item');
        $sites = Site::where('id',$site->sites_id)->first();
 
        $invoice = new Invoice;
        $invoice->type = 2;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->due_date = $request->due_date;
        $invoice->invoice_number = $invoice_number;
        $invoice->do_number = $do_number;
        $invoice->receipt_number = $rc_number;
        $invoice->reference_number = $request->reference_number;
        $invoice->driver_id = $request->driver_id;
        $invoice->plate_number_id = $request->plate_number_id;
        $invoice->plate_number = $request->plate_number;
        $invoice->client_id = $request->client_id;
        $invoice->sites_id  = $site->sites_id;
        $invoice->customer_id = $request->customer_id;
        $invoice->company_id = $sites->company_id;
        $invoice->status = $status;
        $invoice->paid_status = $paid_status;
        $invoice->sub_total = $request->sub_total;
        $invoice->discount_type = 'percent';
        $invoice->discount_val = $request->total_discount ?? 0;
        $invoice->total = $request->grand_total;
        $invoice->due_amount = $request->grand_total;
        $invoice->accurate_amount = $request->grand_total;
        $invoice->notes = $request->notes;
        $invoice->private_notes = $request->private_notes;
        $invoice->tax_per_item = $tax_per_item;
        $invoice->discount_per_item = $discount_per_item;
        $invoice->save();

        $invoice_id = Invoice::where('invoice_number', $invoice_number)->first();
        $trackinginfo = new Trackinginfo;
        $trackinginfo->invoice_id = $invoice_id->id;
        $trackinginfo->activities = "Pick up by";
        $trackinginfo->remark = $invoice_id->driver_id;
        $trackinginfo->plate_number_id = $request->plate_number_id;
        $trackinginfo->save();

        $trackinginfo = new Trackinginfo;
        $trackinginfo->invoice_id = $invoice_id->id;
        $trackinginfo->activities = "Invoice Number";
        $trackinginfo->remark = $invoice_number;
        $trackinginfo->save();

        $trackinginfo = new Trackinginfo;
        $trackinginfo->invoice_id = $invoice_id->id;
        $trackinginfo->activities = "DO Number";
        $trackinginfo->remark = $do_number;
        $trackinginfo->save();

        $trackinginfo = new Trackinginfo;
        $trackinginfo->invoice_id = $invoice_id->id;
        $trackinginfo->activities = "Receipt Number";
        $trackinginfo->remark = $rc_number;
        $trackinginfo->save();

        $last_balance = PettyCash::where('sites_id', $site->sites_id)->latest()->first();
        if(empty($last_balance)){
            $balance = 0;
        }else{
            $balance = $last_balance->balance;
        }
        $pettyCash = new PettyCash;
        $pettyCash->detail = "Sales Cash($invoice_number)";
        $pettyCash->sites_id = $invoice->sites_id;
        $pettyCash->date = date("Y-m-d");
        $pettyCash->time = date("h:i:s");
        $pettyCash->debit = $request->grand_total;
        $pettyCash->balance = $balance+$request->grand_total;
        $pettyCash->save();

        // Arrays of data for storing Invoice Items
        $products = $request->product;
        $quantities = $request->quantity;
        $taxes = $request->taxes;
        $prices = $request->price;
        $totals = $request->total;
        $discounts = $request->discount;

        // Add products (invoice items)
        for ($i=0; $i < count($products); $i++) {
            $item = $invoice->items()->create([
                'product_id' => $products[$i],
                'company_id' => $sites->company_id,
                'quantity' => $quantities[$i],
                'discount_type' => 'percent',
                'discount_val' => $discounts[$i] ?? 0,
                'price' => $prices[$i],
                'total' => $totals[$i],
            ]);

            // Add taxes for Invoice Item if it is given
            if ($taxes && array_key_exists($i, $taxes)) {
                foreach ($taxes[$i] as $tax) {
                    $item->taxes()->create([
                        'tax_type_id' => $tax
                    ]);
                }
            }
        }

        // If Invoice based taxes are given
        if ($request->has('total_taxes')) {
            foreach ($request->total_taxes as $tax) {
                $invoice->taxes()->create([
                    'tax_type_id' => $tax
                ]);
            }
        }

        session()->flash('alert-success', __('messages.invoice_added'));
        return redirect()->route('invoices.detailscash', $invoice->id);
    }
    /**
     * Display the Invoice Details Page
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if(Auth::user()->roles =="client")
        {
            $clientid = Auth::user()->client_id;
            // $invoice = Invoice::findOrFail($request->invoice);
            $invoice = Invoice::where('id',$request->invoice)->where('client_id', $clientid)->first();
            // dd($invoice);
        }else{
            $invoice = Invoice::findOrFail($request->invoice);
        }


        return view('application.invoices.details', [
            'invoice' => $invoice,
        ]);
    }

    public function showcash(Request $request)
    {
        if (!Auth::user()->can('invoices-create')) {
            abort(403);
        }
        $invoice = Invoice::findOrFail($request->invoice);

        return view('application.invoices.detailscash', [
            'invoice' => $invoice,
        ]);
    }

    public function showcash2(Request $request)
    {

        if(Auth::user()->roles =="client")
        {
            $clientid = Auth::user()->client_id;
            // $invoice = Invoice::findOrFail($request->invoice);
            $invoice = Invoice::where('id',$request->invoice)->where('client_id', $clientid)->first();
            // dd($invoice);
        }else{
            $invoice = Invoice::findOrFail($request->invoice);
        }

        return view('application.invoices.detailsdocontract', [
            'invoice' => $invoice,
        ]);
    }
    public function showcash3(Request $request)
    {

        if(Auth::user()->roles =="client")
        {
            $clientid = Auth::user()->client_id;
            // $invoice = Invoice::findOrFail($request->invoice);
            $invoice = Invoice::where('id',$request->invoice)->where('client_id', $clientid)->first();
            // dd($invoice);
        }else{
            $invoice = Invoice::findOrFail($request->invoice);
        }

        return view('application.invoices.detailsdoarrived', [
            'invoice' => $invoice,
        ]);
    }
    public function showreceipts(Request $request)
    {
        if (!Auth::user()->can('receipts-view')) {
            abort(403);
        }
        $invoice = Invoice::findOrFail($request->invoice);

        return view('application.invoices.detailreceiptscash', [
            'invoice' => $invoice,
        ]);
    }

    /**
     * Send an email to customer about the Invoice
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        $invoice = Invoice::findOrFail($request->invoice);

        // If demo mode is active then block this action
        if (config('app.is_demo')) {
            session()->flash('alert-danger', __('messages.action_blocked_in_demo'));
            return redirect()->route('invoices.details', $invoice->id);
        };

        // Send mail to customer
        try {
            Mail::to($invoice->customer->email)->send(new InvoiceToCustomer($invoice));
        } catch (\Throwable $th) {
            session()->flash('message-danger', __('messages.email_could_not_sent'));
        }

        // Log the activity
        activity()->on($invoice->customer)->by($invoice)
            ->log('Invoice :causer.invoice_number emailed to Customer by system.');

        // Change the status of the Invoice
        if ($invoice->status == Invoice::STATUS_DRAFT) {
            $invoice->status = Invoice::STATUS_SENT;
            $invoice->sent = true;
            $invoice->save();
        }

        session()->flash('alert-success', __('messages.an_email_sent_to_customer'));
        return redirect()->route('invoices.details', $invoice->id);
    }

    /**
     * Change Status of the Invoice by Given Status
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function mark(Request $request)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        $invoice = Invoice::findOrFail($request->invoice);

        // Mark the Invoice by given status
        if ($request->status && $request->status == 'sent') {
            $invoice->status = Invoice::STATUS_SENT;
            $invoice->sent = true;
        } else if ($request->status && $request->status == 'paid') {
            $invoice->status = Invoice::STATUS_COMPLETED;
            $invoice->paid_status = Invoice::STATUS_PAID;
        } else if ($request->status && $request->status == 'unpaid') {
            $invoice->paid_status = Invoice::STATUS_UNPAID;
        }

        // Save the status
        $invoice->save();

        session()->flash('alert-success', __('messages.invoice_status_updated'));
        return redirect()->route('invoices.details', $invoice->id);
    }

    /**
     * Display the Form for Editing Invoice
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (!Auth::user()->can('invoices-edit')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $client = Client::all();
        $drivers = Driver::all();
        $plate_num = Driver::all();
        $transporter = Transporter::all();
        //$drivers = Driver::where('client_id', NULL)->get();
        $invoice = Invoice::findOrFail($request->invoice);

        // Filling form data and the ui
        $customers = $currentCompany->customers;
        $products = Product::where('client_id', NULL)->get();

        return view('application.invoices.edit', [
            'invoice' => $invoice,
            'drivers' => $drivers,
            'client' => $client,
            'plate_num' => $plate_num,
            'transporter' => $transporter,
            'customers' => $customers,
            'products' => $products,
            'tax_per_item' => $invoice->tax_per_item,
            'discount_per_item' => $invoice->discount_per_item,
        ]);
    }

    public function editcash(Request $request)
    {
        if (!Auth::user()->can('invoices-edit')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $drivers = Driver::where('client_id', NULL)->get();
        $invoice = Invoice::findOrFail($request->invoice);

        // Filling form data and the ui
        $customers = $currentCompany->customers;
        $products = Product::where('client_id', NULL)->get();

        return view('application.invoices.editcash', [
            'invoice' => $invoice,
            'drivers' => $drivers,
            'customers' => $customers,
            'products' => $products,
            'tax_per_item' => $invoice->tax_per_item,
            'discount_per_item' => $invoice->discount_per_item,
        ]);
    }

    /**
     * Update the Invoice in Database
     *
     * @param \App\Http\Requests\Application\Invoice\Update $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        if (!Auth::user()->can('invoices-edit')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Find Invoice or Fail (404 Http Error)
        $invoice = Invoice::findOrFail($request->invoice);

        // Getting old amount
        $oldAmount = $invoice->total;
        if ($oldAmount != $request->total) {
            $oldAmount = (int)round($request->grand_total) - (int)$oldAmount;
        } else {
            $oldAmount = 0;
        }

        // Update Invoice due_amount
        $invoice->due_amount = ($invoice->due_amount + $oldAmount);

        // Update Invoice status based on new due amount
        if ($invoice->due_amount == 0 && $invoice->paid_status != Invoice::STATUS_PAID) {
            $invoice->status = Invoice::STATUS_COMPLETED;
            $invoice->paid_status = Invoice::STATUS_PAID;
        } elseif ($invoice->due_amount < 0 && $invoice->paid_status != Invoice::STATUS_UNPAID) {
            session()->flash('alert-danger', __('messages.invalid_due_amount'));
            return redirect()->route('invoices.edit', $invoice->id);
        } elseif ($invoice->due_amount != 0 && $invoice->paid_status == Invoice::STATUS_PAID) {
            $invoice->status = $invoice->getPreviousStatus();
            $invoice->paid_status = Invoice::STATUS_PARTIALLY_PAID;
        }

        // Update Invoice
        $invoice->update([
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'invoice_number' => $request->invoice_number,
            'reference_number' => $request->reference_number,
            'plate_number_id' => $request->plate_number_id,
            'plate_number' => $request->plate_number,
            'customer_id' => $request->customer_id,
            'discount_type' => 'percent',
            'discount_val' => $request->total_discount ?? 0,
            'sub_total' => $request->sub_total,
            'total' => $request->grand_total,
            'notes' => $request->notes,
            'private_notes' => $request->private_notes,
        ]);

        // Posted Values
        $products = $request->product;
        $quantities = $request->quantity;
        $taxes = $request->taxes;
        $prices = $request->price;
        $totals = $request->total;
        $discounts = $request->discount;

        // Remove old invoice items
        $invoice->items()->delete();

        // Add products (invoice items)
        for ($i=0; $i < count($products); $i++) {
            $item = $invoice->items()->create([
                'product_id' => $products[$i],
                'company_id' => $currentCompany->id,
                'quantity' => $quantities[$i],
                'discount_type' => 'percent',
                'discount_val' => $discounts[$i] ?? 0,
                'price' => $prices[$i],
                'total' => $totals[$i],
            ]);

            // Add taxes for Invoice Item if it is given
            if ($taxes && array_key_exists($i, $taxes)) {
                foreach ($taxes[$i] as $tax) {
                    $item->taxes()->create([
                        'tax_type_id' => $tax
                    ]);
                }
            }
        }

        // Remove old invoice taxes
        $invoice->taxes()->delete();

        // If Invoice based taxes are given
        if ($request->has('total_taxes')) {
            foreach ($request->total_taxes as $tax) {
                $invoice->taxes()->create([
                    'tax_type_id' => $tax
                ]);
            }
        }

        session()->flash('alert-success', __('messages.invoice_updated'));
        return redirect()->route('invoices.details', $invoice->id);
    }


    public function updatecash(Update $request)
    {
        if (!Auth::user()->can('invoices-edit')) {
            abort(403);
        }
         //dd($request->drafs_input);
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Find Invoice or Fail (404 Http Error)
        $invoice = Invoice::findOrFail($request->invoice);

        // Getting old amount
        $oldAmount = $invoice->total;
        if ($oldAmount != $request->total) {
            $oldAmount = (int)round($request->grand_total) - (int)$oldAmount;
        } else {
            $oldAmount = 0;
        }

        // Update Invoice due_amount
        $invoice->due_amount = ($invoice->due_amount + $oldAmount);

        // Update Invoice status based on new due amount
        // if ($invoice->due_amount == 0 && $invoice->paid_status != Invoice::STATUS_PAID) {
        //     $invoice->status = Invoice::STATUS_COMPLETED;
        //     $invoice->paid_status = Invoice::STATUS_PAID;
        // } elseif ($invoice->due_amount < 0 && $invoice->paid_status != Invoice::STATUS_UNPAID) {
        //     session()->flash('alert-danger', __('messages.invalid_due_amount'));
        //     return redirect()->route('invoices.edit', $invoice->id);
        // } elseif ($invoice->due_amount != 0 && $invoice->paid_status == Invoice::STATUS_PAID) {
        //     $invoice->status = $invoice->getPreviousStatus();
        //     $invoice->paid_status = Invoice::STATUS_PARTIALLY_PAID;
        // }

        if($request->drafs_input == 1){
            $status = Invoice::STATUS_COMPLETED;
            $paid_status = Invoice::STATUS_PAID;
        }else{
            $status = Invoice::STATUS_DRAFT;
            $paid_status = Invoice::STATUS_UNPAID;
        }


        // Update Invoice
        $invoice->update([
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'invoice_number' => $request->invoice_number,
            'reference_number' => $request->reference_number,
            'driver_id' => $request->driver_id,
            'plate_number_id' => $request->plate_number_id,
            'plate_number' => $request->plate_number,
            'status' => $status,
            'paid_status' => $paid_status,
            'customer_id' => $request->customer_id,
            'discount_type' => 'percent',
            'discount_val' => $request->total_discount ?? 0,
            'sub_total' => $request->sub_total,
            'total' => $request->grand_total,
            'notes' => $request->notes,
            'private_notes' => $request->private_notes,
        ]);

        // Posted Values
        $products = $request->product;
        $quantities = $request->quantity;
        $taxes = $request->taxes;
        $prices = $request->price;
        $totals = $request->total;
        $discounts = $request->discount;

        // Remove old invoice items
        $invoice->items()->delete();

        // Add products (invoice items)
        for ($i=0; $i < count($products); $i++) {
            $item = $invoice->items()->create([
                'product_id' => $products[$i],
                'company_id' => $currentCompany->id,
                'quantity' => $quantities[$i],
                'discount_type' => 'percent',
                'discount_val' => $discounts[$i] ?? 0,
                'price' => $prices[$i],
                'total' => $totals[$i],
            ]);

            // Add taxes for Invoice Item if it is given
            if ($taxes && array_key_exists($i, $taxes)) {
                foreach ($taxes[$i] as $tax) {
                    $item->taxes()->create([
                        'tax_type_id' => $tax
                    ]);
                }
            }
        }

        // Remove old invoice taxes
        $invoice->taxes()->delete();

        // If Invoice based taxes are given
        if ($request->has('total_taxes')) {
            foreach ($request->total_taxes as $tax) {
                $invoice->taxes()->create([
                    'tax_type_id' => $tax
                ]);
            }
        }

        session()->flash('alert-success', __('messages.invoice_updated'));
        return redirect()->route('invoices.detailscash', $invoice->id);
    }
    /**
     * Delete the Invoice
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        if (!Auth::user()->can('invoices-delete')) {
            abort(403);
        }
        $invoice = Invoice::findOrFail($request->invoice);

        // return error if payment already exists with the invoice
        if ($invoice->payments()->exists() && $invoice->payments()->count() > 0) {
            session()->flash('alert-danger', __('messages.invoice_cant_delete'));
            return redirect()->route('invoices');
        }

        // Delete Invoice from Database
        $invoice->delete();

        session()->flash('alert-success', __('messages.invoice_deleted'));
        return redirect()->route('invoices');
    }

    public function driverdepandcontract($id)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }

        $plate = PlateNumber::where('driver_id', $id)->where('status', 1)->get();
        return response()->json($plate);
    }

    public function productdepandcontract($id)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        $products = Product::where('client_id', $id)
        ->select('id', 'name AS text', 'price')
        ->with('taxes')
        ->get();

    return response()->json($products);
    }

    public function indextracking(Request $request)
    {
        if (!Auth::user()->can('completed-delivery-view')) {
            abort(403);
        }
        $clientid = Auth::user()->client_id;
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Query Invoices by Company and Tab
        if(Auth::user()->roles =="client"){
            $query = Invoice::where('client_id', $clientid)->where('status', 'OTW')->orderBy('invoice_number', 'DESC');
        }else{
            $query = Invoice::where('status', 'OTW')->orderBy('invoice_number', 'DESC');
        }
        


        // Apply Filters and Paginate
        $invoices = QueryBuilder::for($query)
        ->allowedFilters([
            AllowedFilter::partial('invoice_number'),
            AllowedFilter::partial('do_number'),
            AllowedFilter::partial('receipt_number'),
            AllowedFilter::partial('platenumbers.number_plate'),
            AllowedFilter::partial('transporters.company_name'),
            AllowedFilter::partial('transporterlocation.name'),
            AllowedFilter::partial('accurate'),
            AllowedFilter::exact('status'),
            AllowedFilter::exact('items.quantity'),
            AllowedFilter::exact('accurate_remark'),
            AllowedFilter::partial('drivers.name'),
        ])
            ->latest()
            ->paginate(10)
            ->appends(request()->query());

        return view('application.invoices.indextracking_info', [
            'invoices' => $invoices,
        ]);
    }

    public function accurate(Request $request,$id)
    {
       //$data = Invoice::where('id', $id)->get();
       if (!Auth::user()->can('completed-delivery-view')) {
        abort(403);
        }
       $data = DB::table('invoices')
            ->join('drivers', 'invoices.driver_id', '=', 'drivers.id')
            ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->join('plate_number', 'invoices.plate_number_id', '=', 'plate_number.id')
            ->select('drivers.*', 'invoice_items.*', 'plate_number.number_plate')
            ->where('invoices.id', $id)
            ->get();

        return response()->json([
            'data' => $data
          ]);
    }


    public function accuratesubmit(Request $request,$id)
    {
        if (!Auth::user()->can('completed-delivery-view')) {
            abort(403);
            }
       // Find Invoice or Fail (404 Http Error)
       $invoice = Invoice::findOrFail($id);

       $invoice->update([
        'accurate' => "Accurate Quantity",
        'accurate_remark' => $request->tonnage,
        'status' => "COMPLETED",

    ]);

    $trackinginfo = new Trackinginfo;
    $trackinginfo->invoice_id = $invoice->id;
    $trackinginfo->activities = "Arrival";
    $trackinginfo->remark = "Accurate Quantity";
    $trackinginfo->save();

    session()->flash('alert-success',__('messages.done_added'));
    return response()->json([
        
      ]);

    }


    public function notaccuratesubmit(Request $request,$id)
    {
        if (!Auth::user()->can('completed-delivery-view')) {
            abort(403);
            }

        $request->validate([
            'remark' => 'required|numeric|lt:tonnage2'
        ]);

       $remark = $request->remark;
       $tonnage2 = $request->tonnage2;
       // Find Invoice or Fail (404 Http Error)
       $invoice = Invoice::findOrFail($id);
       $price_item = InvoiceItem::where('invoice_id',$id)->first();

       $invoice->update([
        'accurate' => "Inaccurate Quantity",
        'status' => "COMPLETED",
        'accurate_remark' => $remark,
        'accurate_amount' => $remark*$price_item->price,

        ]);

        $trackinginfo = new Trackinginfo;
        $trackinginfo->invoice_id = $invoice->id;
        $trackinginfo->activities = "Arrival";
        $trackinginfo->remark = "Inaccurate Quantity";
        $trackinginfo->save();
        
        session()->flash('alert-success',__('messages.done_added'));
         return response()->json([
            'data' => $id
          ]);

    }

    // public function indexcompleted(Request $request)
    // {
    //     if (!Auth::user()->can('completed-delivery-view')) {
    //         abort(403);
    //         }
    //     $receipts = Receipt::all();
    //     $clientid = Auth::user()->client_id;
    //     if(Auth::user()->roles =="client"){
    //         // $query = Invoice::where('status', 'COMPLETED')->where('client_id', $clientid);
    //         if($request->tab == 'paid') {
    //             $query = Invoice::where('status', 'COMPLETED')->where('paid_status', 'PAID')->where('client_id', $clientid);
    //             $tab = 'paid';
    //         } else { 
    //             $query = Invoice::where('status', 'COMPLETED')->where('paid_status', '!=', 'PAID')->where('client_id', $clientid);
    //             $tab = 'unpaid';
    //         }
    //     }
    //     else{
    //         if($request->tab == 'paid') {
    //             $query = Invoice::where('status', 'COMPLETED')->where('paid_status', 'PAID')->whereNotNull('client_id');
    //             $tab = 'paid';
    //         } else { 
    //             $query = Invoice::where('status', 'COMPLETED')->where('paid_status', '!=', 'PAID')->whereNotNull('client_id');
    //             $tab = 'unpaid';
    //         }
    //         // $query = Invoice::where('status', 'COMPLETED');
    //     }
    //     // Apply Filters and Paginate
    //     $invoices = QueryBuilder::for($query)
    //     ->allowedFilters([
    //         AllowedFilter::partial('invoice_number'),
    //         AllowedFilter::partial('do_number'),
    //         AllowedFilter::partial('receipt_number'),
    //         AllowedFilter::partial('platenumbers.number_plate'),
    //         AllowedFilter::partial('transporters.company_name'),
    //         AllowedFilter::partial('transporterlocation.name'),
    //         AllowedFilter::partial('accurate'),
    //         AllowedFilter::exact('status'),
    //         AllowedFilter::exact('items.quantity'),
    //         AllowedFilter::exact('accurate_remark'),
    //         AllowedFilter::partial('drivers.name'),
    //     ])
    //     ->latest()
    //     ->paginate(10)
    //     ->appends(request()->query());
       

    //     return view('application.customers.index', [
    //         'invoices' => $invoices,
    //         'tab' => $tab,
    //         'receipts' => $receipts,

    //     ]);
    // }

    // public function tracking(Request $request,$id)
    // {
    //     $trackings = Trackinginfo::where('invoice_id', $id)->get();
    //     return view('application.customers.create', [
    //         'trackings' => $trackings,
    //     ]);
    // }
    
    // public function indextransaction(Request $request,$id)
    // {
    //     if (!Auth::user()->can('intransit-view')) {
    //         abort(403);
    //     }
 
        
    //     $receipts = Receipt::all();
    //     if($request->tab == 'unpaid') {
    //         $query = Invoice::where('client_id', $id)->where('status', 'COMPLETED')->where('paid_status', '!=', 'PAID')->latest('id');
    //         $tab = 'unpaid';
    //     } else if ($request->tab == 'due'){
    //         $query = Invoice::where('status', 'OTW')->where('client_id', $id)->latest('id');
    //         $tab = 'due';
    //     } else { 
    //         $query = Invoice::where('client_id', $id)->where('status', 'COMPLETED')->where('paid_status', 'PAID')->latest('id');
    //         $tab = 'paid';
    //     }
    //     // Apply Filters and Paginate
    //     $completeds = QueryBuilder::for($query)
    //     ->allowedFilters([
    //         AllowedFilter::partial('invoice_number'),
    //         AllowedFilter::partial('do_number'),
    //         AllowedFilter::partial('receipt_number'),
    //         AllowedFilter::partial('platenumbers.number_plate'),
    //         AllowedFilter::partial('transporters.company_name'),
    //         AllowedFilter::partial('transporterlocation.name'),
    //         AllowedFilter::exact('accurate'),
    //         AllowedFilter::exact('status'),
    //         AllowedFilter::exact('items.quantity'),
    //         AllowedFilter::exact('accurate_remark'),
    //         AllowedFilter::partial('drivers.name'),

    //         //AllowedFilter::partial('clients.company_name'),
    //         //AllowedFilter::partial('invoice_date'),
    //         //AllowedFilter::partial('paid_status'),
    //         //AllowedFilter::partial('drivers.name'),
    //     ])
    //     ->latest()
    //     ->paginate(10)
    //     ->appends(request()->query());

    //     return view('application.estimates.index',[
    //         'completeds' => $completeds,
    //         'tab' => $tab,
    //         'id' => $id,
    //         'receipts' => $receipts,
    //     ]);
    // }

    public function checkdriver($id)
    {

        $driver_onjob = DB::table('invoices')->where('invoices.driver_id', $id)
        ->join('drivers', 'invoices.driver_id', '=', 'drivers.id')
        ->join('plate_number', 'invoices.plate_number_id', '=', 'plate_number.id')
        ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
        ->select('invoices.*', 'drivers.name', 'plate_number.number_plate', DB::raw('SUM(invoice_items.quantity) as total_qun'))
        ->where('invoices.status', 'OTW')
        ->groupBy('invoice_items.invoice_id')
        ->get();


        $driver_notin = DB::table('invoices')->where('invoices.driver_id', $id)
        ->join('drivers', 'invoices.driver_id', '=', 'drivers.id')
        ->join('plate_number', 'invoices.plate_number_id', '=', 'plate_number.id')
        ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
        ->select('invoices.*', 'drivers.name', 'plate_number.number_plate', DB::raw('SUM(invoice_items.quantity) as total_qun'))
        ->where('invoices.accurate', 'Inaccurate Quantity')
        ->groupBy('invoice_items.invoice_id')
        ->get();

        if($driver_onjob->count() > 0)
        {
            $data['type'] = 1; //Driver On Job!
            $data['data'] = $driver_onjob;

        }elseif($driver_notin->count() > 0)
        {
            $data['type'] = "2"; //The last shipment was inaccurate
            $data['data'] = $driver_notin;

        }else{

            $data['type'] = "false";
        }
        
        return response()->json($data);
    }

    public function checkdriverreason(Request $request)
    {
        $request->validate([
            'reason' => 'required'
        ]);

        $issue = new issue;
        $issue->driver_id = $request->driver_id;
        $issue->driver_name = $request->driver_name;
        $issue->datetime = $request->datetime;
        $issue->plate_number = $request->plate_number;
        $issue->invoices = $request->invoices;
        $issue->supposed_qty = $request->suppose; 
        $issue->arrived_qty = $request->arrived;
        $issue->reason = $request->reason;
        $issue->save();
      
        return response()->json($request);
    }

    public function checklori($id)
    {

        $lori_onjob = DB::table('invoices')->where('invoices.plate_number', $id)
        ->join('drivers', 'invoices.driver_id', '=', 'drivers.id')
        ->join('plate_number', 'invoices.plate_number_id', '=', 'plate_number.id')
        ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
        ->select('invoices.*', 'drivers.name', 'plate_number.number_plate', DB::raw('SUM(invoice_items.quantity) as total_qun'))
        ->where('invoices.status', 'OTW')
        ->groupBy('invoice_items.invoice_id')
        ->get();

        $lori_in = DB::table('invoices')->where('invoices.plate_number', $id)
        ->join('drivers', 'invoices.driver_id', '=', 'drivers.id')
        ->join('plate_number', 'invoices.plate_number_id', '=', 'plate_number.id')
        ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
        ->select('invoices.*', 'drivers.name', 'plate_number.number_plate', DB::raw('SUM(invoice_items.quantity) as total_qun'))
        ->where('invoices.accurate', 'Inaccurate Quantity')
        ->groupBy('invoice_items.invoice_id')
        ->get();


        if($lori_onjob->count() > 0)
        {
            $data['type'] = 1; //Lorry On Job!
            $data['data'] = $lori_onjob;

        }elseif($lori_in->count() > 0)
        {
            $data['type'] = 2; //The last shipment was inaccurate
            $data['data'] = $lori_in;

        }else{

            $data['type'] = "false";
        }

        return response()->json($data);
    }

    public function transporlocationterdepend($id)
    {
        $location = TransporterLocation::where('transport_id', $id)->get();
        return response()->json($location);
    }

    public function checktransport($id)
    {
        $client = Client::where('id', $id)->first();
        $data['use_transporter'] = Client::select('transport')->where('id', $id)->get();
        $data['transporter'] = Transporter::where('sites_id',$client->sites_id)->get();
        return response()->json($data);
    }
}
