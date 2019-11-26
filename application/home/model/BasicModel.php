<?php
/**
 * User: dengyun
 * Date: 2019/11/6 15:46
 */

namespace app\home\model;


use think\facade\Config;
use think\Model;

class BasicModel extends Model
{

    protected function  prefixImgUrl($value, $data){
        return Config::get('qiniu.FILE_URL').$value;
    }

}