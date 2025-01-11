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

class IntransitController extends Controller
{
    public function indextransaction(Request $request, $id)
    {
        if (!Auth::user()->can('intransit-view')) {
            abort(403);
        }


        $receipts = Receipt::all();
        if ($request->tab == 'unpaid') {
            $query = Invoice::where('client_id', $id)->where('status', 'COMPLETED')->where('paid_status', '!=', 'PAID')->latest('id');
            $tab = 'unpaid';
        } else if ($request->tab == 'due') {
            $query = Invoice::where('status', 'OTW')->where('client_id', $id)->latest('id');
            $tab = 'due';
        } else {
            $query = Invoice::where('client_id', $id)->where('status', 'COMPLETED')->where('paid_status', 'PAID')->latest('id');
            $tab = 'paid';
        }
        // Apply Filters and Paginate
        $completeds = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::partial('invoice_number'),
                AllowedFilter::partial('do_number'),
                AllowedFilter::partial('receipt_number'),
                AllowedFilter::partial('platenumbers.number_plate'),
                AllowedFilter::partial('transporters.company_name'),
                AllowedFilter::partial('transporterlocation.name'),
                AllowedFilter::exact('accurate'),
                AllowedFilter::exact('status'),
                AllowedFilter::exact('items.quantity'),
                AllowedFilter::exact('accurate_remark'),
                AllowedFilter::partial('drivers.name'),

                //AllowedFilter::partial('clients.company_name'),
                //AllowedFilter::partial('invoice_date'),
                //AllowedFilter::partial('paid_status'),
                //AllowedFilter::partial('drivers.name'),
            ])
            ->latest()
            ->simplePaginate(10)
            ->appends(request()->query());

        return view('application.intransit.index', [
            'completeds' => $completeds,
            'tab' => $tab,
            'id' => $id,
            'receipts' => $receipts,
        ]);
    }
}
