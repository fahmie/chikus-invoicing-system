<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Settings\ProductUnit\Store;
use App\Http\Requests\Application\Settings\ProductUnit\Update;
use App\Models\Company;
use Auth;

class ProductUnitController extends Controller
{ 
    /**
     * Display the Form for Creating New Product Unit
     *
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!Auth::user()->can('setting-productunit-create')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        $product_unit = new ProductUnit();

        // Fill model with old input
        if (!empty($request->old())) {
            $product_unit->fill($request->old());
        }
        if(Auth::user()->roles =="superadmin"){
            $company = Company::all();
        }else{
            $company = Company::where('id', $currentCompany->id)->paginate(15);
        }
        return view('application.settings.product.unit.create', [
            'product_unit' => $product_unit,
            'company' => $company,
        ]);
    }
 
    /**
     * Store the Product Unit in Database
     *
     * @param \App\Http\Requests\Application\Settings\ProductUnit\Store $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        if (!Auth::user()->can('setting-productunit-create')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Create Product Unit and Store in Database
        ProductUnit::create([
            'name' => $request->name,
            'company_id' =>  $request->company_id,
        ]);
 
        session()->flash('alert-success', __('messages.product_unit_category_added'));
        return redirect()->route('settings.product');
    }

    /**
     * Display the Form for Editing Product Unit
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {       
        if (!Auth::user()->can('setting-productunit-edit')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        $product_unit = ProductUnit::findOrFail($request->product_unit);
        if(Auth::user()->roles =="superadmin"){
            $company = Company::all();
        }else{
            $company = Company::where('id', $currentCompany->id)->paginate(15);
        }
 
        return view('application.settings.product.unit.edit', [
            'product_unit' => $product_unit,
            'company' => $company,
        ]);
    }

    /**
     * Update the Product Unit
     *
     * @param \App\Http\Requests\Application\Settings\ProductUnit\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        if (!Auth::user()->can('setting-productunit-edit')) {
            abort(403);
        }
        $product_unit = ProductUnit::findOrFail($request->product_unit);
        
        // Update Product Unit in Database
        $product_unit->update([
            'name' => $request->name
        ]);
 
        session()->flash('alert-success', __('messages.product_unit_category_updated'));
        return redirect()->route('settings.product');
    }

    /**
     * Delete the Product Unit
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        if (!Auth::user()->can('setting-productunit-delete')) {
            abort(403);
        }
        $product_unit = ProductUnit::findOrFail($request->product_unit);
        
        // Delete Product Unit from Database
        $product_unit->delete();

        session()->flash('alert-success', __('messages.product_unit_category_deleted'));
        return redirect()->route('settings.product');
    }
}
