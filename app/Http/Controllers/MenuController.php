<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $title = 'Menu';
        $active = 'menu';

        return view('menu.index', compact('title', 'active'));
    }

    public function loadTabelMenuHeader()
    {
        return Menu::where(["yt_header"=>"Y"])->orderBy('urut_header', 'asc')->get();
    }

    public function loadTabelMenuParent(Request $request)
    {   
        $id_header = $request->id_header;

        $where = ["yt_parent"=>"Y","id_header"=>$id_header];
        return Menu::where($where)->orderBy('urut_parent', 'asc')->get();
    }

    public function storeMenuHeader(Request $request)
    {
        $id = $request->id;
        $data = [
            'nama' => $request->nama,
            'url' => $request->url,
            'punya_sub' => $request->sub,
            'yt_header' => 'Y',
            'icon' => $request->icon,
            'urut_header' => $request->urut_header,
        ];

        if($id==NULL){
            // insert
            Menu::create($data);
        }else{
            // update
            Menu::where('id', $id)
                ->update($data);
        }

        return response()->json([
            'status' => 'success',
            'message' => "Insert!",
        ]);
    }

    public function storeMenuParent(Request $request)
    {
        $id_parent = $request->id_parent;

        $data = [
            'id_header' => $request->id_header,
            'nama' => $request->nama,
            'url' => $request->url,
            'yt_parent' => 'Y',
            'icon' => 'fa-circle',
            'urut_parent' => $request->urut_parent,
        ];

        if($id_parent==NULL){
            // insert
            Menu::create($data);
        }else{
            // update
            Menu::where('id', $id_parent)
                ->update($data);
        }

        return response()->json([
            'status' => 'success',
            'message' => "Insert!",
            'id_header' => $request->id_header,
            'nama' =>$request->nama,
        ]);
    }

    public function detailMenuHeader(Request $request)
    {
        $id_header = $request->id_header;

        $menu = Menu::where(["id"=>$id_header])->first();
        return $menu;
    }

    public function destroyParent(Request $request)
    {
        Menu::destroy($request->id);

        return response()->json([
            'status' => 'success',
            'message' => "Deleted!",
        ]);
    }
}
