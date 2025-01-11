<?php

namespace App\Http\Controllers\Application\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\ProductInventory;
use App\Models\Supplier;
use App\Models\Site;
use App\Models\Country;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exports\InventoryExport;
use File;
use Auth;
use DB;

class InventoryManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::user()->can('inventory-management-view')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if (Auth::user()->roles == "superadmin") {
            $suppliers = Inventory::with("suppliers", "sites")->select('supplier_id')->distinct('supplier_id')->get();
            $inventory = array();
            foreach ($suppliers as $supplier) {
                //$inventory[$supplier->suppliers->name] = Inventory::where('supplier_id',$supplier->supplier_id)->paginate(1,['*'], str_replace(" ","_",$supplier->suppliers->name));
                $inventory[$supplier->suppliers->name] = Inventory::where('supplier_id', $supplier->supplier_id);

                $inventory[$supplier->suppliers->name] = QueryBuilder::for($inventory[$supplier->suppliers->name])
                    ->allowedFilters([
                        AllowedFilter::partial('date'),
                        AllowedFilter::partial('time'),
                        AllowedFilter::exact('sites_id'),
                        AllowedFilter::exact('product_id'),
                        AllowedFilter::exact('supplier_id'),
                        AllowedFilter::partial('stock_in'),
                        AllowedFilter::partial('stock_out'),
                        AllowedFilter::partial('remark'),

                    ])
                    ->latest()
                    ->simplePaginate(10, ['*'], str_replace(" ", "_", $supplier->suppliers->name))
                    ->appends(request()->query());
            }
        } elseif (Auth::user()->roles == "admin_company") {
            $sites_id = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $suppliers = Inventory::with("suppliers", "sites")->select('supplier_id')->distinct('supplier_id')->whereIn('sites_id', $sites_id)->get();
            $inventory = array();
            foreach ($suppliers as $supplier) {
                $inventory[$supplier->suppliers->name] = Inventory::where('supplier_id', $supplier->supplier_id);

                $inventory[$supplier->suppliers->name] = QueryBuilder::for($inventory[$supplier->suppliers->name])
                    ->allowedFilters([
                        AllowedFilter::partial('date'),
                        AllowedFilter::partial('time'),
                        AllowedFilter::exact('sites_id'),
                        AllowedFilter::exact('product_id'),
                        AllowedFilter::exact('supplier_id'),
                        AllowedFilter::partial('stock_in'),
                        AllowedFilter::partial('stock_out'),
                        AllowedFilter::partial('remark'),

                    ])
                    ->latest()
                    ->simplePaginate(10, ['*'], str_replace(" ", "_", $supplier->suppliers->name))
                    ->appends(request()->query());
            }
        } else {
            $suppliers = Inventory::with("suppliers", "sites")->select('supplier_id')->distinct('supplier_id')->get();
            $inventory = array();
            foreach ($suppliers as $supplier) {
                $inventory[$supplier->suppliers->name] = Inventory::where('supplier_id', $supplier->supplier_id);

                $inventory[$supplier->suppliers->name] = QueryBuilder::for($inventory[$supplier->suppliers->name])
                    ->allowedFilters([
                        AllowedFilter::partial('date'),
                        AllowedFilter::partial('time'),
                        AllowedFilter::exact('sites_id'),
                        AllowedFilter::exact('product_id'),
                        AllowedFilter::exact('supplier_id'),
                        AllowedFilter::partial('stock_in'),
                        AllowedFilter::partial('stock_out'),
                        AllowedFilter::partial('remark'),

                    ])
                    ->latest()
                    ->simplePaginate(10, ['*'], str_replace(" ", "_", $supplier->suppliers->name))
                    ->appends(request()->query());
            }
        }


        return view('application.inventory_management.index', compact('inventory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!Auth::user()->can('inventory-management-addstock')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if (Auth::user()->roles == "superadmin") {
            $sites = Site::all();
            $supplier = Supplier::all();
            $productinventory = ProductInventory::all();
        } elseif (Auth::user()->roles == "admin_company") {
            $sitebycompany = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $sites = Site::where('company_id', $currentCompany->id)->get();
            $supplier = Supplier::whereIn('sites_id', $sitebycompany)->get();
            $productinventory = ProductInventory::whereIn('sites_id', $sitebycompany)->get();
        } else {
            $sites = Site::all();
            $supplier = Supplier::all();
            $productinventory = ProductInventory::all();
        }

        return view('application.inventory_management.create', compact('sites', 'supplier', 'productinventory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can('inventory-management-stockin')) {
            abort(403);
        }

        $request->validate([
            'sites_id' => 'required',
            'supplier_id' => 'required',
            'product_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'stock_in' => 'required|numeric',
        ]);
        $last_balance = Inventory::where('sites_id', request()->sites_id)->where('supplier_id', request()->supplier_id)->where('product_id', request()->product_id)->latest()->first();
        if (empty($last_balance)) {
            $balance = 0;
        } else {
            $balance = $last_balance->stock;
        }
        $inventory = new Inventory;
        $inventory->sites_id = request()->sites_id;
        $inventory->supplier_id = request()->supplier_id;
        $inventory->product_id = request()->product_id;
        $inventory->date = request()->date;
        $inventory->time = request()->time;
        $inventory->stock_in = request()->stock_in;
        $inventory->remark = request()->remark;
        $inventory->stock = $balance + request()->stock_in;
        $inventory->save();

        session()->flash('alert-success', 'Success');
        return redirect()->route('managements.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory, $id)
    {
        if (!Auth::user()->can('inventory-management-view')) {
            abort(403);
        }

        $inventory = Inventory::find($id);
        return view('application.inventory_management.view', compact('inventory'));
    }

    public function stockout(Request $request)
    {
        if (!Auth::user()->can('inventory-management-deductstock')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if (Auth::user()->roles == "superadmin") {
            $sites = Site::all();
            $supplier = Supplier::all();
            $country = Country::all();
            $productinventory = ProductInventory::all();
        } elseif (Auth::user()->roles == "admin_company") {
            $sitebycompany = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $sites = Site::where('company_id', $currentCompany->id)->get();
            $supplier = Supplier::whereIn('sites_id', $sitebycompany)->get();
            $productinventory = ProductInventory::whereIn('sites_id', $sitebycompany)->get();
            $country = Country::all();
        } else {
            $sites = Site::all();
            $supplier = Supplier::all();
            $productinventory = ProductInventory::all();
            $country = Country::all();
        }

        return view('application.inventory_management.deduct', compact('sites', 'supplier', 'productinventory', 'country'));
    }


    public function stockout_store(Request $request)
    {
        if (!Auth::user()->can('inventory-management-stockout')) {
            abort(403);
        }

        $last_balance = Inventory::where('sites_id', request()->sites_id)->where('supplier_id', request()->supplier_id)->where('product_id', request()->product_id)->latest()->first();
        if (empty($last_balance)) {
            $balance = 0;
        } else {
            $balance = $last_balance->stock;
        }

        $request->validate([
            'sites_id' => 'required',
            'supplier_id' => 'required',
            'product_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'stock_out' => 'required|numeric|min:1|max:' . $last_balance->stock,
            'customer_name' => 'required',
            'customer_address' => 'required',
            'customer_country' => 'required',
        ]);

        $inventory = new Inventory;
        $inventory->sites_id = request()->sites_id;
        $inventory->supplier_id = request()->supplier_id;
        $inventory->product_id = request()->product_id;
        $inventory->date = request()->date;
        $inventory->time = request()->time;
        $inventory->stock_out = request()->stock_out;
        $inventory->remark = request()->remark;
        $inventory->stock = $balance - request()->stock_out;
        $inventory->customer_name = request()->customer_name;
        $inventory->customer_address = request()->customer_address;
        $inventory->customer_email = request()->customer_email;
        $inventory->customer_phone = request()->customer_phone;
        $inventory->customer_country = request()->customer_country;
        $inventory->save();

        session()->flash('alert-success', 'Success');
        return redirect()->route('managements.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        if (!Auth::user()->can('inventory-management-edit')) {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        if (!Auth::user()->can('inventory-management-update')) {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        if (!Auth::user()->can('inventory-management-delete')) {
            abort(403);
        }
    }

    public function getProductBySupplierID($id)
    {
        $productinventory = ProductInventory::where('id', $id)->get();
        return response()->json($productinventory);
    }

    public function export(Request $request)
    {
        if (!Auth::user()->can('inventory-management-export')) {
            abort(403);
        }

        $request->validate([
            'date_from' => 'required',
            'date_end' => 'required',
            'supplier_id' => 'required',
        ]);

        return (new InventoryExport)->fromDate($request->date_from)->endDate($request->date_end)->supplier($request->supplier_id)->download('inventory.xlsx');
    }
}
