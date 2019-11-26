<?php
namespace app\api\controller;

use app\api\service\AdminToken;
use app\api\service\UserToken;
use app\api\service\Token as TokenService;
use app\lib\exception\ParameterException;
use app\lib\validate\AdminTokenGet;
use app\lib\validate\GetToken;


class Token
{
    public function getToken($code)
    {
        /**
         * 用户获取令牌（登陆）
         * @url /token
         * @POST code
         */
        (new GetToken())->goCheck();
        $ut = new UserToken($code);
        $token = $ut->get();
        return [
            'token' => $token
        ];
    }


    /**
     * 管理员登录
     * @url /appToken
     * @POST
     */
    public function appToken()
    {
        $result = new AdminTokenGet();
        $result->goCheck();
        $data = $result->getDataByRule();

        $app = new AdminToken();
        $token = $app->get($data);
        return [
            'token' => $token
        ];
    }

    /**
     * 验证 Token
     * @url
     * @POST
     */
    public function verifyToken($token='')
    {
        if(!$token){
            throw new ParameterException([
                'token不允许为空'
            ]);
        }

        $valid = TokenService::verifyToken($token);
        return [
            'isValid' => $valid
        ];
    }

}