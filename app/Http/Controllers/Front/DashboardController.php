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
        // $path = "https://www.google.com/search?q=bocar+image&tbm=isch&source=iu&ictx=1&fir=Te26YTQfyvUIZM%252CpRnhJbXGMNDAKM%252C_&vet=1&usg=AI4_-kRrU57hlK8U0g4_KXKetP9Ht76Z9w&sa=X&ved=2ahUKEwjghbvWopbuAhX7yDgGHc4HBxUQ9QF6BAgLEAE#imgrc=Te26YTQfyvUIZM";
        // dd(pathinfo($path, PATHINFO_FILENAME));
        $user = Auth::user();
        $data_array = [
            'title' => 'Dashboard',
        ];

        $document_params['user_id'] = $user->id;
        $document_params['type'] = config('constant.DOCUMENT_TYPE_FILE');
        $data_array['recent_documents'] = UserDocument::getDocumentList(['user_id' => $user->id, 'type' => config('constant.DOCUMENT_TYPE_FILE'), 'limit' => 5]);
        $data_array['recent_templates'] = UserDocument::getDocumentList(['user_id' => $user->id, 'type' => config('constant.DOCUMENT_TYPE_TEMPLATE'), 'limit' => 5]);
        $data_array["user_document_type"] = config('constant.UPLOAD_USER_TEMPLATE');
        $data_array["footer_menu"] = true;
        return view('front.dashboard', $data_array);
    }
}
