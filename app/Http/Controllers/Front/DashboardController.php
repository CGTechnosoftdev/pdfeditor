<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\UserDocument;
use Auth;

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
        $user = Auth::user();
        $data_array = [
            'title' => 'Dashboard',
        ];
        $data_array['recent_documents'] = UserDocument::getUserRecent($user, config('constant.DOCUMENT_TYPE_FILE'));
        $data_array['recent_templates'] = UserDocument::getUserRecent($user, config('constant.DOCUMENT_TYPE_TEMPLATE'));
        $data_array["user_document_type"] = config('constant.UPLOAD_USER_TEMPLATE');
        return view('front.dashboard', $data_array);
    }
}
