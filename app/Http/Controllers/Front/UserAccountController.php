<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Auth;

class UserAccountController extends FrontBaseController
{
    function __construct()
    {
    }

    public function accountInformation()
    {
        $user = Auth::user();
        $data_array = [
            'title' => "Account Information",
            'account_id' => getAccountId($user->id),
            'registration_date' => changeDateFormat($user->created_at),
            'last_login' => changeDateFormat(now()),
            'user' => $user,
        ];
        return view('front.user-account.account-information', $data_array);
    }
}
