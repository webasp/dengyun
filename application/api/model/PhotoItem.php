<?php
/**
 * User: dengyun
 * Date: 2019/11/6 15:43
 */
namespace app\api\model;


class PhotoItem extends BasicModel
{
    protected $hidden = ['photo_id'];


    // 给图片加前缀域名
    public function getUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

}