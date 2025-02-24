<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    //
    public function index(){
        $Designations = Designation::all();
        return view('Dashboard.Designations.index',compact('Designations'));
    }
    public function Insert(){
        return view('Dashboard.Designations.insert');
    }
    public function Store(Request $req){
        $req->validate([
            'name'=>'required',
        ]);
        $Designation = new Designation();
        $Designation->name = $req->name;
        $Designation->basic_salary = $req->basic_salary;
        $Designation->save();
        return redirect('/Designations');

    }
    public function Edit($id){

        $Designation = Designation::Where('id', $id/548548)->first();;
        return view('Dashboard.Designations.edit', compact('Designation'));
    }
    public function Update(Request $req,$id){
        $req->validate([
            'name'=>'required',
        ]);
        $Designation = Designation::find($id);
        $Designation->name = $req->name;
        $Designation->basic_salary = $req->basic_salary;
        $Designation->save();
        return redirect('/Designations');
    }
    public function Delete($id){
        $Designation = Designation::find($id);
        $Designation->delete();
        return redirect('/Designations');
    }

}
