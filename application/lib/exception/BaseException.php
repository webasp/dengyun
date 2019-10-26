<?php
namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception
{
    public $statusCode = 400;
    public $msg = '参数错误';
    public $code = 10000;

    public function __construct($params = [])
    {
        if(!is_array($params)){
            throw new Exception('参数必须是数组');
        }

        if(array_key_exists('statusCode',$params)){
            $this->statusCode = $params['statusCode'];
        }

        if(array_key_exists('code',$params)){
            $this->code = $params['code'];
        }

        if(array_key_exists('msg',$params)){
            $this->msg = $params['msg'];
        }

    }
}