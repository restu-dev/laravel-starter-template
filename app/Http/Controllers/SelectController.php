<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Support\Facades\Request;


class SelectController extends Controller
{

    public function level(Request $request)
    {
        $level = new Level;

        $data = $level->select('id as id', 'name as text')->orderBy('name')->get();

        return $data;
    }

}
