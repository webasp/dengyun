<?php
/**
 * User: dengyun
 * Date: 2019/11/14 14:58
 */
namespace app\api\service;

use app\lib\exception\WeChatException;
use think\Exception;
use think\facade\Config;

class UserToken
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = Config::get('wx.APP_ID');
        $this->wxAppSecret = Config::get('wx.APP_SECRET');
        $this->wxLoginUrl = sprintf(
            Config::get('wx.LOGIN_URL'), $this->wxAppID, $this->wxAppSecret, $this->code);

    }

    // 获取 微信opID
    public function get()
    {
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result,true);

        if(empty($wxResult)){
            throw new Exception('获取 openID 出错');
        }

        $loginFail = array_key_exists('errcode',$wxResult);
        if(!$loginFail){
            $this->processLoginError();
        }

        // 调用成功
        $this->grantToken();

    }

    // 错误异常
    private function processLoginError($wxResult)
    {
        throw new WeChatException([
            'msg' => $wxResult['errmsg'],
            'errorCode' => $wxResult['errcode']
        ]);
    }

    // 微信调用成功方法
    private function grantToken()
    {

    }

}