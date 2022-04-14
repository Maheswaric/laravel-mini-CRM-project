<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $this->datas['data'] = Company::orderby('id','desc')->paginate(1);
        return view('company.index')->with($this->datas);
    }

    public function create()
    {
        $this->datas['senddata'] = new Company();
        $this->datas['route'] = route('company.store');
        $this->datas['method'] = 'Post';
        return view('company.addedit')->with($this->datas);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:100',
            'email'   =>'required',
            'logo'    =>'required|dimensions:width=100,height=100',
            'website' => 'required'
        ]);

        if ($validator->fails())
        {
            $output = array('success' => 0, 'msg' => $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput()->with('status', $output);
        }
        try
        {
           // dd($request->all());

            $company_id = Company::create([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
            ])->id;

            if ($request->hasFile('logo')) {
                $upload_path = 'storage/app/public/company/'.$company_id;
                if (!file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }
                $filename = time() . '.' . $request->file('logo')->getClientOriginalExtension();
               
                $path = $request->file('logo')->move($upload_path, $filename);
              
                if ($path) {
                    $data['logo'] = $filename;
                }
            }

            Company::where('id',$company_id)->update($data);

            $output = array('success' => 1, 'msg' => 'Company Added successfully');
            return redirect('/company')->with('status', $output);

        }catch (Exception $e) {
            $output = array('success' => 0, 'msg' => $e->getMessage());
            return redirect()->back()->withInput()->with('status', $output);
        }        
        
    }

    public function show(Request $request,$id)
    {
        $this->datas['senddata'] =  Company::find($id);
        
        return view('company.show', $this->datas);
    }


    public function edit(Request $request,$id)
    {
        $this->datas['senddata'] = Company::find($id);
        $this->datas['route'] = route('company.update',$id);
        $this->datas['method'] = 'Post';
        return view('company.addedit')->with($this->datas);
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:100',
            'email'   =>'required',
            'logo'    =>'dimensions:width=100,height=100',
            'website' => 'required'
        ]);

        if ($validator->fails())
        {
            $output = array('success' => 0, 'msg' => $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput()->with('status', $output);
        }
        try
        {
                $data['name'] = $request->name;
                $data['email'] = $request->email;
                $data['website'] = $request->website;

            if ($request->hasFile('logo')) {
                $upload_path = 'storage/app/public/company/'.$id;
                if (!file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }
                $filename = time() . '.' . $request->file('logo')->getClientOriginalExtension();
               
                $path = $request->file('logo')->move($upload_path, $filename);
              
                if ($path) {
                    $data['logo'] = $filename;
                }
            }

            Company::where('id',$id)->update($data);

            $output = array('success' => 1, 'msg' => 'Company Updated successfully');
            return redirect('/company')->with('status', $output);

        }catch (Exception $e) {
            $output = array('success' => 0, 'msg' => $e->getMessage());
            return redirect()->back()->withInput()->with('status', $output);
        }        
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $msg="Company Deleted Successfully";
            try{
                $category = Company::where('id',$id)->delete();
                $output = array('success' => 1, 'msg' => $msg);
                
            }catch (Exception $e) {
                $output = array('success' => 0, 'msg' => $e->getMessage());
            }
        return response()->json(['success'=>true, 'data'=>$output]);
    }
}
