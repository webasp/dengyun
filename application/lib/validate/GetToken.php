<?php
namespace app\lib\validate;

class GetToken extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];
    protected $message = [
        'code' => 'Token 不能为空'
    ];
}