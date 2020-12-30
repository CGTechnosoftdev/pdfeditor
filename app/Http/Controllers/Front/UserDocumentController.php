<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\UserTemplateFormRequest;

class UserdocumentController extends FrontBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function templateForm()
    {
        return view('front.user-document.template-form');
    }
    public function templateFormSave(UserTemplateFormRequest $request)
    {
        $input_data = $request->input();
    }
}
