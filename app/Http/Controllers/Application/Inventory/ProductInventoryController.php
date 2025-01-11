<?php

namespace App\Http\Controllers\Application\Inventory;

use App\Http\Controllers\Controller;
use App\Models\ProductInventory;
use App\Models\ProductUnit;
use App\Models\Site;
use Illuminate\Http\Request;
use Auth;

class ProductInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::user()->can('product-inventory-view')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if (Auth::user()->roles == "superadmin") {
            $productInventory = ProductInventory::simplePaginate(10);
        } elseif (Auth::user()->roles == "admin_company") {
            $sites_id = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $productInventory = ProductInventory::whereIn('sites_id', $sites_id)->simplePaginate(10);
        } else {
            $productInventory = ProductInventory::simplePaginate(10);
        }

        return view('application.inventory_setting.product.index', compact('productInventory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!Auth::user()->can('product-inventory-create')) {
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
            $sites = Site::all();
        }
        $unit = ProductUnit::all();
        return view('application.inventory_setting.product.create', compact('sites', 'unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can('product-inventory-store')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|unique:product_inventories,name,NULL,id,sites_id,' . $request->sites_id,
            'unit_id' => 'required|numeric',
            'sites_id' => 'required|numeric',

        ]);

        $productinventory = new ProductInventory;
        $productinventory->name = request()->name;
        $productinventory->unit_id = request()->unit_id;
        $productinventory->description = request()->description;
        $productinventory->sites_id = request()->sites_id;
        $productinventory->save();

        session()->flash('alert-success', 'Success');
        return redirect()->route('productInventory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductInventory  $productInventory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductInventory $productInventory)
    {
        if (!Auth::user()->can('product-inventory-view')) {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductInventory  $productInventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductInventory $productInventory)
    {
        if (!Auth::user()->can('product-inventory-edit')) {
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
            $sites = Site::all();
        }
        $unit = ProductUnit::all();

        return view('application.inventory_setting.product.edit', compact('productInventory', 'sites', 'unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductInventory  $productInventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductInventory $productInventory)
    {
        if (!Auth::user()->can('product-inventory-update')) {
            abort(403);
        }

        $productInventory->update([
            $productInventory->name = request()->name,
            $productInventory->unit_id = request()->unit_id,
            $productInventory->description = request()->description,
            $productInventory->sites_id = request()->sites_id,
        ]);

        session()->flash('alert-success', "Success Updated");
        return redirect()->route('productInventory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductInventory  $productInventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductInventory $productInventory, $id)
    {
        if (!Auth::user()->can('product-inventory-delete')) {
            abort(403);
        }

        $productInventory = ProductInventory::find($id);
        $productInventory->delete();
        session()->flash('alert-success', "Success Deleted");
        return redirect()->route('productInventory.index');
    }
}
