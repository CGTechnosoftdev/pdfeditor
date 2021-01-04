<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

class DashboardController extends FrontBaseController
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
        $data_array["user_document_type"] = config('constant.UPLOAD_USER_TEMPLATE');
        return view('front.dashboard', $data_array);
    }
}
