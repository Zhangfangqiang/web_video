<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UploadRecord;
use App\Http\Requests\Admin\UploadRecordRequest;
use App\Http\Controllers\Controller;

class UploadRecordController extends Controller
{

    /**
     * 展示数据页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.upload_records.index' );
    }

}
