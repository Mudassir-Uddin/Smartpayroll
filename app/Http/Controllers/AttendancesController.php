<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendancesController extends Controller
{
    //
    public function index(){
        $Employee = Employee::all();
        $Attendances = Attendance::all();
        return view('Dashboard.Attendances.index',compact('Attendances','Employee'));
    }
    public function Insert(){
        $employee_Id = Employee::all();
        return view('Dashboard.Attendances.insert',compact('employee_Id'));
    }
    public function Store(Request $req){
        $req->validate([
            'employee_id'=>'required',
            'date'=>'required',
            'status'=>'required',
            'time_in'=>'required',
            'time_out'=>'required',
        ]);
        $Attendance = new Attendance();
        $Attendance->employee_id = $req->employee_id;
        $Attendance->date = $req->date;
        $Attendance->status = $req->status;
        $Attendance->time_in = $req->time_in;
        $Attendance->time_out = $req->time_out;
        $Attendance->save();
        return redirect('/Attendances');

    }
    public function Edit($id){

        $Employee_Id = Employee::all();
        $Attendance = Attendance::Where('id', $id/548548)->first();;
        return view('Dashboard.Attendances.edit', compact('Attendance','Employee_Id'));
    }
    public function Update(Request $req,$id){
        $req->validate([
            'employee_id'=>'required',
            'date'=>'required',
            'status'=>'required',
            'time_in'=>'required',
            'time_out'=>'required',
        ]);
        $Attendance = Attendance::find($id);
        $Attendance->employee_id = $req->employee_id;
        $Attendance->date = $req->date;
        $Attendance->status = $req->status;
        $Attendance->time_in = $req->time_in;
        $Attendance->time_out = $req->time_out;
        $Attendance->save();
        return redirect('/Attendances');
    }
    public function Delete($id){
        $Attendance = Attendance::find($id);
        $Attendance->delete();
        return redirect('/Attendances');
    }
}
