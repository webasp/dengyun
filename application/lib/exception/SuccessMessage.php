<?php
namespace app\lib\exception;


class SuccessMessage extends BaseException
{
    public $statusCode = 201;
    public $msg = 'ok';
    public $code = 0;
}