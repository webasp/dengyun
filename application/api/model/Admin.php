<?php
/**
 * User: dengyun
 * Date: 2019/11/15 15:53
 */

namespace app\api\model;


class Admin extends BasicModel
{

    // 验证管理员
    public static function check($data)
    {
        return self::where($data)->find();
    }

    // 获取文章列表
    public static function getArticle()
    {

    }




}