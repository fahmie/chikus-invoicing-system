<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\Settings\Estimate\Update;
use Auth;
class EstimateController extends Controller
{
    /**
     * Display Estimate Settings Page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->roles =="client" || Auth::user()->roles =="staff")
        {
            abort(403);
        }
        return view('application.settings.estimate.index');
    }

    /**
     * Update the Estimate Settings
     *
     * @param \App\Http\Requests\Application\Settings\Estimate\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        if(Auth::user()->roles =="client" || Auth::user()->roles =="staff")
        {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
 
        // Update each settings in database
        foreach ($request->validated() as $key => $value) {
            $currentCompany->setSetting($key, $value);
        } 
        
        session()->flash('alert-success', __('messages.estimate_settings_updated'));
        return redirect()->route('settings.estimate');
    }
}
