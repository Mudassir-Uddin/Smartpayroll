<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use App\Models\Employee;
use App\Models\Month;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class DeductionsController extends Controller
{
    //
    function index(){
        $Deduction = Deduction::all();
        $months = Month::all();
        return view('Dashboard.Deductions.index' ,compact('Deduction','months'));
    }
    public function Insert(){
        $employee_Id = Employee::all();
        $months = Month::all();
        $transaction_types_Id = TransactionType::where('category', 'deduction')->get();
        // $transaction_types_Id = TransactionType::all();
        return view('Dashboard.Deductions.insert',compact('transaction_types_Id','employee_Id','months'));
    }
    public function Store(Request $req){
        $req->validate([
            'employee_id'=>'required',
            'transaction_types_id'=>'required',
            'amount'=>'required|integer|min:0',
            'remarks'=>'required',
            
        ]);

        $Deduction = new Deduction();
        $Deduction->employee_id = $req->employee_id;
        $Deduction->transaction_types_id = $req->transaction_types_id;
        $Deduction->month_id = $req->month_id;
        $Deduction->year = $req->year;
        $Deduction->amount = $req->amount;
        $Deduction->remarks = $req->remarks;
        $Deduction->save();
        return redirect('/Deductions');

    }
    public function Edit($id){
        $employee_Id = Employee::all();
        $months = Month::all();
        $transaction_types_Id = TransactionType::where('category', 'deduction')->get();
        // $transaction_types_Id = TransactionType::all();
        $Deduction = Deduction::Where('id', $id/548548)->first();;
        return view('Dashboard.Deductions.edit', compact('Deduction','transaction_types_Id','employee_Id','months'));
    }
    public function Update(Request $req,$id){
        $req->validate([
            'employee_id'=>'required',
            'transaction_types_id'=>'required',
            'amount'=>'required|integer|min:0',
            'remarks'=>'required',
        ]);
        $Deduction = Deduction::find($id);
        $Deduction->employee_id = $req->employee_id;
        $Deduction->transaction_types_id = $req->transaction_types_id;
        $Deduction->month_id = $req->month_id;
        $Deduction->year = $req->year;
        $Deduction->amount = $req->amount;
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
