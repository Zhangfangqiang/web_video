<?php

namespace App\Http\Controllers\Admin;

use App\Models\UploadRecord;
use App\Models\UserHasUploadRecord;
use App\Http\Requests\Admin\UeditorRequest;
use App\Handlers\FileUploadHandler;
use App\Http\Controllers\Controller;

class UeditorController extends Controller
{
    private $CONFIG;            #用于存放配置文件的常量

    /**
     * 构造方法
     * UeditorController constructor.
     */
    public function __construct()
    {
        $this->CONFIG = config('ueditor');
    }

    /**
     * 上传控制器总控
     * @param UeditorRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function upload(UeditorRequest $request)
    {
        switch ($request->action) {
            #获取配置文件
            case 'config'       :
                $result = $this->CONFIG;
                break;
            #上传图片
            #上传涂鸦
            #上传视频
            #上传文件
            case 'uploadimage'  :
            case 'uploadscrawl' :
            case 'uploadvideo'  :
            case 'uploadfile'   :
                $result = $this->actionUpload($request);
                break;
            #列出图片
            #列出文件
            case 'listimage'    :
            case 'listfile'     :
                $result = $this->actionList($request);
                break;
            #抓取远程文件
            case 'catchimage'   :
                $result = include("action_crawler.php");
                break;
            default:
                $result = json_encode(array(
                    'state'=> '请求地址出错'
                ));
                break;
        }

        if (isset($request->callback)) {
            if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
                return response(htmlspecialchars($request->callback) . "($result)", 403);
            } else {
                return response(json_encode(['state' => 'callback参数不合法']) , 200);
            }
        } else {
            return response($result,200);
        }

    }

    /**
     * 上传图片 上传涂鸦 上传视频 上传文件 总控的方法
     * @param UeditorRequest $request
     * @return false|string
     */
    private function actionUpload(UeditorRequest $request)
    {
        switch ($request->action) {
            case 'uploadimage':

                $config = [
                    "pathFormat" => $this->CONFIG['imagePathFormat'],
                    "maxSize"    => $this->CONFIG['imageMaxSize'],
                    "allowFiles" => $this->CONFIG['imageAllowFiles']
                ];
                $base64    = "upload";
                $fieldName = $this->CONFIG['imageFieldName'];
                break;
            case 'uploadscrawl':

                $config = [
                    "pathFormat" => $this->CONFIG['scrawlPathFormat'],
                    "maxSize"    => $this->CONFIG['scrawlMaxSize'],
                    "allowFiles" => $this->CONFIG['scrawlAllowFiles'],
                    "oriName"    => "scrawl.png"
                ];
                $base64    = "base64";
                $fieldName = $this->CONFIG['scrawlFieldName'];
                break;
            case 'uploadvideo':

                $config = [
                    "pathFormat" => $this->CONFIG['videoPathFormat'],
                    "maxSize"    => $this->CONFIG['videoMaxSize'],
                    "allowFiles" => $this->CONFIG['videoAllowFiles']
                ];
                $base64    = "upload";
                $fieldName = $this->CONFIG['videoFieldName'];
                break;
            case 'uploadfile':
            default:
                $config = [
                    "pathFormat" => $this->CONFIG['filePathFormat'],
                    "maxSize"    => $this->CONFIG['fileMaxSize'],
                    "allowFiles" => $this->CONFIG['fileAllowFiles']
                ];
                $base64    = "upload";
                $fieldName = $this->CONFIG['fileFieldName'];
                break;
        }

        $uploader = new FileUploadHandler($request, $fieldName, $config, $base64);
        return json_encode($uploader->getFileInfo());
    }

    /**
     * 返回上传文件列表
     * @param UeditorRequest $request
     * @return false|string
     */
    private function actionList(UeditorRequest $request)
    {
        #根据亲戚定义配置文件
        switch ($request->action) {
            case 'listfile':
                $allowFiles = $this->CONFIG['fileManagerAllowFiles'];
                $listSize   = $this->CONFIG['fileManagerListSize'];
                $path       = $this->CONFIG['fileManagerListPath'];
                break;

            case 'listimage':
            default:
                $allowFiles = $this->CONFIG['imageManagerAllowFiles'];
                $listSize   = $this->CONFIG['imageManagerListSize'];
                $path       = $this->CONFIG['imageManagerListPath'];
        }

        $allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);
        $size       = isset($request->size) ? htmlspecialchars($request->size) : $listSize;
        $start      = isset($request->start) ? htmlspecialchars($request->start) : 0;
        $end        = $start + $size;

        $uploadRecord = UploadRecord::whereIn('id', UserHasUploadRecord::where('user_id', \Auth::user()->id)->get()->pluck('upload_record_id'))
                        ->offset($start)->limit($size)->get();

        if (!count($uploadRecord)) {
            return json_encode(["state" => "no match file", "list" => array(), "start" => $start, "total" => count($uploadRecord)]);
        }else{
            foreach ($uploadRecord as $key => $value){
                $list[] = ['url' => $value->path, 'mtime' => 0];
            }
            return json_encode([
                "state" => "SUCCESS",
                "list"  => $list,
                "start" => $start,
                "total" => count($uploadRecord)
            ]);
        }
    }
}
