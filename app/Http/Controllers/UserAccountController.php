<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserAccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'User Account';
        $active = 'user-account';

        return view('user-account.index', compact('title', 'active'));
    }

    public function edit(Request $request)
    {

        $validator = Validator::make(request()->all(), [
            'name'     => 'required',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $password = $request->password;
            $password_confirmation = $request->password_confirmation;

            if($password!= $password_confirmation){
                return redirect('/user-account')->with('error', 'Failed password confirmation!');
            }else{
                // update user
                User::where(['id'=>$request->id_user])->update([
                    "name" => $request->name,
                    "password" => Hash::make($request->password)
                ]);

                return redirect('/user-account')->with('success', 'Berhasil edit User Account');
            }

        }
    }
}
