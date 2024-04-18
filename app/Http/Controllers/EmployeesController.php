<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;

class EmployeesController extends Controller
{
    public function index(){
      	$employees = Employee::paginate(5);
    	return view('Employee.list', compact('employees'));
    }

    public function create(){
		$countries = Country::where('active', 1)->get();
   	  	return view('Employee.create', compact('countries'));
    }

    public function store(EmployeeRequest $request){
   	   	$validated = $request->validated();

		$employeePhoto = null;
		if ($files = $request->file('employee_photo')) {
			$image = $request->file('employee_photo');
			$name = 'emp_photo'.time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('employee_images');
			$imagePath = $destinationPath. "/".  $name;
			$image->move($destinationPath, $name);
			$employeePhoto = $name;
		}

		$employeeCreate = new Employee;
		$employeeCreate->first_name = $request->first_name;
		$employeeCreate->last_name = $request->last_name;
		$employeeCreate->email = $request->email;
		$employeeCreate->country_code = $request->country_code ?? null;
		$employeeCreate->phone = $request->phone ?? null;
		$employeeCreate->address = $request->address ?? null;
		$employeeCreate->gender = $request->gender ?? null;
		$employeeCreate->hobby = !empty($request->hobby) ? implode(',', $request->hobby) : null;
		$employeeCreate->photo = $employeePhoto;
		
		if ($employeeCreate->save()) {
			return redirect()->route('index');
		}else{
			return redirect()->back();
		}
    }

    public function update(Request $request,$id){
        $employeeUpdate = Employee::where('id',base64_decode($id))->first();
   	    
		$this->validate($request,[
			'first_name'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'phone' => 'required|max:255',
         	'email' => 'required|unique:employees,email,'.$employeeUpdate->id.',id',
         	'phone' => 'required|unique:employees,phone,'.$employeeUpdate->id.',id',
        ]);

		$employeePhoto = $employeeUpdate->photo ?? null;
		if ($files = $request->file('employee_photo')) {
			$image = $request->file('employee_photo');
			$name = 'emp_photo'.time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('employee_images');
			$imagePath = $destinationPath. "/".  $name;
			$image->move($destinationPath, $name);
			$employeePhoto = $name;
		}

		$employeeUpdate->first_name = $request->first_name;
		$employeeUpdate->last_name = $request->last_name;
		$employeeUpdate->email = $request->email;
		$employeeUpdate->country_code = $request->phone;
		$employeeUpdate->phone = $request->phone;
		$employeeUpdate->address = $request->address;
		$employeeUpdate->gender = $request->gender;
		$employeeUpdate->hobby = !empty($request->hobby) ? implode(',', $request->hobby) : null;
		$employeeUpdate->photo = $employeePhoto;
	
		if ($employeeUpdate->save()) {
			return redirect()->route('index');
		}else{
			return redirect()->back();
		}
    }

    public function delete($id){
   	  Employee::where('id',base64_decode($id))->delete();
   	  return redirect()->back();
    }

    public function edit($id){
		$countries = Country::where('active', 1)->get();
		$editData = Employee::where('id',base64_decode($id))->first();
		return view('Employee.edit',compact('editData','countries'));
    }

   	public function viewEmployee($id){
		$countries = Country::where('active', 1)->get();
      	$editData = Employee::where('id',base64_decode($id))->first();
      	return view('Employee.view',compact('editData','countries'));
   	}
}
