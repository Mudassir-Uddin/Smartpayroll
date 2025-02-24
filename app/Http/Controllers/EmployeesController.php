<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    //
    public function getBasicSalary($id)
{
    $designation = Designation::find($id);
    return response()->json(['basic_salary' => $designation ? $designation->basic_salary : 0]);
}

    public function index(){
        $Employee = Employee::all();
        return view('Dashboard.Employees.index',compact('Employee'));
    }
    public function Insert(){

        $designation_Id = Designation::all();
        $department_Id = Department::all();
        return view('Dashboard.Employees.insert',compact('department_Id','designation_Id'));
    }
    public function Store(Request $req){
        $req->validate([
            'employee_id'=>'required|max:10',
            'name'=>'required',
            'img' =>'required',
            'email' => 'required|email|unique:employees,email',
            'phone'=>'required|min:11|max:11',
            'address'=>'required',
            'designation'=>'required',
            'department_id'=>'required',
            'basic_salary'=>'required',
            'joining_date'=>'required',
            'status'=>'required',
        ]);

        $img = $req->img;
        $imgname = time() . "__" . $img->getClientOriginalName();
        $img->move("images/Employeesimages/", $imgname);
    
        $Employee = new Employee();
        $Employee->employee_id = $req->employee_id;
        $Employee->name = $req->name;
        $Employee->img = "images/Employeesimages/$imgname";
        $Employee->email = $req->email;
        $Employee->phone = $req->phone;
        $Employee->address = $req->address;
        $Employee->designation = $req->designation;
        $Employee->department_id = $req->department_id;
        $Employee->basic_salary = $req->basic_salary;
        $Employee->joining_date = $req->joining_date;
        $Employee->status = $req->status;
        $Employee->save();
        return redirect('/Employees');

    }
    public function Edit($id){
        $department_Id = Department::all();
        $Employee = Employee::Where('id', $id/548548)->first();
        return view('Dashboard.Employees.edit', compact('Employee','department_Id'));
    }
    public function Update(Request $req,$id){
        $req->validate([
            'employee_id'=>'required|max:10',
            'name'=>'required',
            'img' =>'required',
            'email' => 'required|email|unique:employees,email',
            'phone'=>'required|min:11|max:11',
            'address'=>'required',
            'designation'=>'required',
            'department_id'=>'required',
            'basic_salary'=>'required|integer|min:0',
            'joining_date'=>'required',
            'status'=>'required',
        ]);
        $Employee = Employee::find($id);
        $imgname = $Employee->img;
        if ($req->hasfile('img')) {

            $img = $req->img;
            $imgname = $img->getClientOriginalName();
            $imgname = time() . "__" . $imgname;
            $img->move("images/Employeesimages/", $imgname);
            $imgname = "/images/Employeesimages/" . $imgname;
            if ($Employee->img) {
                if (file_exists(public_path($Employee->img))) {
                    unlink(public_path($Employee->img));
                }
            }
        }
        $Employee->employee_id = $req->employee_id;
        $Employee->name = $req->name;
        $Employee->img = $imgname;
        $Employee->email = $req->email;
        $Employee->phone = $req->phone;
        $Employee->address = $req->address;
        $Employee->designation = $req->designation;
        $Employee->department_id = $req->department_id;
        $Employee->basic_salary = $req->basic_salary;
        $Employee->joining_date = $req->joining_date;
        $Employee->status = $req->status;
        $Employee->save();
        return redirect('/Employees');
    }
    public function Delete($id){
        $Employee = Employee::find($id);
        if ($Employee) {
            if ($Employee->img) {
                if (file_exists(public_path($Employee->img))) {
                    unlink(public_path($Employee->img));
                }
            }
            $Employee->delete();
            return redirect('/Employees');
        }
        return redirect('/Employees');
    }

}
