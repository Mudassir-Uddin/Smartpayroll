<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalariesController extends Controller
{
    //
    public function index(){
        $Employee = Employee::all();
        $Salary = Salary::all();
        return view('Dashboard.Salaries.index',compact('Salary','Employee'));
    }
    public function Insert(){
        $employee_Id = Employee::all();
        return view('Dashboard.Salaries.insert',compact('employee_Id'));
    }
    public function Store(Request $req){
        $req->validate([
            'employee_id'=>'required',
            'date'=>'required',
            'amount'=>'required',
        ]);
        $Salary = new Salary();
        $Salary->employee_id = $req->employee_id;
        $Salary->date = $req->date;
        $Salary->amount = $req->amount;
        $Salary->save();
        return redirect('/Salaries');

    }
    public function Edit($id){

        $Employee_Id = Employee::all();
        $Salary = Salary::Where('id', $id/548548)->first();;
        return view('Dashboard.Salaries.edit', compact('Salary','Employee_Id'));
    }
    public function Update(Request $req,$id){
        $req->validate([
            'employee_id'=>'required',
            'date'=>'required',
            'amount'=>'required',
        ]);
        $Salary = Salary::find($id);
        $Salary->employee_id = $req->employee_id;
        $Salary->date = $req->date;
        $Salary->amount = $req->amount;
        $Salary->save();
        return redirect('/Salaries');
    }
    public function Delete($id){
        $Salary = Salary::find($id);
        $Salary->delete();
        return redirect('/Salaries');
    }

}
