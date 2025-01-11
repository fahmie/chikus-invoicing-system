<?php

namespace App\Http\Controllers\Application;

use App\Models\Transporter;
use App\Models\ReceiptTransporter;
use App\Models\TransporterLocation;
use App\Models\Invoice;
use App\Models\PaymentStatus;
use App\Models\PaymentMethod;
use App\Models\TransporterDetailView;
use App\Models\PettyCash;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\DB;
use Auth;

class TransporterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (Auth::user()->roles == "client") {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if (Auth::user()->roles == "superadmin") {
            $query = Transporter::latest();
        } elseif (Auth::user()->roles == "admin_company") {
            $sites_id = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $query = Transporter::whereIn('sites_id', $sites_id);
        } else {
            $query = Transporter::where('sites_id', $currentSites);
        }
        //Apply Filters and Paginate
        $transporter = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::partial('company_name'),
                AllowedFilter::partial('name'),
                AllowedFilter::partial('address'),
                AllowedFilter::partial('email'),
                AllowedFilter::partial('phone'),
                AllowedFilter::partial('remark'),

            ])
            ->simplePaginate(20)
            ->appends(request()->query());

        return view('application.transporter.index', [
            'transporter' => $transporter,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Auth::user()->roles == "client") {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if (Auth::user()->roles == "superadmin") {
            $sites = Site::all();
        } elseif (Auth::user()->roles == "admin_company") {
            $sites = Site::where('company_id', $currentCompany->id)->get();
        } else {
            $sites = Site::where('id', $currentSites)->get();
        }
        return view('application.transporter.create', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->roles == "client") {
            abort(403);
        }
        //dd($request->sites_id);
        $request->validate([
            'sites_id' => 'required',
            'company_name' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:transporters,email,' . $request->sites_id . ',sites_id',
            //'email' => 'required|email',
            'price.*' => 'required',
            'location_name.*' => 'required|distinct',
        ]);

        $location_name = $request->location_name;
        $price = $request->price;

        foreach ($location_name as $id => $key) {
            $result[$id] = array(
                'location_name'  => $location_name[$id],
                'price' => $price[$id],
            );
        }

        $transporter = new Transporter;
        $transporter->company_name = request()->company_name;
        $transporter->sites_id = request()->sites_id;
        $transporter->name = request()->name;
        $transporter->address = request()->address;
        $transporter->phone = request()->phone;
        $transporter->email = request()->email;
        $transporter->remark = request()->remark;
        $transporter->save();

        $transporter_id = Transporter::latest()->first()->id;
        foreach ($result as $data) {
            $transpoterLocation = new TransporterLocation;
            $transpoterLocation->transport_id = $transporter_id;
            $transpoterLocation->name = $data['location_name'];
            $transpoterLocation->price = $data['price'] * 100;
            $transpoterLocation->save();
        }

        session()->flash('alert-success', 'Success');
        return redirect()->route('transporter');
    }

    public function details(Request $request, $id)
    {
        if (Auth::user()->roles == "client") {
            abort(403);
        }
        $transporter = Transporter::where('id', $id)->first();
        $location = TransporterLocation::where('transport_id', $id)->get();
        return view('application.transporter.details', [
            'transporter' => $transporter,
            'location' => $location
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\transporter  $transporter
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, transporter $transporter, $id)
    {
        if (Auth::user()->roles == "client") {
            abort(403);
        }

        $payment_type = PaymentMethod::all();
        $payment_status = PaymentStatus::all();
        if ($request->tab == 'paid') {
            $query = TransporterDetailView::where('transporter_id', $id)->where('status', 'COMPLETED')->where('transporter_paid_status', 'PAID')->latest('transporter_reference_number');
            $tab = 'paid';
        } else if ($request->tab == 'unpaid') {
            $query = TransporterDetailView::where('transporter_id', $id)->where('status', 'COMPLETED')->where('transporter_paid_status', NULL)->latest('id');
            $tab = 'unpaid';
        } else {
            $query = TransporterDetailView::where('transporter_id', $id)->where('status', 'OTW')->latest('id');
            $tab = 'due';
        }

        $invoices = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::partial('drivers.name'),
                AllowedFilter::partial('platenumbers.number_plate'),
                AllowedFilter::partial('invoice_number'),
                AllowedFilter::partial('do_number'),
                AllowedFilter::partial('receipt_tran_number'),
                AllowedFilter::partial('total_quantity'),
                AllowedFilter::partial('total_inaccurate'),
                AllowedFilter::partial('status'),
                AllowedFilter::partial('transporter_paid_status'),


            ])
            ->simplePaginate(20)
            ->appends(request()->query());

        return view('application.transporter.show', [
            'invoices' => $invoices,
            'id' => $id,
            'tab' => $tab,
            'payment_type' => $payment_type,
            'payment_status' => $payment_status,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\transporter  $transporter
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, transporter $transporter, $id)
    {
        if (Auth::user()->roles == "client") {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if (Auth::user()->roles == "superadmin") {
            $sites = Site::all();
        } elseif (Auth::user()->roles == "admin_company") {
            $sites = Site::where('company_id', $currentCompany->id)->get();
        } else {
            $sites = Site::where('id', $currentSites)->get();
        }
        $transporter = Transporter::where('id', $id)->first();
        $location = TransporterLocation::where('transport_id', $id)->get();
        return view('application.transporter.edit', [
            'transporter' => $transporter,
            'location' => $location,
            'sites' => $sites
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\transporter  $transporter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transporter $transporter, $id)
    {
        //dd($id);
        if (Auth::user()->roles == "client") {
            abort(403);
        }
        $request->validate([
            'sites_id' => 'required',
            'company_name' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:transporters,email,' . $request->sites_id . ',sites_id',
            'price.*' => 'required',
            'location_name.*' => 'required|distinct',
        ]);



        $transporter = Transporter::where('id', $id)->first();

        $location_name = $request->location_name;
        $price = $request->price;


        foreach ($location_name as $id => $key) {
            $result[$id] = array(
                'location_name'  => $location_name[$id],
                'price' => $price[$id],
            );
        }


        if (!empty($request->id)) {
            foreach ($request->id as $k => $id) {
                array_push($result[$k], $id);
            }
        }

        $p = array();
        if (!empty($request->id)) {
            foreach ($request->id as $data) {
                $p[] = $data;
            }
        }

        //dd($result);
        $transporter->update([
            $transporter->company_name = request()->company_name,
            $transporter->sites_id = request()->sites_id,
            $transporter->name = request()->name,
            $transporter->address = request()->address,
            $transporter->phone = request()->phone,
            $transporter->email = request()->email,
            $transporter->remark = request()->remark,
        ]);


        foreach ($result as $result) {

            $getdeleted = TransporterLocation::whereNotIn('id', $p)->where('transport_id', $transporter->id)->delete();

            if (array_key_exists('0', $result)) {
                $update = DB::table('transporter_locations')
                    ->where('id', $result[0])
                    ->update([
                        'name' => $result['location_name'],
                        'price' => $result['price'] * 100,
                    ]);
            } else {
                // dd($transporter->id);
                $transpoterLocation = new TransporterLocation;
                $transpoterLocation->transport_id = $transporter->id;
                $transpoterLocation->name = $result['location_name'];
                $transpoterLocation->price = $result['price'] * 100;
                $transpoterLocation->save();
            }
        }

        session()->flash('alert-success', 'Success Update');
        return redirect()->route('transporter');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\transporter  $transporter
     * @return \Illuminate\Http\Response
     */
    public function destroy(transporter $transporter, $id)
    {
        if (Auth::user()->roles == "client") {
            abort(403);
        }
        $transporter = Transporter::where('id', $id)->delete();
        $transporter_location = TransporterLocation::where('transport_id', $id)->delete();

        session()->flash('alert-success', "Success Delete");
        return redirect()->route('transporter');
    }

    public function transporterselected($id)
    {
        //$data = $id;
        $transporter = DB::select("SELECT SUM(total_quantity) AS total_tan, SUM(total) AS total_amount, SUM(total_inaccurate) AS total_arrived FROM transporter_detail_view WHERE id IN ($id)");
        //$transporter = TransporterDetailView::whereIn('id', [$id])->get();
        return response()->json($transporter);
    }

    public function createreceipttransporter(Request $request)
    {
        //return response()->json($request->checkID);
        // dd($request->checkID);
        $request->validate([
            'net_pay' => 'required|numeric|same:amount_arrived',
            'payment_status' => 'required',
            'payment_type' => 'required',
            'reference_number_tran' => 'required',
        ]);

        $count = ReceiptTransporter::count();
        if ($count > 0) {
            $rec_no = ReceiptTransporter::latest()->first()->id;
            $date = date("dmY");
            $invoice_number = sprintf('%06d', intval($rec_no) + 1);
            $rc_number = "REC-TRAN-" . $date . '/' . $invoice_number;
        } else {
            $rec_no = 0;
            $date = date("dmY");
            $invoice_number = sprintf('%06d', intval($rec_no) + 1);
            $rc_number = "REC-TRAN-" . $date . '/' . $invoice_number;
        }

        $reference_number = date("YmdHis");
        $invoice_id = explode(",", $request->checkID);
        $sites_id = Invoice::where('id', $invoice_id[0])->first();
        foreach ($invoice_id as $inv_id) {
            $receipttransporter = new ReceiptTransporter;
            $receipttransporter->invoice_id = $inv_id;
            $receipttransporter->sites_id = $sites_id->sites_id;
            $receipttransporter->receipt_number_transporter = $rc_number;
            $receipttransporter->reference_number = $reference_number;
            $receipttransporter->reference_number_transporter = $request->reference_number_tran;
            $receipttransporter->payment_type = $request->payment_type;
            $receipttransporter->payment_status = $request->payment_status;
            $receipttransporter->quantity_start = $request->qty_start;
            $receipttransporter->quantity_arrived = $request->qty_arrived;
            $receipttransporter->quantity_shortage = $request->qty_shortage;
            $receipttransporter->amount_start = $request->amount_start;
            $receipttransporter->amount_arrived = $request->amount_arrived * 100;
            $receipttransporter->amount_shortage = $request->amount_shortage;
            $receipttransporter->net_pay_amount = $request->net_pay * 100;
            $receipttransporter->balance = $request->balance;
            $receipttransporter->discount = $request->discount;
            $receipttransporter->save();

            $invoices = DB::table('invoices')
                ->where('id', $inv_id)
                ->update([
                    'receipt_tran_number' => $rc_number,
                    'transporter_paid_status' => Invoice::STATUS_PAID,
                    'transporter_reference_number' => $reference_number,
                ]);
        }
        if ($request->payment_type == 1) {
            $last_balance = PettyCash::where('sites_id', $sites_id->sites_id)->latest()->first();
            if (empty($last_balance)) {
                $balance = 0;
            } else {
                $balance = $last_balance->balance;
            }
            $pettyCash = new PettyCash;
            $pettyCash->detail = "Transporter Cash($rc_number)";
            $pettyCash->sites_id = $sites_id->sites_id;
            $pettyCash->date = date("Y-m-d");
            $pettyCash->time = date("h:i:s");
            $pettyCash->credit = $request->net_pay * 100;
            $pettyCash->balance = $balance + $request->net_pay * 100;
            $pettyCash->save();
        }

        session()->flash('alert-success', __('messages.done_added'));
        return response()->json($request);
    }

    public function detailsreceipt(Request $request, $id, $tab, $transport)
    {
        if (Auth::user()->roles == "client") {
            abort(403);
        }
        //dd($transport);
        $receipttransporter = ReceiptTransporter::where('reference_number', $transport)->first();

        //dd($receipttransporter);

        return view('application.transporter.detailsreceipt', [
            'receipttransporter' => $receipttransporter,
        ]);
    }
}
