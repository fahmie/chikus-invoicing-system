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

class CompletedController extends Controller
{
    public function indexcompleted(Request $request)
    {
        if (!Auth::user()->can('completed-delivery-view')) {
            abort(403);
            }
        $receipts = Receipt::all();
        $clientid = Auth::user()->client_id;
        if(Auth::user()->roles =="client"){
            // $query = Invoice::where('status', 'COMPLETED')->where('client_id', $clientid);
            if($request->tab == 'paid') {
                $query = Invoice::where('status', 'COMPLETED')->where('paid_status', 'PAID')->where('client_id', $clientid);
                $tab = 'paid';
            } else { 
                $query = Invoice::where('status', 'COMPLETED')->where('paid_status', '!=', 'PAID')->where('client_id', $clientid);
                $tab = 'unpaid';
            }
        }
        else{
            if($request->tab == 'paid') {
                $query = Invoice::where('status', 'COMPLETED')->where('paid_status', 'PAID')->whereNotNull('client_id');
                $tab = 'paid';
            } else { 
                $query = Invoice::where('status', 'COMPLETED')->where('paid_status', '!=', 'PAID')->whereNotNull('client_id');
                $tab = 'unpaid';
            }
            // $query = Invoice::where('status', 'COMPLETED');
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
       

        return view('application.customers.index', [
            'invoices' => $invoices,
            'tab' => $tab,
            'receipts' => $receipts,

        ]);
    }

    public function tracking(Request $request,$id)
    {
        $trackings = Trackinginfo::where('invoice_id', $id)->get();
        return view('application.customers.create', [
            'trackings' => $trackings,
        ]);
    }
}
