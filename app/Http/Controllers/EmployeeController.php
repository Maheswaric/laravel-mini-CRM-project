<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $this->datas['data'] = Employee::select('employees.*','companies.name as company_name')
                                        ->leftjoin('companies','companies.id','employees.company_id')
                                        ->orderby('employees.id','desc')
                                        ->paginate(10);
        return view('employee.index')->with($this->datas);
    }

    public function create()
    {
        $this->datas['senddata'] = new Employee();
        $this->datas['route'] = route('employee.store');
        $this->datas['companies'] = Company::select('name','id')->get();
        $this->datas['method'] = 'Post';
        return view('employee.addedit')->with($this->datas);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required',
            'company_id'    => 'required',
            'email'         => 'required',
            'phone'         => 'required',
        ]);

        if ($validator->fails())
        {
            $output = array('success' => 0, 'msg' => $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput()->with('status', $output);
        }
        try
        {
           // dd($request->all());

            $employee_id = Employee::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'company_id' => $request->company_id,
                'email'      => $request->email,
                'phone'      => $request->phone,
            ])->id;

            $output = array('success' => 1, 'msg' => 'Employee Added successfully');
            return redirect('/employee')->with('status', $output);

        }catch (Exception $e) {
            $output = array('success' => 0, 'msg' => $e->getMessage());
            return redirect()->back()->withInput()->with('status', $output);
        }        
        
    }

    public function show(Request $request,$id)
    {
        $this->datas['senddata'] =  Employee::find($id);
        
        return view('employee.show', $this->datas);
    }


    public function edit(Request $request,$id)
    {
        $this->datas['senddata'] = Employee::find($id);
        $this->datas['route'] = route('employee.update',$id);
        $this->datas['companies'] = Company::select('name','id')->get();
        $this->datas['method'] = 'Post';
        return view('employee.addedit')->with($this->datas);
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required',
            'company_id'    => 'required',
            'email'         => 'required',
            'phone'         => 'required',
        ]);

        if ($validator->fails())
        {
            $output = array('success' => 0, 'msg' => $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput()->with('status', $output);
        }
        try
        {
                $data['first_name'] = $request->first_name;
                $data['last_name'] = $request->last_name;
                $data['company_id'] = $request->company_id;
                $data['email'] = $request->email;
                $data['phone'] = $request->phone;

            Employee::where('id',$id)->update($data);

            $output = array('success' => 1, 'msg' => 'Employee Updated successfully');
            return redirect('/employee')->with('status', $output);

        }catch (Exception $e) {
            $output = array('success' => 0, 'msg' => $e->getMessage());
            return redirect()->back()->withInput()->with('status', $output);
        }        
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $msg="Employee Deleted Successfully";
            try{
                $category = Employee::where('id',$id)->delete();
                $output = array('success' => 1, 'msg' => $msg);
                
            }catch (Exception $e) {
                $output = array('success' => 0, 'msg' => $e->getMessage());
            }
        return response()->json(['success'=>true, 'data'=>$output]);
    }
}
