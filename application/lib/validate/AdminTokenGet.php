<?php
namespace app\lib\validate;

class AdminTokenGet extends BaseValidate
{
    protected $rule = [
        'username' => 'require|isNotEmpty',
        'password' => 'require|isNotEmpty'
    ];
    protected $message = [
        'username' => '用户名不能为空',
        'password' => '密码不能为空'
    ];
}