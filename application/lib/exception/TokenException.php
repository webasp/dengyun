<?php
namespace app\lib\exception;


class TokenException extends BaseException
{
    public $statusCode = 401;
    public $msg = 'Token无效或以过期';
    public $code = 10001;
}