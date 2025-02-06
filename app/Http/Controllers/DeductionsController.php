<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use App\Models\Employee;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class DeductionsController extends Controller
{
    //
    function index(){
        $Deduction = Deduction::all();
        return view('Dashboard.Deductions.index' ,compact('Deduction'));
    }
    public function Insert(){
        $employee_Id = Employee::all();
        $transaction_types_Id = TransactionType::where('category', 'deduction')->get();
        // $transaction_types_Id = TransactionType::all();
        return view('Dashboard.Deductions.insert',compact('transaction_types_Id','employee_Id'));
    }
    public function Store(Request $req){
        $req->validate([
            'employee_id'=>'required',
            'transaction_types_id'=>'required',
            'amount'=>'required|integer|min:0',
            'date'=>'required',
            'remarks'=>'required',
            
        ]);

        $Deduction = new Deduction();
        $Deduction->employee_id = $req->employee_id;
        $Deduction->transaction_types_id = $req->transaction_types_id;
        $Deduction->amount = $req->amount;
        $Deduction->date = $req->date;
        $Deduction->remarks = $req->remarks;
        $Deduction->save();
        return redirect('/Deductions');

    }
    public function Edit($id){
        $employee_Id = Employee::all();
        $transaction_types_Id = TransactionType::where('category', 'deduction')->get();
        // $transaction_types_Id = TransactionType::all();
        $Deduction = Deduction::Where('id', $id/548548)->first();;
        return view('Dashboard.Deductions.edit', compact('Deduction','transaction_types_Id','employee_Id'));
    }
    public function Update(Request $req,$id){
        $req->validate([
            'employee_id'=>'required',
            'transaction_types_id'=>'required',
            'amount'=>'required|integer|min:0',
            'date'=>'required',
            'remarks'=>'required',
        ]);
        $Deduction = Deduction::find($id);
        $Deduction->employee_id = $req->employee_id;
        $Deduction->transaction_types_id = $req->transaction_types_id;
        $Deduction->amount = $req->amount;
        $Deduction->date = $req->date;
        $Deduction->remarks = $req->remarks;
        $Deduction->save();
        return redirect('/Deductions');
    }
    public function Delete($id){
        $Deduction = Deduction::find($id);
            
            $Deduction->delete();
            return redirect('/Deductions');
        
     }

}
