<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'User';
        $active = 'user';

        return view('user.index', compact('title', 'active'));
    }

    public function loadTabelUser()
    {
        // return User::with(['unit','jenjang'])->get();
        return User::get();
    }

    public function store(Request $request)
    {
        $data = [
            'id_level' => $request->level,
            'name' => $request->name,
            'email' => $request->email
        ];

        if($request->id_user==NULL){
                // insert
                $data['password'] = Hash::make($request->password); 
                User::create($data);
        }else{
            // update
            User::where('id', $request->id_user)
                ->update($data);
        }

        return response()->json([
            'status' => 'success',
            'message' => "Insert!",
        ]);
    }

    public function destroy(Request $request)
    {
        // var_dump('masuk sini');

        User::destroy($request->id);

        return response()->json([
            'status' => 'success',
            'message' => "Deleted!",
        ]);
    }

  
}
