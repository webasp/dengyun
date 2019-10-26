<?php
namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $statusCode = 400;
    public $msg = '参数错误';
    public $code = 10000;
}