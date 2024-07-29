<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Client;
use App\Models\Driver;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;

class AjaxController extends Controller
{
    /**
     * Get Customers Ajax Request
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return json
     */ 
    public function customers(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        $search = $request->search;

        if($search == ''){
            $customers = Customer::findByCompany($currentCompany->id)->limit(5)->get();
        }else{
            $customers = Customer::findByCompany($currentCompany->id)->where('display_name', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = collect();
        foreach($customers as $customer){
            $response->push([
                "id" => $customer->id,
                "text" => $customer->display_name,
                "currency" => $customer->currency,
                "billing_address" => $customer->displayLongAddress('billing'),
                "shipping_address" => $customer->displayLongAddress('shipping'),
            ]);
        }

        return response()->json($response);
    }


    public function clients(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        $search = $request->search;

        if($search == ''){
            $clients = Driver::where('client_id', NULL)->limit(5)->get();
        }else{
            $clients = Driver::where('client_id', NULL)->where('name', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = collect();
        foreach($clients as $client){
            $response->push([
                "id" => $client->id,
                "text" => $client->name,
                "currency" => "RM",
                "billing_address" => $client->plate_number,
                "shipping_address" => $client->ic,
            ]);
        }

        return response()->json($response);
    }

    /**
     * Get Invoices Ajax Request
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return json
     */ 
    // public function invoices(Request $request)
    // {
    //     $user = $request->user();
    //     $currentCompany = $user->currentCompany();
 
    //     $invoices = Invoice::findByCompany($currentCompany->id)
    //         ->findByClientID($request->customer_id)
    //         ->unpaid()
    //         ->where('due_amount', '>', 0)
    //         ->select('id', 'invoice_number AS text', 'due_amount')
    //         ->get();

    //     return response()->json($invoices);
    // }

    /**
     * Get Products Ajax Request
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return json
     */ 
    public function products(Request $request,$id)
    {
        // $user = $request->user();
        // $currentCompany = $user->currentCompany();
        // $currentSites = $user->sites_id;

        $products = Product::where('client_id', NULL)
            ->where('sites_id', $id)
            ->select('id', 'name AS text', 'price')
            ->with('taxes')
            ->get();
 
        return response()->json($products);
    }

    public function products1($id)
    {
       // dd($id);
        $products = Product::where('client_id', $id)
            ->select('id', 'unit_id','name AS text', 'price')
            ->with('taxes')
            ->get();
 
        return response()->json($products);
    }

    public function products2(Request $request)
    {
       // dd($request);
        $products = Product::select('id', 'client_id','name AS text', 'price')
            ->with('taxes')
            ->get();
 
        return response()->json($products);
    }
}
