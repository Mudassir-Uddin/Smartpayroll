<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    //
    public function index(){
        $Departments = Department::all();
        return view('Dashboard.Departments.index',compact('Departments'));
    }
    public function Insert(){
        return view('Dashboard.Departments.insert');
    }
    public function Store(Request $req){
        $req->validate([
            'name'=>'required',
            'description'=>'required',
        ]);
        $department = new Department();
        $department->name = $req->name;
        $department->description = $req->description;
        $department->save();
        return redirect('/Departments');

    }
    public function Edit($id){

        $department = Department::Where('id', $id/548548)->first();;
        return view('Dashboard.Departments.edit', compact('department'));
    }
    public function Update(Request $req,$id){
        $req->validate([
            'name'=>'required',
            'description'=>'required',
        ]);
        $department = Department::find($id);
        $department->name = $req->name;
        $department->description = $req->description;
        $department->save();
        return redirect('/Departments');
    }
    public function Delete($id){
        $department = Department::find($id);
        $department->delete();
        return redirect('/Departments');
    }
}
