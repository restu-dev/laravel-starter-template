<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $title = 'Level';
        $active = 'level';

        return view('level.index', compact('title', 'active'));
    }

    public function loadTabelLevel()
    {
        $results =  Level::get();

        $edit_title = getButton('edit', 'title');
        $edit_color = getButton('edit', 'color');
        $edit_icon  = getButton('edit', 'icon');

        $hapus_title  = getButton('hapus', 'title');
        $hapus_color = getButton('hapus', 'color');
        $hapus_icon  = getButton('hapus', 'icon');

        for($i=0; $i<count($results); $i++){
            $id = $results[$i]->id;
            $nama = $results[$i]->name;

            $aksi = "<div class='btn-group'>
                        <button data-id='$id' data-name='$nama' data-toggle='tooltip' data-placement='top' title='$edit_title' type='button' class='btn btn-$edit_color btn-sm edit_level'>
                            <i class='fas fa-$edit_icon'></i>
                        </button>
                        
                        <button data-id='$id' data-toggle='tooltip' data-placement='top' title='$hapus_title' class='btn btn-$hapus_color btn-sm hapus_level'>
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
            'name' => $request->nama_level,
        ];

        if($request->id_level==NULL){
            // insert
            Level::create($data);
        }else{
            // update
            Level::where('id', $request->id_level)
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

        Level::destroy($request->id);

        return response()->json([
            'status' => 'success',
            'message' => "Deleted!",
        ]);
    }
}
