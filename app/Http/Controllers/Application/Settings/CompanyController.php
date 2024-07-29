<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\Settings\Company\Update;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use App\Models\Site;
use App\Models\Company;
use App\Models\Address;
use App\Models\Media;
use App\Models\CompanySetting;
use Auth;
use File;

class CompanyController extends Controller
{
    /**
     * Display Company Settings Page
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (!Auth::user()->can('setting-company-view')) {
            abort(403);
        }
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        if(Auth::user()->roles =="superadmin")
        {
            $data['company'] = Company::paginate(5);
        }else{

            $data['company'] = Company::where('id', $currentCompany->id)->paginate(5);
        }
        

        return view('application.settings.company.index', $data);
    }

    public function list()
    {
        if (!Auth::user()->can('setting-company-view')) {
            abort(403);
        }
        return view('application.settings.company.list');
    }

    public function create()
    {
        if (!Auth::user()->can('setting-company-create')) {
            abort(403);
        }
        return view('application.settings.company.create');
    }

    public function store(Request $request)
    {
        //dd($request);
        
        if (!Auth::user()->can('setting-company-create')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|unique:companies',
          ]);

        $user = $request->user();
        $currentCompany = $user->currentCompany();

        $company['name'] = $request->name;
        $company['owner_id'] = $user->id;
        Company::create($company);

        $company_id = Company::latest()->first();

        // Add Company Address
        $address = $request->input('billing');
        $address['model_type'] = "App\Models\Company";
        $address['model_id'] = $company_id->id;
        $address['name'] = $request->name;
        Address::create($address);
        
        // Update Company Logo
        
        if ($files = $request->file('avatar')) {
            $destinationPath = 'storage/'.$company_id->id; // upload path
             if(!File::isDirectory($destinationPath)){
 
                 File::makeDirectory($destinationPath, 0777, true, true);
         
             }
             $extension = $files->extension();
             $type = $files->getMimeType();
             $size = $files->getSize();
             $profileImage = $files->getClientOriginalName();
             $files->move($destinationPath, '/'.$profileImage);
             $input['avatar'] = $destinationPath.'/'.$profileImage;
          

          $media = new Media;
          $media->id = $company_id->id;
          $media->model_type = "App\Models\Company";
          $media->model_id = $company_id->id;
          $media->collection_name = "avatar";
          $media->name = basename($profileImage, '.'.$extension);
          $media->file_name = $profileImage;
          $media->mime_type = $type;
          $media->disk = "public";
          $media->size = $size;
          $media->order_column = 1;
          $media->save();

        }

          foreach($request->input('company_setting') as $key => $data)
            {
                $company_setting = new CompanySetting;
                $company_setting->company_id = $company_id->id;
                $company_setting->option = $key;
                $company_setting->value = $data;
                $company_setting->save();
            }


        session()->flash('alert-success', __('messages.company_updated'));
        return redirect()->route('settings.company');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Company $company,$id)
    {
        if (!Auth::user()->can('setting-company-edit')) {
            abort(403);
        }

        $user = $request->user();
        $currentCompany = $user->currentCompany();
        if(Auth::user()->roles =="superadmin")
        {    
            $company = Company::FindorFail($id);
        }else{
            $company = Company::FindorFail($currentCompany->id);
        }

        return view('application.settings.company.edit_company',compact('company'));
    }
 
    /**
     * Update the Company
     *
     * @param \App\Http\Requests\Application\Settings\Company\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request,$id)
    {
   // dd($request);

        if (!Auth::user()->can('setting-company-edit')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|unique:companies,name,'.$id,
          ]);

        $user = $request->user();
        $currentCompany = $user->currentCompany();

        $company = Company::FindorFail($id);
        $company->update([
             $company->name = $request->name,
             $company->owner_id = $user->id,
        ]);

        // Update Company Address
        $address = Address::FindorFail($id);
        $address->update([
            $address->name = $request->name,
            $address->address_1 = $request['billing']['address_1'],
            $address->country_id = $request['billing']['country_id'],
            $address->city = $request['billing']['city'],
            $address->state =$request['billing']['state'],
            $address->zip = $request['billing']['zip'],
            $address->phone = $request['billing']['phone'],
        ]);

            if ($files = $request->file('avatar')) {
                $destinationPath = 'storage/'.$id; // upload path
                 if(!File::isDirectory($destinationPath)){
     
                     File::makeDirectory($destinationPath, 0777, true, true);
             
                 }
                 $extension = $files->extension();
                 $type = $files->getMimeType();
                 $size = $files->getSize();
                 $profileImage = $files->getClientOriginalName();
                 $files->move($destinationPath, '/'.$profileImage);
                 $input['avatar'] = $destinationPath.'/'.$profileImage;

               
              $media = Media::where('model_id',$id)->first();
              if(!empty($media)){
              $media->update([
                $media->model_type = "App\Models\Company",
                $media->model_id = $id,
                $media->collection_name = "avatar",
                $media->name = basename($profileImage, '.'.$extension),
                $media->file_name = $profileImage,
                $media->mime_type = $type,
                $media->disk = "public",
                $media->size = $size,
                $media->order_column = 1,
              ]);
              }else{
                $media = new Media;
                $media->id = $id;
                $media->model_type = "App\Models\Company";
                $media->model_id = $id;
                $media->collection_name = "avatar";
                $media->name = basename($profileImage, '.'.$extension);
                $media->file_name = $profileImage;
                $media->mime_type = $type;
                $media->disk = "public";
                $media->size = $size;
                $media->order_column = 1;
                $media->save();
              }


            }
            
            $companysetting = CompanySetting::where('company_id', $id)->delete();
          foreach($request->input('company_setting') as $key => $data)
          {
              $company_setting = new CompanySetting;
              $company_setting->company_id = $id;
              $company_setting->option = $key;
              $company_setting->value = $data;
              $company_setting->save();
          }

        session()->flash('alert-success', __('messages.company_updated'));
        return redirect()->route('settings.company');
    }


    public function destroy(Company $company,$id)
    {
        if (!Auth::user()->can('setting-company-delete')) {
            abort(403);
        }
        
        $company = Company::find($id)->delete();

        session()->flash('alert-success', __('Success site delete'));
        return redirect()->route('settings.company');
    }
}
