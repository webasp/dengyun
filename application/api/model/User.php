<?php
/**
 * User: dengyun
 * Date: 2019/11/6 15:43
 */
namespace app\api\model;

use think\facade\Config;

class User extends BasicModel
{
    protected $hidden = ['id','openid','create_at','update_at'];

    public function getAvatarAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }
}