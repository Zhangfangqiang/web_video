<?php

namespace App\Handlers;

use App\Models\UploadRecord;
use App\Models\UserHasUploadRecord;
use Illuminate\Support\Facades\Storage;

class FileUploadHandler
{
    private $fileField;         #文件域名
    private $fileMd5;           #文件移动前md5值
    private $file;              #文件上传对象
    private $config;            #配置信息
    private $oriName;           #原始文件名
    private $fileName;          #新文件名
    private $fullName;          #完整文件名,即从当前配置目录开始的URL
    private $filePath;          #完整文件名,即从当前配置目录开始的URL
    private $fileSize;          #文件大小
    private $fileType;          #文件类型
    private $stateInfo;         #上传状态信息,

    /**
     * 上传状态映射表，国际化用户需考虑此处数据的国际化
     * @var array
     */
    private $stateMap = [
        "SUCCESS",
        "文件大小超出 upload_max_filesize 限制",
        "文件大小超出 MAX_FILE_SIZE 限制",
        "文件未被完整上传",
        "没有文件被上传",
        "上传文件为空",
        "ERROR_TMP_FILE"            => "临时文件错误",
        "ERROR_TMP_FILE_NOT_FOUND"  => "找不到临时文件",
        "ERROR_SIZE_EXCEED"         => "文件大小超出网站限制",
        "ERROR_TYPE_NOT_ALLOWED"    => "文件类型不允许",
        "ERROR_CREATE_DIR"          => "目录创建失败",
        "ERROR_DIR_NOT_WRITEABLE"   => "目录没有写权限",
        "ERROR_FILE_MOVE"           => "文件保存时出错",
        "ERROR_FILE_NOT_FOUND"      => "找不到上传文件",
        "ERROR_WRITE_CONTENT"       => "写入文件内容错误",
        "ERROR_UNKNOWN"             => "未知错误",
        "ERROR_DEAD_LINK"           => "链接不可用",
        "ERROR_HTTP_LINK"           => "链接不是http链接",
        "ERROR_HTTP_CONTENTTYPE"    => "链接contentType不正确",
        "INVALID_URL"               => "非法 URL",
        "INVALID_IP"                => "非法 IP"
    ];

    /**
     * 构造函数
     * @param string $fileField 表单名称
     * @param array $config 配置项
     * @param bool $base64 是否解析base64编码，可省略。若开启，则$fileField代表的是base64编码的字符串表单名
     */
    public function __construct($request , $fileField, $config, $type = "upload")
    {
        $this->file      = $request->$fileField;                            #获取字段 file
        $this->type      = $type;                                           #文件类型
        $this->config    = $config;                                         #配置文件
        $this->fileField = $fileField;                                      #文件字段

        switch ($type) {
            case 'remote':
                $this->saveRemote();
                break;
            case 'base64':
                $this->upBase64();
                break;
            default:
                $this->upFile();
                break;
        }

        $this->stateMap['ERROR_TYPE_NOT_ALLOWED'];
    }

    /**
     * 上传文件的主处理方法
     * @return mixed
     */
    private function upFile()
    {
        if ($this->file->isValid()) {                                           #上传成功

            $this->oriName   = $this->file->getClientOriginalName();            #文件原始名称
            $this->fileSize  = $this->file->getClientSize();                    #文件大小
            $this->fileType  = $this->file->getClientMimeType();                #文件类型
            $this->fileMd5   = md5_file($this->file->getRealPath());            #文件移动前md5值
            $this->fullName  = $this->getFullName();                            #定义移动后 文件名和路径
            $this->fileName  = $this->getFileName();                            #获取移动后 文件名
            $this->filePath  = $this->getFilePath();                            #获取文件路径

            $this->fileMove(file_get_contents($this->file->getRealPath()));
        } else {
            $this->stateInfo = $this->getStateInfo('ERROR_FILE_NOT_FOUND');
            return;
        }
    }

    /**
     * base64 文件上传 涂鸦上传
     */
    private function upBase64()
    {
        $img             = base64_decode($this->file);
        $this->oriName   = $this->config['oriName'];
        $this->fileSize  = strlen($img);
        $this->fileType  = 'image/png';
        $this->fileMd5   = md5($img);                                       #文件移动前md5值
        $this->fullName  = $this->getFullName();                            #定义移动后 文件名和路径
        $this->fileName  = $this->getFileName();                            #获取移动后 文件名
        $this->filePath  = $this->getFilePath();                            #获取文件路径
        $this->fileMove($img);
    }

    /**
     * 远程获取图片 编辑器里面好像没有 T_T
     */
    private function saveRemote()
    {
        dd('远程');
    }

    /**
     * 公用移动文件 加数据判断判断
     * @param $fileData
     */
    public function fileMove($fileData)
    {
        #如果存在这个文件上传日志
        if (null == ($uploadRecord = UploadRecord::where('md5', $this->fileMd5)->first())) {

            #检查文件大小是否超出限制
            if (!$this->checkSize()) {
                $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
                return;
            }

            #检查是否不允许的文件格式
            if (!$this->checkType()) {
                $this->stateInfo = $this->getStateInfo("ERROR_TYPE_NOT_ALLOWED");
                return;
            }

            #移动数据
            if (Storage::disk('uploads')->put($this->fullName, $fileData)){
                #移动成功
                $this->fullName  = Storage::disk('uploads')->url($this->fullName);                           #获取文件url
                $this->stateInfo = $this->stateMap[0];                                                             #定义文件成功状态
                $uploadRecord    = UploadRecord::create(['path' => $this->fullName, 'size' => $this->fileSize, 'md5' => $this->fileMd5]);
                $uploadRecord->user()->attach(\Auth::user()->id);                                                  #进行关系关联
            }else{
                #移动失败
                $this->stateInfo = $this->getStateInfo("ERROR_FILE_MOVE");
            }

        }else{
            $this->fullName  = $uploadRecord->path;                                                             #这里直接将记录中的文件放到移动后
            $this->fileName  = $this->getFileName();                                                            #获取移动后 文件名
            $this->filePath  = $this->getFilePath();                                                            #获取文件路径
            $this->stateInfo = $this->stateMap[0];                                                              #定义文件成功状态
            $uploadRecord->user()->attach(\Auth::user()->id);                                                   #进行关系关联

        }
    }

    /**
     * 获取文件扩展名
     * @return string
     */
    private function getFileExt()
    {
        return strtolower(strrchr($this->oriName, '.'));
    }

    /**
     * 获取上传后 文件完整路径
     * @return string
     */
    private function getFilePath()
    {
        $fullname = $this->fullName;
        $rootPath = $_SERVER['DOCUMENT_ROOT'];

        if (substr($fullname, 0, 1) != '/') {
            $fullname = '/' . $fullname;
        }

        return $rootPath . $fullname;
    }

    /**
     * 获取上传后 文件名
     * @return string
     */
    private function getFileName () {
        return substr($this->filePath, strrpos($this->filePath, '/') + 1);
    }

    /**
     * 获取上传后 成功状态
     * @param $errCode
     * @return string
     */
    private function getStateInfo($errCode)
    {
        return !$this->stateMap[$errCode] ? $this->stateMap["ERROR_UNKNOWN"] : $this->stateMap[$errCode];
    }

    /**
     * 上传前 重命名文件 和定义存储路径
     * @return string
     */
    private function getFullName()
    {
        #替换日期事件
        $t      = time();
        $d      = explode('-', date("Y-y-m-d-H-i-s"));
        $format = $this->config["pathFormat"];
        $format = str_replace("{yyyy}", $d[0], $format);
        $format = str_replace("{yy}", $d[1], $format);
        $format = str_replace("{mm}", $d[2], $format);
        $format = str_replace("{dd}", $d[3], $format);
        $format = str_replace("{hh}", $d[4], $format);
        $format = str_replace("{ii}", $d[5], $format);
        $format = str_replace("{ss}", $d[6], $format);
        $format = str_replace("{time}", $t, $format);

        #过滤文件名的非法自负,并替换文件名
        $oriName = substr($this->oriName, 0, strrpos($this->oriName, '.'));
        $oriName = preg_replace("/[\|\?\"\<\>\/\*\\\\]+/", '', $oriName);
        $format  = str_replace("{filename}", $oriName, $format);

        #替换随机字符串
        $randNum = rand(1, 10000000000) . rand(1, 10000000000);
        if (preg_match("/\{rand\:([\d]*)\}/i", $format, $matches)) {
            $format = preg_replace("/\{rand\:[\d]*\}/i", substr($randNum, 0, $matches[1]), $format);
        }

        return $format .$this->getFileExt();
    }

    /**
     * 获取移动后 各项成功信息
     * @return array
     */
    public function getFileInfo()
    {
        return array(
            "state"    => $this->stateInfo,
            "url"      => $this->fullName,
            "title"    => $this->fileName,
            "original" => $this->oriName,
            "type"     => $this->fileType,
            "size"     => $this->fileSize
        );
    }

    /**
     * 文件类型检测
     * @return bool
     */
    private function checkType()
    {
        return in_array($this->getFileExt(), $this->config["allowFiles"]);
    }

    /**
     * 文件大小检测
     * @return bool
     */
    private function checkSize()
    {
        return $this->fileSize <= ($this->config["maxSize"]);
    }
}
