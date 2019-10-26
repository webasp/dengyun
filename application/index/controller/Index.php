<?php
namespace app\index\controller;

use Qiniu\Storage\UploadManager;
use Qiniu\Auth;

class Index
{
    public function index()
    {


        $auth = new Auth(config('qiniu.accessKey'), config('qiniu.secretKey'));
        return $auth->uploadToken(config('qiniu.backetName'));


    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
