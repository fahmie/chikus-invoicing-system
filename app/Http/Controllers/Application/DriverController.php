<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Client;
use App\Models\Lorry;
use App\Models\PlateNumber;
use App\Models\Invoice;
use App\Models\Site;
use App\Http\Requests\Application\Driver\Store;
use App\Http\Requests\Application\Driver\Update;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\DB;
use Auth;

class DriverController extends Controller
{
        /**
     * Display Customers Page
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::user()->can('lorry-driver-view')) {
            abort(403);
        }

        $this->driverActive = 'active';
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if(Auth::user()->roles =="superadmin"){
            $query = Driver::latest();

        }elseif(Auth::user()->roles =="admin_company"){
            $sites_id = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $query = Driver::whereIn('sites_id', $sites_id);
        }else {
            $query = Driver::where('sites_id', $currentSites);
        }


        // Apply Filters and Paginate
        $drivers = QueryBuilder::for($query)
        ->allowedFilters([
            AllowedFilter::partial('name'),
            AllowedFilter::partial('ic'),
            AllowedFilter::partial('platenumbers.number_plate'),
            AllowedFilter::partial('phone'),
            AllowedFilter::partial('driverLorryType.name'),
    
        ])
        ->simplePaginate(20)
        ->appends(request()->query());
    

       //dd($drivers);
       return view('application.drivers.index', [
           'drivers' => $drivers
       ]);
    }

    /**
     * Display the Form for Creating New Customer
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!Auth::user()->can('lorry-driver-create')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if(Auth::user()->roles =="superadmin"){
            $lorrys = Lorry::all();
            $client = Client::all();
            $sites = Site::all();
        }elseif(Auth::user()->roles =="admin_company"){
            $sitebycompany = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $client = Client::whereIn('sites_id',$sitebycompany);
            $lorrys = Lorry::all();
            $sites = Site::where('company_id', $currentCompany->id)->get();
        }else {
            $lorrys = Lorry::all();
            $client = Client::where('sites_id',$currentSites)->get();
            $sites = Site::where('id',$currentSites)->get();
        }


 
        return view('application.drivers.create', [
            'lorrys' => $lorrys,
            'client' => $client,
            'sites' => $sites,
        ]);
    }

    /**
     * Store the Customer in Database
     *
     * @param \App\Http\Requests\Application\Customer\Store $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
       //dd($request);
       if (!Auth::user()->can('lorry-driver-create')) {
        abort(403);
    }

        if(!empty($request->ic))
        {
            $data =Driver::Where('ic', $request->ic)->count();
            //dd($data);
            if($data > 0){

                $user = $request->user();
                $currentCompany = $user->currentCompany();
                $currentSites = $user->sites_id;
        
                if(Auth::user()->roles =="superadmin"){
                    $lorrys = Lorry::all();
                    $client = Client::all();
                    $sites = Site::all();
                    $drivers = Driver::Where('ic', $request->ic)->first();
                }elseif(Auth::user()->roles =="admin_company"){
                    $sitebycompany = Site::select('id')->where('company_id', $currentCompany->id)->get();
                    $query = Client::whereIn('sites_id',$sitebycompany);
                    $lorrys = Lorry::all();
                    $sites = Site::where('company_id', $currentCompany->id)->get();
                    $drivers = Driver::Where('ic', $request->ic)->first();
                }else {
                    $lorrys = Lorry::all();
                    $client = Client::where('sites_id',$currentSites)->get();
                    $sites = Site::where('id',$currentSites)->get();
                    $drivers = Driver::Where('ic', $request->ic)->first();
                }

                session()->flash('alert-warning', 'Driver already exists');
                return redirect()->route('driver.edit',$drivers->id);
            }
        }

        $request->validate([
            'sites_id' => 'required',
            'name' => 'required',
            'ic' => 'required|unique:drivers',
            'plate_number' => 'required',
            'plate_number.*' => 'required|distinct',
            'phone' => 'required|numeric',
            'lorry_type' => 'required',
            'lorry_type.*' => 'required',
            'weight' => 'required',
        ]);


        foreach ( $request->plate_number as $idx => $val ) {
            $lorrys[] = [ $val, $request->lorry_type[$idx], $request->weight[$idx] ];
        }

        //dd($lorrys);

        $driver = new Driver;
        $driver->sites_id = $request->sites_id;
        $driver->name = $request->name;
        $driver->ic = $request->ic;
        $driver->phone = $request->phone;
        $driver->remark = $request->remark;
        $driver->save();

        $driver_id = Driver::latest()->first()->id;
        foreach($lorrys as $lorry)
        {
            $platenumber = new PlateNumber;
            $platenumber->driver_id = $driver_id;
            $platenumber->number_plate = $lorry[0];
            $platenumber->lorry_type_id = $lorry[1];
            $platenumber->weight = $lorry[2];
            $platenumber->save();
        }
        

        session()->flash('alert-success', 'Success Add Driver');
        return redirect()->route('driver');
    } 

    /**
     * Display the Customer Details Page
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function details(driver $driver)
    {
        if (!Auth::user()->can('lorry-driver-view')) {
            abort(403);
        }
        $drivers = Driver::where('id', $driver->id)->first();

        return view('application.drivers.details', [
            'drivers' => $drivers,
        ]);
    }

    /**
     * Display the Form for Editing Customer
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,driver $driver)
    {
        if (!Auth::user()->can('lorry-driver-edit')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        $currentSites = $user->sites_id;

        if(Auth::user()->roles =="superadmin"){
            $lorrys = Lorry::all();
            $client = Client::all();
            $sites = Site::all();
            $drivers = Driver::findOrFail($driver->id);
        }elseif(Auth::user()->roles =="admin_company"){
            $sitebycompany = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $client = Client::whereIn('sites_id',$sitebycompany);
            $lorrys = Lorry::all();
            $sites = Site::where('company_id', $currentCompany->id)->get();
            $drivers = Driver::findOrFail($driver->id);
        }else {
            $lorrys = Lorry::all();
            $client = Client::where('sites_id',$currentSites)->get();
            $sites = Site::where('id',$currentSites)->get();
            $drivers = Driver::findOrFail($driver->id);
        }

        return view('application.drivers.edit', [
            'drivers' => $drivers,
            'lorrys' => $lorrys,
            'client' => $client,
            'sites' => $sites,
        ]);
    }

    /**
     * Update the Customer in Database
     *
     * @param \App\Http\Requests\Application\Customer\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, driver $driver)
    {
        //dd($request->id);
        if (!Auth::user()->can('lorry-driver-edit')) {
            abort(403);
        }
        $request->validate([
            'sites_id' => 'required',
            'name' => 'required',
            'ic' => 'required',
            'plate_number' => 'required',
            'plate_number.*' => 'required|distinct',
            'phone' => 'required',
            'lorry_type' => 'required',
            'weight' => 'required',
        ]);

        foreach ($request->plate_number as $idx => $val ) {
            $lorrys[] = [ $val, $request->lorry_type[$idx], $request->weight[$idx] ];
        }

        if(!empty($request->id)){
            foreach($request->id as $k => $id){
                  array_push($lorrys[$k],$id);
            }
        }

        $p = array();
        if(!empty($request->id)){
        foreach($request->id as $data)
        {  
            $p[] = $data;
        }
        }

        $driver->update([
            $driver->sites_id = request()->sites_id,
            $driver->name = request()->name,
            $driver->ic = request()->ic,
            $driver->phone = request()->phone,
            $driver->remark = request()->remark,
        ]);

            foreach($lorrys as $lorry)
            {

                $getdeleted = PlateNumber::whereNotIn('id', $p)->where('driver_id', $driver->id)->delete();

               if (array_key_exists('3', $lorry)) {
                $update_plate = DB::table('plate_number')
                ->where('id', $lorry[3])
                ->update([
                    'number_plate' => $lorry[0],
                    'lorry_type_id' => $lorry[1],
                    'weight' => $lorry[2],
                    ]);
            
                }else{
                $platenumber = new PlateNumber;
                $platenumber->driver_id = $driver->id;
                $platenumber->number_plate = $lorry[0];
                $platenumber->lorry_type_id = $lorry[1];
                $platenumber->weight = $lorry[2];
                $platenumber->save();
                }
            
            }


        session()->flash('alert-success', 'Success Update Driver');
        return redirect()->route('driver');
    }

    /**
     * Delete the Customer
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(driver $driver)
    {
        if (!Auth::user()->can('lorry-driver-delete')) {
            abort(403);
        }
        PlateNumber::where('driver_id', $driver->id)->delete();
        $driver->delete();

        session()->flash('alert-success', "Success Delete Driver");
        return redirect()->route('driver');
    }

    public function tracking(driver $driver)
    {
        if (!Auth::user()->can('lorry-driver-view')) {
            abort(403);
        }
        $trackings  = Invoice::where('driver_id', $driver->id)->where('status', 'OTW')->get();

        return view('application.drivers.tracking', [
            'trackings' => $trackings,
        ]);
    }
}
