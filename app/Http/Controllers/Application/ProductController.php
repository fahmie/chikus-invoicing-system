<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Site;
use App\Http\Requests\Application\Product\Store;
use App\Http\Requests\Application\Product\Update;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Auth;

class ProductController extends Controller
{
    /**
     * Display Products Page
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
            $query = Product::where('client_id', NULL);
        }elseif(Auth::user()->roles =="admin_company"){
            $sites_id = Site::select('id')->where('company_id', $currentCompany->id)->get();
            $query = Product::whereIn('sites_id', $sites_id)->where('client_id', NULL);
        }else {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
            $query = Product::where('sites_id', $currentSites)->where('client_id', NULL);
        }

        

        $products = QueryBuilder::for($query)
        ->allowedFilters([
            AllowedFilter::partial('name'),
            AllowedFilter::partial('unit_id'),
            AllowedFilter::partial('price'),
        ])
        ->paginate(20)
        ->appends(request()->query());

        return view('application.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Display the Form for Creating New Product
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
            $unit = ProductUnit::all();
        }else {
            $sites = Site::where('company_id',$currentCompany->id)->get();
            $unit = ProductUnit::where('company_id',$currentCompany->id)->get();
        }
        $client = Client::all();
        return view('application.products.create', [
            'unit' => $unit,
            'client' => $client,
            'sites' => $sites,
        ]); 
    }

    /**
     * Store the Product in Database
     *
     * @param \App\Http\Requests\Application\Product\Store $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        
        $request->validate([
            //'name' => 'required|unique:products,name,NULL,client_id,sites_id,'.$request->sites_id,
            'name' => 'required|unique:products,name,NULL,id,client_id,NULL,sites_id,'.$request->sites_id,
            'unit_id' => 'required|numeric',
            'price' => 'required|numeric',
            'sites_id' => 'required|numeric',

        ]);

        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // // Create Product and Store in Database
        $product = new Product;
        $product->name = request()->name;
        $product->client_id = request()->client_id;
        $product->sites_id = request()->sites_id;
        $product->unit_id = request()->unit_id;
        $product->price = request()->price;
        $product->description = request()->description;
        $product->is_contract = request()->is_contract;
        $product->save();

        // Add Product Taxes
        if ($request->has('taxes')) {
            foreach ($request->taxes as $tax) {
                $product->taxes()->create([
                    'tax_type_id' => $tax
                ]);
            }
        }

        session()->flash('alert-success', __('messages.product_added'));
        return redirect()->route('products');
    }

    /**
     * Display the Form for Editing Product
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,product $product)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        
        if(Auth::user()->roles =="superadmin"){
            $sites = Site::all();
            $unit = ProductUnit::all();
        }else {
            $sites = Site::where('company_id',$currentCompany->id)->get();
            $unit = ProductUnit::where('company_id',$currentCompany->id)->get();
        }
        $client = Client::all();
        $product = Product::findOrFail($product->id);


        return view('application.products.edit', [
            'product' => $product,
            'unit' => $unit,
            'client' => $client,
            'sites' => $sites,
        ]); 
    }

    /**
     * Update the Product in Database
     *
     * @param \App\Http\Requests\Application\Product\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, product $product)
    {
        // dd($product->sites_id);
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        
        $request->validate([
            'name' => 'required|unique:products,name,'.$product->id.',id,client_id,NULL,sites_id,'.$request->sites_id,
            'unit_id' => 'required|numeric',
            'price' => 'required|numeric',
            'sites_id' => 'required|numeric',

        ]);
        
        if(empty($request->client_id))
        {
            $is_contract = "NULL";
        }else
        {
            $is_contract = request()->is_contract;
        }
       // dd($request);
        // Update the Expense
        $product->update([
            $product->name = request()->name,
            $product->client_id = request()->client_id,
            $product->sites_id = request()->sites_id,
            $product->unit_id = request()->unit_id,
            $product->price  = request()->price,
            $product->description = request()->description,
            $product->is_contract = $is_contract,
        ]);

        // Remove old Product Taxes
        $product->taxes()->delete();

        // Update Product Taxes
        if ($request->has('taxes')) {
            foreach ($request->taxes as $tax) {
                $product->taxes()->create([
                    'tax_type_id' => $tax
                ]);
            }
        }

        session()->flash('alert-success', __('messages.product_updated'));
        return redirect()->route('products');
    }

    /**
     * Delete the Product
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        if(Auth::user()->roles =="client")
        {
            abort(403);
        }
        $product = Product::findOrFail($request->product);

        // If the product already in use in Invoice Items
        // then return back and flash an alert message
        if ($product->invoice_items()->exists() && $product->invoice_items()->count() > 0) {
            session()->flash('alert-success', __('messages.product_cant_deleted_invoice'));
            return redirect()->route('products.edit', $request->product);
        }

        // If the product already in use in Estimate Items
        // then return back and flash an alert message
        if ($product->estimate_items()->exists() && $product->estimate_items()->count() > 0) {
            session()->flash('alert-success', __('messages.product_cant_deleted_estimate'));
            return redirect()->route('products.edit', $request->product);
        }

        // Delete Product Taxes from Database
        if ($product->taxes()->exists() && $product->taxes()->count() > 0) {
            $product->taxes()->delete();
        }

        // Delete Product from Database
        $product->delete();
        
        session()->flash('alert-success', __('messages.product_deleted'));
        return redirect()->route('products');
    }
}
