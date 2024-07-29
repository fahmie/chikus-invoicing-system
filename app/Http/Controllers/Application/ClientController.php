<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ProductUnit;
use App\Models\Product;
use App\Models\User;
use App\Models\Site;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Vendor\Store;
use App\Http\Requests\Application\Vendor\Update;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\DB;
use Auth;

class ClientController extends Controller
{
    /**
     * Display Vendors Page
     *
     * @param \Illuminate\Http\Request $request
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
            $query = Client::latest();
        }elseif(Auth::user()->roles =="admin_company"){
            $sitebycompany = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $query = Client::whereIn('sites_id',$sitebycompany);
        }else {
            $query = Client::where('sites_id',$currentSites);
        }
        // Apply Filters and Paginate
        $client = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::partial('company_name'),
                AllowedFilter::partial('company_no'),
                AllowedFilter::partial('address'),
                AllowedFilter::partial('project_manager_name'),
                AllowedFilter::partial('phone'),
                AllowedFilter::partial('delivery_location'),

            ])
            ->paginate(20)
            ->appends(request()->query());

            return view('application.client.index', [
                'client' => $client
            ]);
    }

    /**
     * Display the Form for Creating New Vendor
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        }else {
            $sites = Site::where('company_id',$currentCompany->id)->get();
        }

        $unit = ProductUnit::all();
        $products = NULL;
        return view('application.client.create',[
            'unit' => $unit,
            'products' => $products,
            'sites' => $sites,
        ]);
    }

    /**
     * Store the Vendor in Database
     *
     * @param \App\Http\Requests\Application\Vendor\Store $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //dd($request->sites_id);
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        //dd($request->first_name);
        $request->validate([
            'sites_id' => 'required',
            'company_name' => 'required',
            'company_no' => 'required',
            'address' => 'required',
            'project_manager_name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|unique:clients,email|unique:users,email|email',
            'delivery_location' => 'required',
            'price' => 'required',
            'price.*' => 'required',
            'product.*' => 'required|distinct',
            'product' => 'required',
            'unit' => 'required',
            'unit.*' => 'required',
            'transport' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed',

        ]);

        $product = $request->product;
        $unit = $request->unit;
        $price = $request->price;

        foreach ($product as $id => $key) {
            $result[$id] = array(
                'product'  => $product[$id],
                'unit'  => $unit[$id],
                'price' => $price[$id],
            );
        }

        $sites = Site::where('id',$request->sites_id)->first();

        $user = User::create([
            'username' => $request->username,
          //  'client_id' => $client_id,
            'sites_id' => $request->sites_id,
            'email'  => $request->email,
            'roles' => "client",
            'password' => Hash::make($request->password),
        ]);
        $role= Role::where('name','client')->first();
        $user->roles()->attach($role->id);
        $user->permissions()->attach($role->permissions);
        // Attach Member to Company
        $user->attachCompany($sites->company_id);

        if($user){

            // dd($result);
             $client = new Client;
             $client->user_id = $user->id;
             $client->sites_id = request()->sites_id;
             $client->company_name = request()->company_name;
             $client->company_no = request()->company_no;
             $client->address = request()->address;
             $client->transport = request()->transport;
             $client->project_manager_name = request()->project_manager_name;
             $client->phone = request()->phone;
             $client->email = request()->email;
             $client->delivery_location = request()->delivery_location;
             $client->save();
     
             $client_id = Client::latest()->first()->id;
             foreach($result as $data){
                 $product = new Product;
                 $product->client_id = $client_id;
                 $product->sites_id = $request->sites_id;
                 $product->name = $data['product'];
                 $product->unit_id = $data['unit'];
                 $product->price = $data['price']*100;
                 $product->save(); 
     
             }

        }else{

            session()->flash('alert-danger', 'Fail');
            return redirect()->route('client');  
        }


        session()->flash('alert-success', 'Success');
        return redirect()->route('client');
    } 

    /**
     * Display the Vendor Details Page
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function details(client $client)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }

        $client = Client::where('id', $client->id)->first();
        $product = Product::where('client_id', $client->id)->get();
        $user = User::where('client_id', $client->id)->first();

        return view('application.client.details', [
            'client' => $client,
            'product' => $product,
            'user' => $user
        ]);
    }

    /**
     * Display the Form for Editing Vendor
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(client $client)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
       // dd($client->id);
        $client = Client::findOrFail($client->id);
        $user = User::where('client_id', $client->id)->first();
        $products = Product::where('client_id', $client->id)->get();
        $unit = ProductUnit::all();
        $sites = Site::all();

        return view('application.client.edit', [
            'client' => $client,
            'user' => $user,
            'products' => $products,
            'unit' => $unit,
            'sites' => $sites,
        ]);
    }

    /**
     * Update the Vendor in Database
     *
     * @param \App\Http\Requests\Application\Vendor\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, client $client)
    {

       //dd($client);
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        // dd($request);
        if(!empty(request()->password)){    
            $request->validate([
                'sites_id' => 'required',
                'company_name' => 'required',
                'company_no' => 'required',
                'address' => 'required',
                'project_manager_name' => 'required',
                'phone' => 'required|numeric',
                'email' => 'required|unique:clients,email,'.$client->id.'|unique:users,email,'.$client->id.',client_id|email',
                'delivery_location' => 'required',
                'price' => 'required',
                'price.*' => 'required',
                'product.*' => 'required|distinct',
                'product' => 'required',
                'unit' => 'required',
                'unit.*' => 'required',
                'transport' => 'required',
                'username' => 'required|unique:users,username,'.$client->id.',id',
                'password' => 'required|confirmed',
    
            ]);
            }

        $request->validate([
            'sites_id' => 'required',
            'company_name' => 'required',
            'company_no' => 'required',
            'address' => 'required',
            'project_manager_name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|unique:clients,email,'.$client->id.'|unique:users,email,'.$client->id.',client_id|email',
            'delivery_location' => 'required',
            'price' => 'required',
            'price.*' => 'required',
            'product.*' => 'required|distinct',
            'product' => 'required',
            'unit' => 'required',
            'unit.*' => 'required',
            'transport' => 'required',
            'username' => 'required|unique:users,username,'.$client->id.',id',
           // 'password' => 'required|confirmed',

        ]);


        $product = $request->product;
        $unit = $request->unit;
        $price = $request->price;


        foreach ($product as $id => $key) {
            $result[$id] = array(
                'product'  => $product[$id],
                'unit'  => $unit[$id],
                'price' => $price[$id],
            );
        }


        if(!empty($request->id)){
            foreach($request->id as $k => $id){
                 array_push($result[$k],$id);
            }
        }

        $p = array();
        if(!empty($request->id)){
        foreach($request->id as $data)
        {  
            $p[] = $data;
        }
        }

        // dd($result);
        $client->update([
            $client->sites_id = request()->sites_id,
            $client->company_name = request()->company_name,
            $client->company_no = request()->company_no,
            $client->address = request()->address,
            $client->transport = request()->transport,
            $client->project_manager_name = request()->project_manager_name,
            $client->phone = request()->phone,
            $client->email = request()->email,
            $client->delivery_location = request()->delivery_location,
        ]);

        foreach($result as $result)
        {

            $getdeleted = Product::whereNotIn('id', $p)->where('client_id', $client->id)->delete();
            
           if (array_key_exists('0', $result)) {
            $update = DB::table('products')
            ->where('id', $result[0])
            ->update([
                'sites_id' => $request->sites_id,
                'name' => $result['product'],
                'unit_id' => $result['unit'],
                'price' => $result['price']*100,
                ]);
        
            }else{
                $product = new Product;
                $product->client_id = $client->id;
                $product->sites_id = $request->sites_id;
                $product->name = $result['product'];
                $product->unit_id = $result['unit'];
                $product->price = $result['price']*100;
                $product->save(); 
            }
        
        }
        $sites = Site::where('id',request()->sites_id)->first();

        if(request()->password != null){
            $user = DB::table('users')
            ->where('client_id', $client->id)
            ->update([
                'username' => $request->username,
                'email'  => request()->email,
                'password' => Hash::make(request()->password),
                ]);

           $client_users_id = User::where('client_id', $client->id)->first();
           $user = DB::table('company_user')
           ->where('user_id', $client_users_id->id)
           ->update([
               'company_id' => $sites->company_id,
               ]);

        }else{
            $user = DB::table('users')
            ->where('client_id', $client->id)
            ->update([
                'username' => $request->username,
                'email'  => request()->email,
                ]);


                $client_users_id = User::where('client_id', $client->id)->first();
                $user = DB::table('company_user')
                ->where('user_id', $client_users_id->id)
                ->update([
                    'company_id' => $sites->company_id,
                    ]);
        }


            session()->flash('alert-success', 'Success');
            return redirect()->route('client');
    }

    /**
     * Delete the Vendor
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(client $client)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        //dd($client);
        $client->delete();

        Product::where('client_id', $client->id)->delete();

        User::where('id', $client->user_id)->delete();

        session()->flash('alert-success', "Success Delete");
        return redirect()->route('client');
    }
}
