<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function errorPermission()
    {
        return view('home', ['error' => 'Bạn không có quyền truy cập vào trang này']);
    }
    public function adminhome()
    {
        return view('Admin.modun.dashboard');
    }
}
