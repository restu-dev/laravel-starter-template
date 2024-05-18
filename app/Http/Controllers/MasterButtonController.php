<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
