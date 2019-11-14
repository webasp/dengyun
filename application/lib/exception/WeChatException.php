<?php
namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $statusCode = 400;
    public $msg = '微信服务接口调用失败';
    public $code = 999;
}