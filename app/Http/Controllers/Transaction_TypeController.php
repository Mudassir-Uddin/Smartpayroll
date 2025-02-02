<?php

namespace App\Http\Controllers;

use App\Models\TransactionType;
use Illuminate\Http\Request;

class Transaction_TypeController extends Controller
{
    //
    public function index(){
        $transactiontypes = TransactionType::all();
        return view('Dashboard.Transactiontype.index',compact('transactiontypes'));
    }
    public function Insert(){
        return view('Dashboard.Transactiontype.insert');
    }
    public function Store(Request $req){
        $req->validate([
            'category'=>'required',
            'type'=>'required',
        ]);
        $transactiontype = new TransactionType();
        $transactiontype->category = $req->category;
        $transactiontype->type = $req->type;
        $transactiontype->save();
        return redirect('/Transactiontypes');

    }
    public function Edit($id){

        $transactiontype = TransactionType::Where('id', $id/548548)->first();;
        return view('Dashboard.Transactiontype.edit', compact('transactiontype'));
    }
    public function Update(Request $req,$id){
        $req->validate([
            'category'=>'required',
            'type'=>'required',
        ]);
        $transactiontype = TransactionType::find($id);
        $transactiontype->category = $req->category;
        $transactiontype->type = $req->type;
        $transactiontype->save();
        return redirect('/Transactiontypes');
    }
    public function Delete($id){
        $transactiontype = TransactionType::find($id);
        $transactiontype->delete();
        return redirect('/Transactiontypes');
    }
}
