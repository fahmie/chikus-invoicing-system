<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\Settings\Preference\Update;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanySetting;
use Auth;
class PreferenceController1 extends Controller
{
    /**
     * Display Preferences Page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->roles =="client" || Auth::user()->roles =="staff")
        {
            abort(403);
        }
        $data['company'] = Company::simplePaginate(5);

        return view('application.settings.preference.index', $data);
    }

    public function create()
    {
        if(Auth::user()->roles !="superadmin")
        {
            abort(403);
        }
        $company_id = CompanySetting::select('company_id')->get()->toArray();
        $data['company'] = Company::whereNotIn('id', $company_id)->get();
        return view('application.settings.preference.create', $data);
    }

    public function store(Request $request)
    {
        foreach($request->all() as $key => $data){
            if($key != '_token' || $key != 'company_id')
            {
                $company_setting = new CompanySetting;
                $company_setting->company_id = $request->company_id;
                $company_setting->option = $key;
                $company_setting->value = $data;
                $company_setting->save();
            }


        }
        
        session()->flash('alert-success', 'Success Add Company Setting');
        return redirect()->route('settings.preferences');
    }

    public function edit($id)
    {
        if(Auth::user()->roles !="superadmin")
        {
            abort(403);
        }
        $company_id = CompanySetting::select('company_id')->get()->toArray();
        $data['company'] = Company::whereNotIn('id', $company_id)->get();
        $data['company_id'] = CompanySetting::where('company_id', $id)->first();
        $data['company_setting'] = CompanySetting::where('company_id', $id)->get();
        $data['id'] = $id;
        return view('application.settings.preference.edit',$data);
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
        if(Auth::user()->roles !="superadmin")
        {
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
