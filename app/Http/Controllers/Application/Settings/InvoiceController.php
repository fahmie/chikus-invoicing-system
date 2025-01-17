<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\Settings\Invoice\Update;
use Auth;

class InvoiceController extends Controller
{
    /**
     * Display Invoice Settings Page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('setting-invoice-view')) {
            abort(403);
        }
        return view('application.settings.invoice.index');
    }

    /**
     * Update the Invoice Settings
     *
     * @param \App\Http\Requests\Application\Settings\Invoice\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        if (!Auth::user()->can('setting-invoice-edit')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        
        // Update each settings in database
        foreach ($request->validated() as $key => $value) {
            $currentCompany->setSetting($key, $value);
        } 

        session()->flash('alert-success', __('messages.invoice_settings_updated'));
        return redirect()->route('settings.invoice');
    }

}
