<?php
namespace app\lib\validate;

use app\lib\exception\ParameterException;
use think\facade\Request;
use think\Validate;

class BaseValidate extends Validate
{
    /* 开始验证 */
    public function goCheck()
    {
        if(!$this->batch()->check(Request::param())){
            throw new ParameterException([
                'msg' => $this->error
            ]);
        } else {
            return true;
        }

    }

    /* 必须是正整数 */
    protected function isPositiveInteger($value, $rule='', $data='', $field='')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /* 字符串不能为空 */
    protected function isNotEmpty($value, $rule='', $data='', $field='')
    {
        if (empty($value)) {
            return false;
        } else {
            return true;
        }
    }

    /* 手机号的验证规则 */
    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }



    public function getDataByRule()
    {
        $data = Request::param();
        if (array_key_exists('user_id', $data)) {
            throw new ParameterException([
                'msg' => '参数中包含有非法的参数名'
            ]);
        }
        $newArray = [];
        foreach ($this->rule as $key => $value) {
            $newArray[$key] = $data[$key];
        }

        return $newArray;
    }
}