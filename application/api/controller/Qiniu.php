<?php
    namespace app\api\controller;


    //vendor('Qiniu.autoload');
    use Qiniu\Auth as Auth;
    use Qiniu\Storage\BucketManager;
    use Qiniu\Storage\UploadManager;
    use think\facade\Config;


    class Qiniu
    {
        public function get()
        {
            vendor('Qiniu.autoload');
            // 初始化签权对象
            $auth = new Auth(Config::get('qiniu.ACCESS_KEY'), Config::get('qiniu.SECRET_KEY'));
            $bucket = Config::get('qiniu.BUCKET_NAME');
            echo $bucket;
            die;

           // 生成上传Token
            $token = $auth->uploadToken($bucket);

            return [
                'token' => $token
            ];
        }
    }