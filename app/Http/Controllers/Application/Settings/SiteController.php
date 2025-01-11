<?php

namespace App\Http\Controllers\Application\Settings;

use App\Models\Site;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use Auth;


class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::user()->can('setting-sites-view')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        if (Auth::user()->roles == "superadmin") {
            $data['sites'] = Site::simplePaginate(5);
        } elseif (Auth::user()->roles == "admin_company") {
            $sitebycompany = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $data['sites'] = Site::whereIn('id', $sitebycompany)->simplePaginate(5);
        } else {
            $data['sites'] = Site::where('id', $user->sites_id)->simplePaginate(5);
        }

        return view('application.settings.site.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!Auth::user()->can('setting-sites-create')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        if (Auth::user()->roles == "superadmin") {
            $company = Company::all();
        } elseif (Auth::user()->roles == "admin_company") {
            $company = Company::where('id', $currentCompany->id)->get();
        } else {
            $company = Company::where('id', $currentCompany->id)->get();
        }


        return view('application.settings.site.create_site', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can('setting-sites-create')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|unique:sites',
            'poskod' => 'required|numeric',
            'phone' => 'required|numeric',
            'email' => 'required',
            'address' => 'required',
            'state' => 'required',
            'company_id' => 'required',

        ]);

        $site = Site::create($request->all());

        session()->flash('alert-success', __('Success site added'));
        return redirect()->route('settings.site');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site, Request $request, $id)
    {
        if (!Auth::user()->can('setting-sites-edit')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        if (Auth::user()->roles == "superadmin") {
            $company = Company::all();
            $sites = Site::FindorFail($id);
        } else {
            $company = Company::where('id', $currentCompany->id)->get();
            $sites = Site::FindorFail($user->sites_id);
        }


        return view('application.settings.site.edit_site', compact('sites', 'company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site, $id)
    {
        if (!Auth::user()->can('setting-sites-edit')) {
            abort(403);
        }
        $request->validate([
            'name' => 'required|unique:sites,name,' . $id,
            'poskod' => 'required|numeric',
            'phone' => 'required|numeric',
            'email' => 'required',
            'address' => 'required',
            'state' => 'required',
            'company_id' => 'required',

        ]);
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        if (Auth::user()->roles == "superadmin") {
            $site = Site::FindorFail($id);
        } else {
            $site = Site::FindorFail($user->sites_id);
        }
        $site->update([
            $site->company_id = request()->company_id,
            $site->name = request()->name,
            $site->email = request()->email,
            $site->phone = request()->phone,
            $site->address = request()->address,
            $site->poskod = request()->poskod,
            $site->city = request()->city,
            $site->state = request()->state,
        ]);

        session()->flash('alert-success', __('Success site update'));
        return redirect()->route('settings.site');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site, $id)
    {
        if (!Auth::user()->can('setting-sites-delete')) {
            abort(403);
        }

        $site = Site::find($id)->delete();

        session()->flash('alert-success', __('Success site delete'));
        return redirect()->route('settings.site');
    }
}
