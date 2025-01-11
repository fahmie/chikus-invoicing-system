<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Estimate;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\Client;
use App\Models\Driver;
use App\Models\Site;
use App\Models\Company;
use App\Models\PettyCash;
use Carbon\Carbon;
use App\Models\PaymentMethod;
use App\Models\Payment;
use App\Models\PaymentStatus;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use PDF;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display Dashboard Page
     * 
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::user()->can('dashboard-view')) {
            abort(403);
        }
        // return response()->json($site);
        $current_year = date("Y");
        $current_month = date("n");
        $number = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
        // dd($number);
        $day = array();
        for ($x = 1; $x <= $number; $x++) {
            $day[] = "`$x`";
            $day1[] = $x;
        }
        $days = implode(",", $day);
        $days1 = implode(",", $day1);

        $user = $request->user();
        $company = $user->currentCompany();
        if (!empty($request->sites)) {
            $currentSites = $request->sites;
        } else {
            $currentSites = $user->sites_id;
        }
        if (!empty($request->sites_ina)) {
            $currentSites2 = $request->sites_ina;
        } else {
            $currentSites2 = $user->sites_id;
        }
        if (!empty($request->sites_trip)) {
            $currentSites3 = $request->sites_trip;
        } else {
            $currentSites3 = $user->sites_id;
        }


        if (Auth::user()->roles == "superadmin") {

            $otws = Invoice::where('status', 'OTW')->latest()->simplePaginate(10);
            $pettyCash = PettyCash::latest()->simplePaginate(10);
            $month_year = DB::table('invoices')
                ->select(DB::raw('YEAR(created_at) as year'))
                ->distinct()
                ->get();
            $sites = Site::all();
        } elseif (Auth::user()->roles == "admin_company") {
            $sites_id = Site::select('id')->where('company_id', $company->id)->get();
            $otws = Invoice::where('status', 'OTW')->whereIn('sites_id', $sites_id)->latest()->simplePaginate(10);
            $pettyCash = PettyCash::whereIn('sites_id', $sites_id)->latest()->simplePaginate(10);
            $month_year = DB::table('invoices')
                ->select(DB::raw('YEAR(created_at) as year'))
                ->whereIn('sites_id', $sites_id)
                ->distinct()
                ->get();
            $sites = Site::where('company_id', $company->id)->get();
        } else {
            $otws = Invoice::where('status', 'OTW')->where('sites_id', $currentSites)->latest()->simplePaginate(10);
            $pettyCash = PettyCash::where('sites_id', $currentSites)->latest()->simplePaginate(10);
            $month_year = DB::table('invoices')
                ->select(DB::raw('YEAR(created_at) as year'))
                ->where('sites_id', $currentSites)
                ->distinct()
                ->get();
            $sites = Site::where('id', $currentSites)->get();
        }

        $completed = Invoice::where('status', 'COMPLETED')->latest()->simplePaginate(5);
        // $month_year = DB::table('invoices')
        // ->select(DB::raw('YEAR(created_at) as year'))
        // ->distinct()
        // ->get();
        //   $month_year =  Invoice::get()->groupBy(function($item) {
        //    return $item->invoice_date->format('m-Y');
        //    });
        //  dd($month_year);
        //  foreach($month_year as $year){
        //     dd($year->year);
        //  }

        // Dashboard Stats
        $customersCount = Customer::findByCompany($company->id)->count();
        $invoicesCount = Invoice::findByCompany($company->id)->count();
        $invoicesItemCount = InvoiceItem::findByCompany($company->id)->count();
        // $clientsCount = Client::findByClientID($company->id)->count();
        $clientsCount = Client::findClient()->count();
        // $driversCount = Driver::findByDriverID($company->id)->count();
        $driversCount = Driver::findDriver()->count();

        $estimatesCount = Estimate::findByCompany($company->id)->count();
        $totalDueAmount = Invoice::findByCompany($company->id)->active()->sum('due_amount');

        // Due Invoices and Estimates
        $dueInvoices = Invoice::findByCompany($company->id)->active()->where('due_amount', '>', 0)->take(5)->latest()->get();
        $dueEstimates = Estimate::findByCompany($company->id)->active()->take(5)->latest('expiry_date')->get();

        // Financial Year Starts-Ends
        $financialYearStarts = $company->getSetting('financial_month_starts');
        $financialYearEnds = $company->getSetting('financial_month_ends');

        // Create Carbon Instances from Financial Year
        $dateStarts = Carbon::now()->month($financialYearStarts)->startOfMonth();
        $dateEnds = Carbon::now()->month($financialYearEnds)->endOfMonth();
        // $pettyCash = QueryBuilder::for(PettyCash::class)
        // ->allowedFilters([
        //     AllowedFilter::partial('date'),
        //     AllowedFilter::partial('time'),
        //     AllowedFilter::partial('detail'),
        //     AllowedFilter::partial('debit'),
        //     AllowedFilter::partial('credit'),
        //     AllowedFilter::partial('remark'),

        // ])
        // ->latest()
        // ->simplePaginate(10)
        // ->appends(request()->query());


        // if the date ends is smaller than date start, add one year to date ends
        if ($dateEnds->lt($dateStarts)) {
            $dateEnds->addYear(1)->endOfMonth();
        }

        // Create Period from given dates
        $period = CarbonPeriod::since($dateStarts)->months(1)->until($dateEnds);

        // Arrays for Expenses Chart
        $expense_stats_label = [];
        $expense_stats = [];

        // Iterate over the Date Period 
        foreach ($period as $date) {
            // Add month as label
            $month = $date->format('M');
            array_push($expense_stats_label, $month);

            // Add Expense amount for current month
            $expense = Expense::findByCompany($company->id)
                ->get(['amount', 'expense_date'])
                ->whereBetween('expense_date', [$date->format('Y-m-d'), $date->endOfMonth()->format('Y-m-d')])
                ->sum('amount');
            array_push($expense_stats, $expense / 100);
        }

        //Sales Report
        //monthly
        $total_sales_unit = DB::select("SELECT `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec` FROM `sales_report_monthly_unit_type_view_new` WHERE type =1 AND sites_id =" . $currentSites . " AND year =" . $current_year . "");

        $total_sales_unit2 = DB::select("SELECT `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec` FROM `sales_report_monthly_unit_type_view_new` WHERE type =2 AND sites_id =" . $currentSites . " AND year =" . $current_year . "");

        $total_sales_rm_all = DB::select("SELECT `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec` FROM `sales_report_monthly_rm_view_new` WHERE sites_id =" . $currentSites . " AND year =" . $current_year . "");

        $total_sales_unit_all = DB::select("SELECT `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec` FROM `sales_report_monthly_unit_view_new` WHERE sites_id =" . $currentSites . " AND year =" . $current_year . "");

        $total_sales_rm_con = DB::select("SELECT `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec` FROM `sales_report_monthly_rm_type_view_new` WHERE type =1 AND sites_id =" . $currentSites . " AND year =" . $current_year . "");

        $total_sales_rm_cash = DB::select("SELECT `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec` FROM `sales_report_monthly_rm_type_view_new` WHERE type =2 AND sites_id =" . $currentSites . " AND year =" . $current_year . "");
        //monthly

        //dd($total_sales_unit);

        //daily
        $total_sales_unit_daily = DB::select("SELECT " . $days . " FROM `sales_report_daily_unit_type_view_new` WHERE type =1 AND sites_id =" . $currentSites . " AND month =" . $current_month . " AND year =" . $current_year . "");

        $total_sales_unit2_daily = DB::select("SELECT " . $days . " FROM `sales_report_daily_unit_type_view_new` WHERE type =2 AND sites_id =" . $currentSites . " AND month =" . $current_month . " AND year =" . $current_year . "");

        $total_sales_rm_all_daily = DB::select("SELECT " . $days . " FROM `sales_report_daily_rm_view_new` WHERE sites_id =" . $currentSites . " AND month =" . $current_month . " AND year =" . $current_year . "");

        $total_sales_unit_all_daily = DB::select("SELECT " . $days . " FROM `sales_report_daily_unit_view_new` WHERE sites_id =" . $currentSites . " AND month =" . $current_month . " AND year =" . $current_year . "");

        $total_sales_rm_con_daily = DB::select("SELECT " . $days . " FROM `sales_report_daily_rm_type_view_new` WHERE type =1 AND sites_id =" . $currentSites . " AND month =" . $current_month . " AND year =" . $current_year . "");

        $total_sales_rm_cash_daily = DB::select("SELECT " . $days . " FROM `sales_report_daily_rm_type_view_new` WHERE type =2 AND sites_id =" . $currentSites . " AND month =" . $current_month . " AND year =" . $current_year . "");
        //daily


        $total_sales_con_mt = [];
        $month = [];

        foreach ($total_sales_unit as $data) {

            foreach ($data as $key => $dat) {
                $month[] = '"' . $key . '"';
                $total_sales_con_mt[] = $dat / 1;
            }
        }

        $total_sales_cash_mt = [];

        foreach ($total_sales_unit2 as $data) {

            foreach ($data as $key => $dat) {
                $total_sales_cash_mt[] = $dat / 1;
            }
        }


        $tot_sales_rm_all = [];

        foreach ($total_sales_rm_all as $data) {

            foreach ($data as $key => $dat) {
                $tot_sales_rm_all[] = $dat / 100;
            }
        }


        $tot_sales_rm_con = [];

        foreach ($total_sales_rm_con as $data) {

            foreach ($data as $key => $dat) {
                $tot_sales_rm_con[] = $dat / 100;
            }
        }

        $tot_sales_rm_cash = [];

        foreach ($total_sales_rm_cash as $data) {

            foreach ($data as $key => $dat) {
                $tot_sales_rm_cash[] = $dat / 100;
            }
        }

        $tot_sales_mt_all = [];

        foreach ($total_sales_unit_all as $data) {

            foreach ($data as $key => $dat) {
                $tot_sales_mt_all[] = $dat / 1;
            }
        }

        //daily
        $total_sales_con_mt_daily = [];
        $daily = [];

        foreach ($total_sales_unit_daily as $data) {

            foreach ($data as $key => $dat) {
                $daily[] = '"' . $key . '"';
                $total_sales_con_mt_daily[] = $dat / 1;
            }
        }

        $total_sales_cash_mt_daily = [];

        foreach ($total_sales_unit2_daily as $data) {

            foreach ($data as $key => $dat) {
                $total_sales_cash_mt_daily[] = $dat / 1;
            }
        }


        $tot_sales_rm_all_daily = [];

        foreach ($total_sales_rm_all_daily as $data) {

            foreach ($data as $key => $dat) {
                $tot_sales_rm_all_daily[] = $dat / 100;
            }
        }


        $tot_sales_rm_con_daily = [];

        foreach ($total_sales_rm_con_daily as $data) {

            foreach ($data as $key => $dat) {
                $tot_sales_rm_con_daily[] = $dat / 100;
            }
        }

        $tot_sales_rm_cash_daily = [];

        foreach ($total_sales_rm_cash_daily as $data) {

            foreach ($data as $key => $dat) {
                $tot_sales_rm_cash_daily[] = $dat / 100;
            }
        }

        $tot_sales_mt_all_daily = [];

        foreach ($total_sales_unit_all_daily as $data) {

            foreach ($data as $key => $dat) {
                $tot_sales_mt_all_daily[] = $dat / 1;
            }
        }
        //daily

        //montly
        //  unset($tot_sales_rm_con[0]);
        //  unset($tot_sales_rm_cash [0]);
        $tot_sales_rm_all = implode(',', $tot_sales_rm_all);
        $tot_sales_rm_con = implode(',', $tot_sales_rm_con);
        $tot_sales_rm_cash = implode(',', $tot_sales_rm_cash);
        $tot_sales_mt_all = implode(',', $tot_sales_mt_all);
        unset($month[0]);
        $bln = implode(',', $month);
        //  unset($total_sales_con_mt[0]);
        $total_sales_con_mt = implode(',', $total_sales_con_mt);
        //  unset($total_sales_cash_mt[0]);
        $total_sales_cash_mt = implode(',', $total_sales_cash_mt);
        //montly

        //daily
        // unset($tot_sales_rm_con_daily[0]);
        // unset($tot_sales_rm_cash_daily[0]);
        $tot_sales_rm_all_daily = implode(',', $tot_sales_rm_all_daily);
        $tot_sales_rm_con_daily = implode(',', $tot_sales_rm_con_daily);
        $tot_sales_rm_cash_daily = implode(',', $tot_sales_rm_cash_daily);
        $tot_sales_mt_all_daily = implode(',', $tot_sales_mt_all_daily);
        unset($daily[0]);
        $hari = implode(',', $daily);
        // unset($total_sales_con_mt_daily[0]);
        $total_sales_con_mt_daily = implode(',', $total_sales_con_mt_daily);
        // unset($total_sales_cash_mt_daily[0]);
        $total_sales_cash_mt_daily = implode(',', $total_sales_cash_mt_daily);
        //daily
        //Sales Report

        //Inaccuracy Report
        //monthly
        $inaccuracy_monthly_rm = DB::select("SELECT `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec` FROM `inaccuracy_report_rm_monthly_view_new` WHERE sites_id =" . $currentSites2 . "  AND year =" . $current_year . "");
        $inaccuracy_monthly_unit = DB::select("SELECT `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec` FROM `inaccuracy_report_unit_monthly_view_new` WHERE sites_id =" . $currentSites2 . " AND year =" . $current_year . "");

        $ina_monthly_rm = [];

        foreach ($inaccuracy_monthly_rm as $data) {

            foreach ($data as $key => $dat) {
                $ina_monthly_rm[] = $dat / 100;
            }
        }

        $ina_monthly_unit = [];

        foreach ($inaccuracy_monthly_unit as $data) {

            foreach ($data as $key => $dat) {
                $ina_monthly_unit[] = $dat / 1;
            }
        }

        $ina_monthly_rm = implode(',', $ina_monthly_rm);
        $ina_monthly_unit = implode(',', $ina_monthly_unit);
        //monthly
        //daily
        $inaccuracy_daily_rm = DB::select("SELECT " . $days . " FROM `inaccuracy_report_rm_daily_view_new` WHERE sites_id =" . $currentSites2 . " AND month =" . $current_month . " AND year =" . $current_year . "");
        $inaccuracy_daily_unit = DB::select("SELECT " . $days . " FROM `inaccuracy_report_unit_daily_view_new` WHERE sites_id =" . $currentSites2 . " AND month =" . $current_month . " AND year =" . $current_year . "");

        $ina_daily_rm = [];

        foreach ($inaccuracy_daily_rm as $data) {

            foreach ($data as $key => $dat) {
                $ina_daily_rm[] = $dat / 100;
            }
        }

        $ina_daily_unit = [];

        foreach ($inaccuracy_daily_unit as $data) {

            foreach ($data as $key => $dat) {
                $ina_daily_unit[] = $dat / 1;
            }
        }

        $ina_daily_rm = implode(',', $ina_daily_rm);
        $ina_daily_unit = implode(',', $ina_daily_unit);
        //daily
        //Inaccuracy Report 

        //Quantity Trip Report
        //monthly
        $trip_monthly_all = DB::select("SELECT `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec` FROM `trip_report_monthly_view_new` WHERE sites_id =" . $currentSites3 . " AND year =" . $current_year . "");
        $trip_monthly_contract = DB::select("SELECT `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec` FROM `trip_report_monthly_type_view_new` WHERE type =1 AND sites_id =" . $currentSites3 . " AND year =" . $current_year . "");
        $trip_monthly_cash = DB::select("SELECT `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec` FROM `trip_report_monthly_type_view_new` WHERE type =2 AND sites_id =" . $currentSites3 . " AND year =" . $current_year . "");

        $tr_monthly_all = [];

        foreach ($trip_monthly_all as $data) {

            foreach ($data as $key => $dat) {
                $tr_monthly_all[] = $dat;
            }
        }

        $tr_monthly_contract = [];

        foreach ($trip_monthly_contract as $data) {

            foreach ($data as $key => $dat) {
                $tr_monthly_contract[] = $dat;
            }
        }

        $tr_monthly_cash = [];

        foreach ($trip_monthly_cash as $data) {

            foreach ($data as $key => $dat) {
                $tr_monthly_cash[] = $dat;
            }
        }

        // unset($tr_monthly_contract[0]);
        // unset($tr_monthly_cash[0]);
        $tr_monthly_all = implode(',', $tr_monthly_all);
        $tr_monthly_contract = implode(',', $tr_monthly_contract);
        $tr_monthly_cash = implode(',', $tr_monthly_cash);
        //monthly
        //daily
        $trip_daily_all = DB::select("SELECT " . $days . " FROM `trip_report_daily_view_new` WHERE sites_id =" . $currentSites3 . " AND month =" . $current_month . " AND year =" . $current_year . "");
        $trip_daily_contract = DB::select("SELECT " . $days . " FROM `trip_report_daily_type_view_new` WHERE type =1 AND sites_id =" . $currentSites3 . " AND month =" . $current_month . " AND year =" . $current_year . "");
        $trip_daily_cash = DB::select("SELECT " . $days . " FROM `trip_report_daily_type_view_new` WHERE type =2 AND sites_id =" . $currentSites3 . " AND month =" . $current_month . " AND year =" . $current_year . "");

        $tr_daily_all = [];

        foreach ($trip_daily_all as $data) {

            foreach ($data as $key => $dat) {
                $tr_daily_all[] = $dat;
            }
        }

        $tr_daily_contract = [];

        foreach ($trip_daily_contract as $data) {

            foreach ($data as $key => $dat) {
                $tr_daily_contract[] = $dat;
            }
        }

        $tr_daily_cash = [];

        foreach ($trip_daily_cash as $data) {

            foreach ($data as $key => $dat) {
                $tr_daily_cash[] = $dat;
            }
        }

        // unset($tr_daily_contract[0]);
        // unset($tr_daily_cash[0]);
        $tr_daily_all = implode(',', $tr_daily_all);
        $tr_daily_contract = implode(',', $tr_daily_contract);
        $tr_daily_cash = implode(',', $tr_daily_cash);
        //daily
        //Quantity Trip Report

        //dd($days1);

        return view('application.dashboard.index', [
            'customersCount' => $customersCount,
            'invoicesCount' => $invoicesCount,
            'invoicesItemCount' => $invoicesItemCount,
            'clientsCount' => $clientsCount,
            'driversCount' => $driversCount,
            'estimatesCount' => $estimatesCount,
            'totalDueAmount' => $totalDueAmount,
            'dueInvoices' => $dueInvoices,
            'dueEstimates' => $dueEstimates,
            'expense_stats_label' => $expense_stats_label,
            'expense_stats' => $expense_stats,
            'currency_code' => $company->currency->code,
            'otws' => $otws,
            'completed' => $completed,
            'pettyCash' => $pettyCash,
            'bln' => $bln,
            'total_sales_con_mt' => $total_sales_con_mt,
            'total_sales_cash_mt' => $total_sales_cash_mt,
            'tot_sales_rm_all' => $tot_sales_rm_all,
            'tot_sales_rm_con' => $tot_sales_rm_con,
            'tot_sales_rm_cash' => $tot_sales_rm_cash,
            'tot_sales_mt_all' => $tot_sales_mt_all,
            'hari' => $hari,
            'total_sales_con_mt_daily' => $total_sales_con_mt_daily,
            'total_sales_cash_mt_daily' => $total_sales_cash_mt_daily,
            'tot_sales_rm_all_daily' => $tot_sales_rm_all_daily,
            'tot_sales_rm_con_daily' => $tot_sales_rm_con_daily,
            'tot_sales_rm_cash_daily' => $tot_sales_rm_cash_daily,
            'tot_sales_mt_all_daily' => $tot_sales_mt_all_daily,
            'ina_monthly_rm' => $ina_monthly_rm,
            'ina_monthly_unit' => $ina_monthly_unit,
            'ina_daily_rm' => $ina_daily_rm,
            'ina_daily_unit' => $ina_daily_unit,
            'tr_monthly_all' => $tr_monthly_all,
            'tr_monthly_contract' => $tr_monthly_contract,
            'tr_monthly_cash' => $tr_monthly_cash,
            'tr_daily_all' => $tr_daily_all,
            'tr_daily_contract' => $tr_daily_contract,
            'tr_daily_cash' => $tr_daily_cash,
            'month_year' => $month_year,
            'sites' => $sites,
            'days1' => $days1,
        ]);
    }

    public function report(Request $request)
    {
        if (!Auth::user()->can('dashboard-export')) {
            abort(403);
        }
        //dd($request->sites_id);
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $client = Client::all();
        $payment_type = PaymentMethod::all();
        $payment_status = PaymentStatus::all();
        $sites = Site::where('id', $request->sites_id)->first();
        $companys = Company::where('id', $sites->company_id)->first();
        $product = Product::all();
        $total_sales_rm = Invoice::whereYear('created_at', '=', $request->year)->whereMonth('created_at', '=', $request->month)->where('sites_id', $request->sites_id)->sum('total');
        $total_sales_contract_rm = Invoice::where('type', '1')->whereYear('created_at', '=', $request->year)->whereMonth('created_at', '=', $request->month)->where('sites_id', $request->sites_id)->sum('total');
        $total_sales_cash_rm = Invoice::where('type', '2')->whereYear('created_at', '=', $request->year)->whereMonth('created_at', '=', $request->month)->where('sites_id', $request->sites_id)->sum('total');

        $data =  Invoice::whereYear('created_at', '=', $request->year)->whereMonth('created_at', '=', $request->month)->where('sites_id', $request->sites_id)->get()->groupBy(function ($item) {
            return $item->invoice_date->format('Y-m-d');
        });


        $total_sales_mt = Invoice::select(DB::raw('SUM(invoice_items.quantity) As total_mt'))
            ->leftJoin('invoice_items', 'invoice_items.invoice_id', '=', 'invoices.id')
            ->whereYear('invoices.created_at', '=', $request->year)
            ->whereMonth('invoices.created_at', '=', $request->month)
            ->where('sites_id', $request->sites_id)
            ->first();

        $total_sales_contract_mt = Invoice::select(DB::raw('SUM(invoice_items.quantity) As total_mt'))
            ->leftJoin('invoice_items', 'invoice_items.invoice_id', '=', 'invoices.id')
            ->where('type', '1')
            ->whereYear('invoices.created_at', '=', $request->year)
            ->whereMonth('invoices.created_at', '=', $request->month)
            ->where('sites_id', $request->sites_id)
            ->first();

        $total_sales_cash_mt = Invoice::select(DB::raw('SUM(invoice_items.quantity) As total_mt'))
            ->leftJoin('invoice_items', 'invoice_items.invoice_id', '=', 'invoices.id')
            ->where('type', '2')
            ->whereYear('invoices.created_at', '=', $request->year)
            ->whereMonth('invoices.created_at', '=', $request->month)
            ->where('sites_id', $request->sites_id)
            ->first();

        //  dd($total_sales_contract_mt->total_mt);

        $total_mt = 0;
        $total_price = 0;
        foreach ($data as $dat) {
            foreach ($dat as $databydate) {
                foreach ($databydate->items as $da) {
                    $total_mt += sprintf('%0.3f', $da->quantity);
                    $total_price += $da->total / 100;
                }
            }
        }

        set_time_limit(300000); // Extends to 5 minutes.
        $pdf = PDF::loadView('application.dashboard.report', [
            'data' => $data,
            'client' => $client,
            'product' => $product,
            'total_mt' => $total_mt,
            'total_price' => $total_price,
            'currentCompany' => $currentCompany,
            'companys' => $companys,
            'total_sales_rm' => $total_sales_rm,
            'total_sales_contract_rm' => $total_sales_contract_rm,
            'total_sales_cash_rm' => $total_sales_cash_rm,
            'total_sales_mt' => $total_sales_mt,
            'total_sales_contract_mt' => $total_sales_contract_mt,
            'total_sales_cash_mt' => $total_sales_cash_mt
        ]);
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setpaper('A4', 'Landscape');
        return $pdf->download('report.pdf');
    }
}
