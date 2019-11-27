<?php
/**
 * User: dengyun
 * Date: 2019/11/27 11:21
 */

namespace app\api\controller;


use app\facade\basic\Basic;
use think\facade\Request;

class Admin
{
    // 获取管理员信息
    public function getAdminInfo()
    {
        $user = Request::param('user');
        return Basic::back($user);

    }

}