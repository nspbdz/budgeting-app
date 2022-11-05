<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use UserHelp;

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
    public function test_fungsi($nilai=0)
    {
    // dd(UserHelp::get_username(1));
        // echo UserHelp::get_username($nilai);
        // .get_DashboardAccess($nilai);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }
}
