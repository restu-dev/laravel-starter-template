<?php

namespace App\Http\Controllers;

use App\Models\Button;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MasterButtonController extends Controller
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
        $title = 'Master Button';
        $active = 'master-button';

        return view('master-button.index', compact('title', 'active'));
    }

    public function loadTabelButton()
    {
        $results =  Button::get();

        $disabled_edit = "";
        $yt_edit = Session::get('yt_edit');
        if($yt_edit=='T'){
            $disabled_edit= "disabled";
        }
        $edit_title = getButton('edit', 'title');
        $edit_color = getButton('edit', 'color');
        $edit_icon  = getButton('edit', 'icon');

        $disabled_hapus = "";
        $yt_hapus = Session::get('yt_hapus');
        if ($yt_hapus == 'T') {
            $disabled_hapus = "disabled";
        }
        $hapus_title  = getButton('hapus', 'title');
        $hapus_color = getButton('hapus', 'color');
        $hapus_icon  = getButton('hapus', 'icon');

        for ($i = 0; $i < count($results); $i++) {
            $id = $results[$i]->id;
            $nama = $results[$i]->name;
            $color = $results[$i]->color;
            $icon = $results[$i]->icon;


            $button = "<button class='btn btn-$color'>
                            <span class='btn-label'>
                                <i class='fa fa-$icon'></i>
                            </span>
                            $nama
                        </button>";

            $aksi = "<div class='btn-group'>
                        <button $disabled_edit data-id='$id' data-name='$nama' data-color='$color' data-icon='$icon' data-toggle='tooltip' data-placement='top' title='$edit_title' type='button' class='btn btn-$edit_color btn-sm edit_button'>
                            <i class='fas fa-$edit_icon'></i>
                        </button>
                        
                        <button $disabled_hapus data-id='$id' data-toggle='tooltip' data-placement='top' title='$hapus_title' class='btn btn-$hapus_color btn-sm hapus_button'>
                            <i class='fa fa-$hapus_icon'></i>
                        </button>
                    </div>";

            $results[$i]->button = $button;
            $results[$i]->aksi = $aksi;
        }

        return $results;
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->nama_button,
            'color' => $request->color_button,
            'icon' => $request->icon_button,
        ];

        if ($request->id_button == NULL) {
            // insert
            Button::create($data);
        } else {
            // update
            Button::where('id', $request->id_button)
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

        Button::destroy($request->id);

        return response()->json([
            'status' => 'success',
            'message' => "Deleted!",
        ]);
    }
}
