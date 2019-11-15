<?php
namespace app\lib\exception;


class LoginException extends BaseException
{
    public $statusCode = 400;
    public $msg = '请登录';
    public $code = 999;
}