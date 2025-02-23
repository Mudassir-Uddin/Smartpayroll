<?php

namespace App\Http\Controllers;

use App\Models\Bonuse;
use App\Models\Employee;
use App\Models\Month;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class BonusesController extends Controller
{
    //
    function index(){
        $Bonuse = Bonuse::all();
        $months = Month::all();
        return view('Dashboard.Bonuses.index' ,compact('Bonuse','months'));
    }
    public function Insert(){
        $employee_Id = Employee::all();
        $months = Month::all();
        $transaction_types_Id = TransactionType::where('category', 'Bonus')->get();
        // $transaction_types_Id = TransactionType::all();
        return view('Dashboard.Bonuses.insert',compact('transaction_types_Id','employee_Id','months'));
    }
    public function Store(Request $req){
        $req->validate([
            'employee_id'=>'required',
            'transaction_types_id'=>'required',
            'month_id'=>'required',
            'amount'=>'required|integer|min:0',
            'remarks'=>'required',
            
        ]);

        $Bonuse = new Bonuse();
        $Bonuse->employee_id = $req->employee_id;
        $Bonuse->transaction_types_id = $req->transaction_types_id;
        $Bonuse->month_id = $req->month_id;
        $Bonuse->year = $req->year;
        $Bonuse->amount = $req->amount;
        $Bonuse->remarks = $req->remarks;
        $Bonuse->save();
        return redirect('/Bonuses');

    }
    public function Edit($id){
        $employee_Id = Employee::all();
        $months = Month::all();
        $transaction_types_Id = TransactionType::where('category', 'bonus')->get();
        // $transaction_types_Id = TransactionType::all();
        $Bonuse = Bonuse::Where('id', $id/548548)->first();;
        return view('Dashboard.Bonuses.edit', compact('Bonuse','transaction_types_Id','employee_Id','months'));
    }
    public function Update(Request $req,$id){
        $req->validate([
            'employee_id'=>'required',
            'transaction_types_id'=>'required',
            'amount'=>'required|integer|min:0',
            'remarks'=>'required',
        ]);
        $Bonuse = Bonuse::find($id);
        $Bonuse->employee_id = $req->employee_id;
        $Bonuse->transaction_types_id = $req->transaction_types_id;
        $Bonuse->month_id = $req->month_id;
        $Bonuse->year = $req->year;
        $Bonuse->amount = $req->amount;
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
