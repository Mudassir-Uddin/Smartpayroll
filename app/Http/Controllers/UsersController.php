<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    function Users(){
        
        $Users = Users::all();
        return view('Dashboard.Users.index',compact('Users'));
    }
    function insert()
    {
        return view('Dashboard.Users.insert');
    }

    function Store(Request $req)
    {

        $req->validate([
            'name' => 'required | max:50 | min:3',
            'img' => 'nullable',
            'email' => 'required|email|unique:user,email',
            'pass' => 'required | min:6'

        ]);

            $user = new Users;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->pass);
            // $user->status = 1;
            $user->status = 1;
            $user->role = 2;

            if (session()->has('role') && session('role') == 1){
                
                $user->status = $req->status;
                $user->role = $req->role;
            }
            $user->save();

           //  Session::put('lawyerMessage' , "Your Request Has been seent to Admin Please Wait for 1 Hours",);
             
            // session()->put([
            //     'id' => $user->id,
            //     'name' => $user->name,
            //     'email' => $user->email,
            //     'role' => $user->role,
            // ]);
        
       
        return redirect('/DbUsers');

    }
    function edit($id)
    {
        $user = Users::Where('id', $id/548548)->first();
        return view('Dashboard.Users.edit', compact('user'));
    }
    function update(Request $req, $id)
    {
        $user = Users::find($id);
        $imgname = $user->img;
        if ($req->hasfile('img')) {
            
            $img = $req->img;
            $imgname = $img->getClientOriginalName();
            $imgname = time() . "__" . $imgname;
            $img->move("images/Userimages/", $imgname);
            $imgname = "/images/Userimages/".$imgname;
            if($user->img){
                if(file_exists(public_path($user->img))){
                    unlink(public_path($user->img));
                }
            }
        }
            $user->name = $req->name;
            $user->img = $imgname;
            $user->email = $req->email;
            if (session()->has('role') && session('role') == 1){
                
                $user->status = $req->status;
                $user->role = $req->role;
            }

            $user->save();

            return redirect('/DbUsers');

        }
    

    function delete($id)
    {
        $st = Users::find($id);

        if ($st) {
            if($st->img){
                if(file_exists(public_path($st->img))){
                    unlink(public_path($st->img));
                }
            }
            $st->delete();
            return redirect('/DbUsers');
        }
        return redirect('/DbUsers');
    }
}
