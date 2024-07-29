<?php

namespace App\Http\Controllers\api\v1\driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\PlateNumber;
use Validator;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driver = Driver::with('getLoris')->get();
        return response([
            'success' => true,
            'message' => 'List of All Driver',
            'data' => $driver
        ], 200);
    }

    public function driverById($id)
    {
        $driver = Driver::with('getLoris')->where('id', $id)->get();
        return response([
            'success' => true,
            'message' => 'Driver Details',
            'data' => $driver
        ], 200);
    }

    public function loriById($id, $driver_id)
    {
        $lori = PlateNumber::where('id', $id)->where('driver_id', $driver_id)->get();
        return response([
            'success' => true,
            'message' => 'Lorry Details',
            'data' => $lori
        ], 200);
    }


    // public function loriAll()
    // {
    //     return PlateNumber::all();
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validate data
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'ic' => 'required|unique:drivers',
            'phone' => 'required',
            'platenumbers.*.number_plate' => 'required',
            'platenumbers.*.number_plate*' => 'required|distinct',
            'platenumbers.*.lorry_type_id' => 'required|integer',
            'platenumbers.*.weight' => 'required',
         ]);
     
         if ($validator->fails())
         { 
             $message = $validator->errors()->first();
             return response()->json(['statusCode'=>200,'success'=>false,'message'=>$message], 200);            
         }else{
            $driver = new Driver;
            $driver->name = $request->name;
            $driver->ic = $request->ic;
            $driver->phone = $request->phone;
            $driver->remark = $request->remark;
            $driver->save();
    
            $driver_id = Driver::latest()->first()->id;
             if(!empty($request->platenumbers)){
                foreach($request->platenumbers as $data){
                    $platenumber = new PlateNumber;
                    $platenumber->driver_id = $driver_id;
                    $platenumber->number_plate = $data['number_plate'];
                    $platenumber->lorry_type_id = $data['lorry_type_id'];
                    $platenumber->weight = $data['weight'];
                    $platenumber->save();
                }
             }
         }

         return response([
            'success' => true,
            'message' => 'Success Add',
        ], 200);
    }


        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLori(Request $request, $driver_id)
    {
        //validate data
        $validator = Validator::make($request->all(), [ 
           // 'number_plate' => 'required|unique:plate_number,number_plate,'.$driver_id.',driver_id',
            'number_plate' => 'required',
            'lorry_type_id' => 'required|integer',
            'weight' => 'required',
         ]);
     
         if ($validator->fails())
         { 
             $message = $validator->errors()->first();
             return response()->json(['statusCode'=>200,'success'=>false,'message'=>$message], 200);            
        }else{
        $driver = Driver::where('id',$driver_id)->count();
        if($driver < 1){
            $message = "Driver ID not exist";
            return response()->json(['statusCode'=>200,'success'=>false,'message'=>$message], 200);    
        }
        $platenumber = new PlateNumber;
        $platenumber->driver_id = $driver_id;
        $platenumber->number_plate = $request->number_plate;
        $platenumber->lorry_type_id = $request->lorry_type_id;
        $platenumber->weight = $request->weight;
        $platenumber->save();

        }

        return response([
            'success' => true,
            'message' => 'Success Add',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'ic' => 'required|unique:drivers,ic,'.$id.',id',
            'phone' => 'required',
         ]);
     
         if ($validator->fails())
         { 
             $message = $validator->errors()->first();
             return response()->json(['statusCode'=>200,'success'=>false,'message'=>$message], 200);            
         }else{

        $driver = Driver::where('id',$id)->count();

        if($driver < 1){
            $message = "Driver ID not exist";
            return response()->json(['statusCode'=>200,'success'=>false,'message'=>$message], 200);    
        }else{
        $driver = Driver::find($id);

        $driver->update([
            $driver->name = request()->name,
            $driver->ic = request()->ic,
            $driver->phone = request()->phone,
            $driver->remark = request()->remark,
        ]);
        
        }
        return response([
            'success' => true,
            'message' => 'Success Update',
        ], 200);
    
    }
    }


        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $driver_id, $lori_id
     * @return \Illuminate\Http\Response
     */
    public function updateLori(Request $request, $driver_id, $lori_id)
    {
        $validator = Validator::make($request->all(), [ 
            // 'number_plate' => 'required|unique:plate_number,number_plate,'.$driver_id.',driver_id',
             'number_plate' => 'required',
             'lorry_type_id' => 'required|integer',
             'weight' => 'required',
          ]);
      
          if ($validator->fails())
          { 
              $message = $validator->errors()->first();
              return response()->json(['statusCode'=>200,'success'=>false,'message'=>$message], 200);            
        }else{

        $lori = PlateNumber::where('id',$lori_id)->where('driver_id', $driver_id)->count();

        if($lori < 1){
            $message = "Lori ID not exist";
            return response()->json(['statusCode'=>200,'success'=>false,'message'=>$message], 200);    
        }else{

        $lori = PlateNumber::where('id',$lori_id)->where('driver_id', $driver_id)->first();

        $lori->update([
            $lori->number_plate = request()->number_plate,
            $lori->lorry_type_id = request()->lorry_type_id,
            $lori->weight = request()->weight,
            $lori->status = request()->status,
        ]);
        }
        return response([
            'success' => true,
            'message' => 'Success Update',
        ], 200);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyDriver($id)
    {
        $driver =Driver::where('id',$id)->count();

        if($driver < 1){
            $message = "Driver ID not exist";
            return response()->json(['statusCode'=>200,'success'=>false,'message'=>$message], 200);    
        }else{

        $driver = Driver::find($id);

        $driver->platenumbers()->delete();
        $driver->delete();

        return response([
            'success' => true,
            'message' => 'Success Delete',
        ], 200);

        }
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyLori($id, $driver_id)
    {
        $lori = PlateNumber::where('id',$id)->where('driver_id', $driver_id)->count();

        if($lori < 1){
            $message = "Lorry ID not exist";
            return response()->json(['statusCode'=>200,'success'=>false,'message'=>$message], 200);    
        }else{

            $lori = PlateNumber::where('id',$id)->where('driver_id', $driver_id)->first();

            $lori->delete();
    
            return response([
                'success' => true,
                'message' => 'Success Delete',
            ], 200);
        }
    }
}
