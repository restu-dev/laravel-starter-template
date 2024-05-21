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
        $results = User::get();

        $edit_title = getButton('edit', 'title');
        $edit_color = getButton('edit', 'color');
        $edit_icon  = getButton('edit', 'icon');

        $hapus_title  = getButton('hapus', 'title');
        $hapus_color = getButton('hapus', 'color');
        $hapus_icon  = getButton('hapus', 'icon');

        for($i=0; $i<count($results); $i++){
            $id = $results[$i]->id;
            $nama = $results[$i]->name;
            $email = $results[$i]->email;
            $level = $results[$i]->id_level;

            $aksi = "<div class='btn-group'>
                        <button data-id='$id' data-name='$nama' data-email='$email' data-level='$level' data-toggle='tooltip' data-placement='top' title='$edit_title' type='button' class='btn btn-$edit_color btn-sm edit_user'>
                            <i class='fas fa-$edit_icon'></i>
                        </button>
                        
                        <button data-id='$id' data-toggle='tooltip' data-placement='top' title='$hapus_title' class='btn btn-$hapus_color btn-sm hapus_user'>
                            <i class='fa fa-$hapus_icon'></i>
                        </button>
                    </div>";

            $results[$i]->aksi = $aksi;
            
        }

        return $results;
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
