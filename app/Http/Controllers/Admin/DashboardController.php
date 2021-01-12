<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class DashboardController extends AdminBaseController
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
        $data_array = ['title' => 'Dashboard', 'heading' => 'Dashboard'];
        return view('admin.dashboard', $data_array);
    }

    /**
     * [changeStatus description]
     * @author Akash Sharma
     * @date   2020-10-27
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function changeStatus(Request $request)
    {
        $modelArr = config('custom_config.model_arr');
        $activeStatus = config('constant.STATUS_ACTIVE');
        $inactiveStatus = config('constant.STATUS_INACTIVE');
        $responseType = false;
        $responseMessage = 'Error occoured, Please try again.';
        $responseData = '';
        $inputData = $request->input();
        if (!empty($inputData['type']) && !empty($inputData['id']) && isset($inputData['status']) && array_key_exists($inputData['type'], $modelArr)) {
            $modelName = $modelArr[$inputData['type']];
            $model = "App\Models\\" . $modelArr[$inputData['type']];
            $model = new $model;
            $dataRow = $model->where(['id' => $inputData['id'], 'status' => $inputData['status']])->first();
            if (!empty($dataRow)) {
                $newStatus = ($dataRow->status == $activeStatus) ? $inactiveStatus : $activeStatus;
                $dataRow->status = $newStatus;
                $dataRow->save();

                $responseType = true;
                $responseMessage = 'Status update successfully';
                $responseData = $newStatus;
            }
        }
        return json_encode(['success' => $responseType, 'data' => $responseData, 'message' => $responseMessage]);
    }
}
