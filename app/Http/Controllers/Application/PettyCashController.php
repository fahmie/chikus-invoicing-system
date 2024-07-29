<?php

namespace App\Http\Controllers\Application;

use App\Models\PettyCash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Site;
use App\Exports\PettyCashExport;
use File;
use Auth;
class PettyCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }

       $user = $request->user();
       $currentCompany = $user->currentCompany();
       $currentSites = $user->sites_id;

       if(Auth::user()->roles =="superadmin"){
        $sites = Site::all();
        $query = PettyCash::latest();
        }elseif(Auth::user()->roles =="admin_company"){
        $sites_id = Site::select('id')->where('company_id', $currentCompany->id)->get();
        $sites = Site::where('company_id', $currentCompany->id)->get();
        $query = PettyCash::whereIn('sites_id', $sites_id);
        }else{  
        $sites = Site::where('id', $currentSites)->get();
        $query = PettyCash::where('sites_id', $currentSites);
       }
        $pettyCashs = QueryBuilder::for($query)
        ->allowedFilters([
            AllowedFilter::partial('date'),
            AllowedFilter::partial('time'),
            AllowedFilter::partial('detail'),
            AllowedFilter::partial('debit'),
            AllowedFilter::partial('credit'),
            AllowedFilter::partial('remark'),

        ])
        ->latest()
        ->paginate(10)
        ->appends(request()->query());
        
        return view('application.pettycash.index',[
            'pettyCashs'=> $pettyCashs,
            'sites'=> $sites,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createdebit(Request $request)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if(Auth::user()->roles =="superadmin"){
            $sites = Site::all();
        }elseif(Auth::user()->roles =="admin_company"){
            $sites = Site::where('company_id', $currentCompany->id)->get();
        }else{                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
            $sites = Site::where('id', $currentSites)->get();
        }

        return view('application.pettycash.create', compact('sites'));
    }


    public function createcredit(Request $request)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if(Auth::user()->roles =="superadmin"){
            $sites = Site::all();
        }elseif(Auth::user()->roles =="admin_company"){
            $sites = Site::where('company_id', $currentCompany->id)->get();
        }else{                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
            $sites = Site::where('id', $currentSites)->get();
        }

        return view('application.pettycash.create1',compact('sites'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_debit(Request $request)
    {
        if(request()->detail == "on")
        {
            $request->validate([
                'sites_id' => 'required',
                'other' => 'required',
                'date' => 'required',
                'time' => 'required',
                'debit' => 'required|numeric',
            ]);
        }else{

            $request->validate([
                'sites_id' => 'required',
                'detail' => 'required',
                'date' => 'required',
                'time' => 'required',
                'debit' => 'required|numeric',
            ]);
        }

        // $sites_id = request()->sites_id;
        $last_balance = PettyCash::where('sites_id', request()->sites_id)->latest()->first();
        if(empty($last_balance)){
            $balance = 0;
        }else{
            $balance = $last_balance->balance;
        }
        if(request()->detail == "on")
        {
            $pettyCash = new PettyCash;
            $pettyCash->detail = request()->other;
            $pettyCash->sites_id = request()->sites_id;
            $pettyCash->date = request()->date;
            $pettyCash->time = request()->time;
            $pettyCash->debit = request()->debit*100;
            $pettyCash->remark = request()->remark;
            $pettyCash->balance = $balance+request()->debit*100;
            $pettyCash->save();
        }else{

            $pettyCash = new PettyCash;
            $pettyCash->detail = request()->detail;
            $pettyCash->sites_id = request()->sites_id;
            $pettyCash->date = request()->date;
            $pettyCash->time = request()->time;
            $pettyCash->debit = request()->debit*100;
            $pettyCash->remark = request()->remark;
            $pettyCash->balance = $balance+request()->debit*100;
            $pettyCash->save();

        }

        session()->flash('alert-success', 'Success');
        return redirect()->route('pettycash');

    }

    public function store_credit(Request $request)
    {
        //
      
        if(request()->detail == "on")
        {
            $request->validate([
                'other' => 'required',
                'date' => 'required',
                'time' => 'required',
                'credit' => 'required|numeric',
            ]);
        }else{

            $request->validate([
                'detail' => 'required',
                'date' => 'required',
                'time' => 'required',
                'credit' => 'required|numeric',
            ]);
        }

        if ($files = $request->file('filename')) {
            $destinationPath = 'storage/pattycash'; // upload path
             if(!File::isDirectory($destinationPath)){
 
                 File::makeDirectory($destinationPath, 0777, true, true);
         
             }
             $profileImage = date('dmYhis') . "." . $files->getClientOriginalExtension();
             $files->move($destinationPath, '/'.$profileImage);
             $input['filename'] = $destinationPath.'/'.$profileImage;
          }
          

        $last_balance = PettyCash::where('sites_id', request()->sites_id)->latest()->first();
        if(empty($last_balance)){
            $balance = 0;
        }else{
            $balance = $last_balance->balance;
        }
        if(request()->detail == "on")
        {
            $pettyCash = new PettyCash;
            $pettyCash->detail = request()->other;
            $pettyCash->sites_id = request()->sites_id;
            $pettyCash->date = request()->date;
            $pettyCash->time = request()->time;
            $pettyCash->credit = request()->credit*100;
            $pettyCash->remark = request()->remark;
            $pettyCash->balance = $balance-request()->credit*100;
            $pettyCash->filename = $input['filename'];
            $pettyCash->save();
        }else{

            $pettyCash = new PettyCash;
            $pettyCash->detail = request()->detail;
            $pettyCash->sites_id = request()->sites_id;
            $pettyCash->date = request()->date;
            $pettyCash->time = request()->time;
            $pettyCash->credit = request()->credit*100;
            $pettyCash->remark = request()->remark;
            $pettyCash->balance = $balance-request()->credit*100;
            $pettyCash->filename = $input['filename'];
            $pettyCash->save();

        }

        session()->flash('alert-success', 'Success');
        return redirect()->route('pettycash');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function show(PettyCash $pettyCash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function edit(PettyCash $pettyCash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PettyCash $pettyCash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function destroy(PettyCash $pettyCash)
    {
        //
    }

    public function export(Request $request) 
    {
        $request->validate([
            'date_from' => 'required',
            'date_end' => 'required',
            'sites_id' => 'required',
        ]);

        return (new PettyCashExport)->fromDate($request->date_from)->endDate($request->date_end)->sites($request->sites_id)->download('pettycash.xlsx');
    }
}

