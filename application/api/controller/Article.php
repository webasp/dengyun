<?php
/**
 * User: dengyun
 * Date: 2019/11/27 11:21
 */

namespace app\api\controller;


use app\api\model\Article as ArtModel;
use app\facade\basic\Basic;
use think\facade\Request;

class Article
{
    // 获取管理员信息
    public function getAdminInfo()
    {
        $user = Request::param('user');
        return Basic::back($user);
    }

    // 获取文章列表
    public function getArticle()
    {
        $data = ArtModel::getAllArt();

        return Basic::backTableData($data['data'],$data['total']);
    }

}