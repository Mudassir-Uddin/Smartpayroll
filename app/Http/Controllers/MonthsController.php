<?php

namespace App\Http\Controllers;

use App\Models\Month;
use Illuminate\Http\Request;

class MonthsController extends Controller
{
    //
    public function index(){
        $Months = Month::all();
        return view('Dashboard.Months.index',compact('Months'));
    }
    public function Insert(){
        return view('Dashboard.Months.insert');
    }
    public function Store(Request $req){
        $req->validate([
            'name'=>'required',
        ]);
        $Month = new Month();
        $Month->name = $req->name;
        $Month->save();
        return redirect('/Months');

    }
    public function Edit($id){

        $Month = Month::Where('id', $id/548548)->first();;
        return view('Dashboard.Months.edit', compact('Month'));
    }
    public function Update(Request $req,$id){
        $req->validate([
            'name'=>'required',
        ]);
        $Month = Month::find($id);
        $Month->name = $req->name;
        $Month->save();
        return redirect('/Months');
    }
    public function Delete($id){
        $Month = Month::find($id);
        $Month->delete();
        return redirect('/Months');
    }

}
