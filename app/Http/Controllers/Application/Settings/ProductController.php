<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\Application\Settings\Product\Update;
use Auth;

class ProductController extends Controller
{
    /**
     * Display Product Settings Page
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::user()->can('setting-product-view')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        if(Auth::user()->roles =="superadmin"){
        // Get Expense Categories by Company
        $product_units = ProductUnit::simplePaginate(15);
        }else{
        // Get Product Units by Company
        $product_units = ProductUnit::findByCompany($currentCompany->id)->simplePaginate(15);
        }


        return view('application.settings.product.index', [
            'product_units' => $product_units,
        ]);
    }

    /**
     * Update the Product Settings
     *
     * @param \App\Http\Requests\Application\Settings\Product\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        if (!Auth::user()->can('setting-product-edit')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Update each settings in database
        foreach ($request->validated() as $key => $value) {
            $currentCompany->setSetting($key, $value);
        } 

        session()->flash('alert-success', __('messages.product_settings_updated'));
        return redirect()->route('settings.product');
    }
}
