<?php
/**
 * User: dengyun
 * Date: 2019/11/14 14:58
 */
namespace app\api\service;

use app\api\model\User as UserModel;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use think\facade\Config;

class UserToken extends Token
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
        } else {

            $loginFail = array_key_exists('errcode',$wxResult);
            if($loginFail){
                // 失败
                $this->processLoginError($wxResult);
            } else {
                // 成功
                return $this->grantToken($wxResult);
            }

        }

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
    private function grantToken($wxResult)
    {
        $openid = $wxResult['openid'];
        $user = UserModel::getOpenId($openid);
        if($user){
            $user_id = $user->id;
        } else {
            $user_id = $this->newUser($openid);
        }

        $cachedValue = $this->prepareCachedValue($wxResult,$user_id);
        $token = $this->saveToCache($cachedValue);
        return $token;
    }

    // 创建新用户
    private function newUser($openId)
    {
        $user = UserModel::create([
            'openid' => $openId
        ]);

        return $user->id;
    }

    // 准备缓存数据
    private function prepareCachedValue($wxResult,$user_id)
    {
        $cachedValue = $wxResult;
        $cachedValue['user_id'] = $user_id;
        $cachedValue['scope'] = 16;
        return $cachedValue;
    }

    // 写入缓存
    private function saveToCache($cachedValue)
    {
        $token = self::generateToken();
        $value = json_encode($cachedValue);
        $expire_in = Config::get('system.TOKEN_EXPIRE_IN');

        $request = cache($token,$value,$expire_in);
        if(!$request){
            throw new TokenException([
                'msg' => '无服务器缓存异常',
                'errorCode' => 10005
            ]);
        }

        return $token;

    }




}