<?php
/**
 * User: dengyun
 * Date: 2019/11/15 15:53
 */

namespace app\api\model;


class Admin extends BasicModel
{
    public static function check($data)
    {
        return self::where($data)->find();
    }
}