<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiBaseController;

class ApiAuthController extends ApiBaseController
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
     * [logout description]
     * @author Akash Sharma
     * @date   2020-11-10
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function logout(Request $request)
    {
        try {
            $input_data = $request->input();
            $logout_type = $input_data['logout_devices'] ?? 'current';
            switch ($logout_type) {
                case 'all':
                    auth('api')->user()->tokens->each(function ($token, $key) {
                        $token->revoke();
                    });
                    break;
                case 'other':
                    $current_token = $request->user()->token();
                    auth('api')->user()->tokens->each(function ($token, $key) use ($current_token) {
                        if ($token->id != $current_token->id) {
                            $token->revoke();
                        }
                    });
                    break;
                case 'current':
                default:
                    $current_token = $request->user()->token();
                    $current_token->revoke();
                    break;
            }
            return $this->sendSuccess([], 'Logged out successfully!');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 401);
        }
    }
}
