<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\Settings\Account\Update;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;

class AccountController extends Controller
{
    /**
     * Display Account Settings Page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('setting-account-view')) {
            abort(403);
        }
        return view('application.settings.account.index');
    }

    /**
     * Update the Account of Current Authenticated User
     *
     * @param \App\Http\Requests\Application\Settings\Account\Update $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        if (!Auth::user()->can('setting-account-edit')) {
            abort(403);
        }
        $user_id =Auth::user()->id;
        $request->validate([
            'username' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email,'.$user_id,
        ]);
        // If demo mode is active then block this action
        if (config('app.is_demo')) {
            session()->flash('alert-danger', __('messages.action_blocked_in_demo'));
            return redirect()->route('settings.account');
        };

        // Update User
        $user = $request->user();
        $member = User::findByUid($user->uid);
        // dd($request->new_password);
        if($request->old_password != NULL && $request->new_password != NULL){
            $member->update([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->new_password),
            ]);
        }
        $member->update([
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);


        session()->flash('alert-success', __('messages.account_updated'));
        return redirect()->route('settings.account');
    }
}
