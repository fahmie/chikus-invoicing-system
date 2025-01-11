<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\Settings\TeamMember\Store;
use App\Http\Requests\Application\Settings\TeamMember\Update;
use App\Models\User;
use App\Models\Site;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    /**
     * Display Team Settings Page
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::user()->can('setting-team-view')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = Auth::user()->sites_id;

        if(Auth::user()->roles =="superadmin"){
            $users = User::where('client_id', null)->simplePaginate(10);
        }elseif(Auth::user()->roles =="admin_company"){
            $sitebycompany = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $users = User::whereIn('sites_id',$sitebycompany)->where('client_id', null)->simplePaginate(10);
        }else {
            $users = User::where('sites_id',$currentSites)->where('client_id', null)->simplePaginate(10);
        }

        return view('application.settings.team.index',compact('users'));
    }

    /**
     * Display the Form for Creating New Team Member
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function createMember(Request $request)
    {
        if (!Auth::user()->can('setting-team-create')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = Auth::user()->sites_id;

        $member = new User();
        if(Auth::user()->roles =="superadmin"){
            $sites = Site::all();
            $company = Company::all();
            $roles = Role::all();
        }elseif(Auth::user()->roles =="admin_company"){
            $sites = Site::where('company_id', $currentCompany->id)->get();
            $company = Company::where('id', $currentCompany->id)->get();
            $roles = Role::where('id','!=', 1)->get();
        }else {
             $sites = Site::where('id',$currentSites)->get();
             $company = Company::where('id', $currentCompany->id)->get();
             $roles = Role::where('id','!=', 1)->get();
        }
        // Fill model with old input
        if (!empty($request->old())) {
            $member->fill($request->old());
        }

        return view('application.settings.team.create_member', [
            'member' => $member,
            'roles' => $roles,
            'sites' => $sites,
            'company' => $company,
        ]);
    }

    /**
     * Store the Team Member in Database
     *
     * @param App\Http\Requests\Application\Settings\TeamMember\Store $request
     *
     * @return \Illuminate\Http\Response
     */
    public function storeMember(Store $request)
    {
        if (!Auth::user()->can('setting-team-create')) {
            abort(403);
        }

        $request->validate([
            'username' => 'required|unique:users',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
        ]);


         $authUser = $request->user();
         
         $currentCompany = $authUser->currentCompany();

        $sites = Site::where('id',$request->sites_id)->first();
        // Create new Member
        $member = User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'roles' => $request->roles,
            'sites_id' => $request->sites_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Assign Member Role
       //$member->assignRole($request->role);
       $role= Role::where('name',$request->roles)->first();
       $member->roles()->attach($role->id);
       $member->permissions()->attach($role->permissions);

        // Attach Member to Company
        $member->attachCompany($sites->company_id);


        session()->flash('alert-success', __('messages.team_member_added'));
        return redirect()->route('settings.team');
    }

    /**
     * Display the Form for Editing Team Member
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function editMember(Request $request)
    {
        if (!Auth::user()->can('setting-team-edit')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        $member = User::findByUid($request->member);

        if(Auth::user()->roles =="superadmin"){
            $sites = Site::all();
            $roles = Role::all();
        }elseif(Auth::user()->roles =="admin_company"){
            $sites = Site::where('company_id', $currentCompany->id)->get();
            $roles = Role::where('id','!=', 1)->get();
        }else {
             $sites = Site::all();
             $roles = Role::where('id','!=', 1)->get();
        }

        return view('application.settings.team.edit_member', [
            'member' => $member,
            'roles' => $roles,
            'sites' => $sites,
        ]);
    }

    /**
     * Update the Team Member
     *
     * @param  App\Http\Requests\Application\Settings\TeamMember\Update  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateMember(Update $request)
    {
        if (!Auth::user()->can('setting-team-edit')) {
            abort(403);
        }

        $member = User::findByUid($request->member);

        $request->validate([
            'username' => 'required|unique:users,username,'.$member->id,
            'phone' => 'required',
            'email' => 'required|email|unique:users,email,'.$member->id,
        ]);
        $sites = Site::where('id',$request->sites_id)->first();

        if($request->password != NULL && $request->password_confirmation != NULL){
            $member->update([
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'roles' => $request->roles,
                'sites_id' => $request->sites_id,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
        }else{
            $member->update([
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'roles' => $request->roles,
                'sites_id' => $request->sites_id,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
        }

        $role= Role::where('name',$request->roles)->first();
        $member->roles()->sync($role->id);
        $member->permissions()->sync($role->permissions);
        
        $user = DB::table('company_user')
        ->where('user_id', $member->id)
        ->update([
        'company_id' => $sites->company_id,
        ]);

        session()->flash('alert-success', 'Success updated');
        return redirect()->route('settings.team');
    }

    /**
     * Delete the Team Member
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteMember(Request $request)
    {
        if (!Auth::user()->can('setting-team-delete')) {
            abort(403);
        }

        $member = User::findByUid($request->member);

        // If demo mode is active then block this action
        if (config('app.is_demo')) {
            session()->flash('alert-danger', __('messages.action_blocked_in_demo'));
            return redirect()->route('settings.team');
        };

        // Delete the Member
        $member->delete();

        session()->flash('alert-success', "Success Deleted!");
        return redirect()->route('settings.team');
    }
}
