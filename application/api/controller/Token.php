<?php
namespace app\api\controller;

use app\api\service\UserToken;
use app\lib\validate\GetToken;

class Token
{
    public function getToken($code)
    {


        (new GetToken())->goCheck();

        $ut = new UserToken($code);
        return $ut->get();

    }
}