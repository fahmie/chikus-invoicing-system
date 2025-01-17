<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\Settings\Preference\Update;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanySetting;
use Auth;
class PreferenceController extends Controller
{
    /**
     * Display Preferences Page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('setting-preferences-view')) {
            abort(403);
        }

        return view('application.settings.preference.index');
    }

    /**
     * Update the Preferences
     *
     * @param \App\Http\Requests\Application\Settings\Preference\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        if (!Auth::user()->can('setting-preferences-edit')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
 
        // Update each settings in database
        foreach ($request->validated() as $key => $value) {
            $currentCompany->setSetting($key, $value);
        } 

        session()->flash('alert-success', __('messages.preferences_updated'));
        return redirect()->route('settings.preferences');
    }
}
