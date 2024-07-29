<?php

namespace App\Http\Controllers\Application\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\Site;
use Illuminate\Http\Request;
use Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::user()->can('supplier-view')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if(Auth::user()->roles =="superadmin"){
            $supplier = Supplier::paginate(10);
        }elseif(Auth::user()->roles =="admin_company"){
            $sites_id = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $supplier = Supplier::whereIn('sites_id', $sites_id)->paginate(10);
        }else {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
            $supplier = Supplier::paginate(10);
        }

        return view('application.inventory_setting.supplier.index',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!Auth::user()->can('supplier-create')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if(Auth::user()->roles =="superadmin"){
            $sites = Site::all();
        }elseif(Auth::user()->roles =="admin_company"){
            $sites = Site::where('company_id',$currentCompany->id)->get();
        }else {     
            $sites = Site::all();
        }

        return view('application.inventory_setting.supplier.create',compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can('supplier-store')) {
            abort(403);
        }

        $request->validate([
            'sites_id' => 'required',
            'address' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|unique:suppliers,email',

        ]);

        $supplier = new Supplier;
        $supplier->name = request()->name;
        $supplier->address = request()->address;
        $supplier->phone = request()->phone;
        $supplier->email = request()->email;
        $supplier->sites_id = request()->sites_id;
        $supplier->save();

        session()->flash('alert-success', 'Success');
        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        if (!Auth::user()->can('supplier-view')) {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Supplier $supplier)
    {
        if (!Auth::user()->can('supplier-edit')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if(Auth::user()->roles =="superadmin"){
            $sites = Site::all();
        }elseif(Auth::user()->roles =="admin_company"){
            $sites = Site::where('company_id',$currentCompany->id)->get();
        }else {     
            $sites = Site::all();
        }

        return view('application.inventory_setting.supplier.edit',compact('sites','supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        if (!Auth::user()->can('supplier-update')) {
            abort(403);
        }

        $supplier->update([
            $supplier->name = request()->name,
            $supplier->address = request()->address,
            $supplier->phone = request()->phone,
            $supplier->email = request()->email,
            $supplier->sites_id = request()->sites_id,
        ]);

        session()->flash('alert-success', "Success Updated");
        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier,$id)
    {
        if (!Auth::user()->can('supplier-delete')) {
            abort(403);
        }

        $supplier = Supplier::find($id);
        $supplier->delete();
        session()->flash('alert-success', "Success Deleted");
        return redirect()->route('supplier.index');
    }
}
