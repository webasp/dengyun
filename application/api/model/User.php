<?php
/**
 * User: dengyun
 * Date: 2019/11/6 15:43
 */
namespace app\api\model;


class User extends BasicModel
{
    protected $hidden = ['id','openid','create_at','update_at'];

    // 设置头像图片地址
    public function getAvatarAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }



}