<?php

namespace App\Http\Controllers;

use App\Models\Bonuse;
use App\Models\Employee;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class BonusesController extends Controller
{
    //
    function index(){
        $Bonuse = Bonuse::all();
        return view('Dashboard.Bonuses.index' ,compact('Bonuse'));
    }
    public function Insert(){
        $employee_Id = Employee::all();
        $transaction_types_Id = TransactionType::where('category', 'bonus')->get();
        // $transaction_types_Id = TransactionType::all();
        return view('Dashboard.Bonuses.insert',compact('transaction_types_Id','employee_Id'));
    }
    public function Store(Request $req){
        $req->validate([
            'employee_id'=>'required',
            'transaction_types_id'=>'required',
            'amount'=>'required|integer|min:0',
            'date'=>'required',
            'remarks'=>'required',
            
        ]);

        $Bonuse = new Bonuse();
        $Bonuse->employee_id = $req->employee_id;
        $Bonuse->transaction_types_id = $req->transaction_types_id;
        $Bonuse->amount = $req->amount;
        $Bonuse->date = $req->date;
        $Bonuse->remarks = $req->remarks;
        $Bonuse->save();
        return redirect('/Bonuses');

    }
    public function Edit($id){
        $employee_Id = Employee::all();
        $transaction_types_Id = TransactionType::where('category', 'bonus')->get();
        // $transaction_types_Id = TransactionType::all();
        $Bonuse = Bonuse::Where('id', $id/548548)->first();;
        return view('Dashboard.Bonuses.edit', compact('Bonuse','transaction_types_Id','employee_Id'));
    }
    public function Update(Request $req,$id){
        $req->validate([
            'employee_id'=>'required',
            'transaction_types_id'=>'required',
            'amount'=>'required|integer|min:0',
            'date'=>'required',
            'remarks'=>'required',
        ]);
        $Bonuse = Bonuse::find($id);
        $Bonuse->employee_id = $req->employee_id;
        $Bonuse->transaction_types_id = $req->transaction_types_id;
        $Bonuse->amount = $req->amount;
        $Bonuse->date = $req->date;
        $Bonuse->remarks = $req->remarks;
        $Bonuse->save();
        return redirect('/Bonuses');
    }
    public function Delete($id){
        $Bonuse = Bonuse::find($id);
            
            $Bonuse->delete();
            return redirect('/Bonuses');
        
     }

}
