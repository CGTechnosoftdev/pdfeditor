<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

class FrontHomeController extends FrontBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('front.front-home');
    }
}
