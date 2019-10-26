<?php
namespace app\lib\validate;

class IDMustBePostiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
        'name' => 'require|isPositiveInteger'
    ];
    protected $message = [
        'id.require' => 'ID 不能为空',
        'id.isPositiveInteger' => 'ID 必须是正整数',
        'name.isPositiveInteger' => ' 名字不能为空 '
    ];
}