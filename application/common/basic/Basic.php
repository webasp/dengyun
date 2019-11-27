<?php

namespace app\common\basic;


use think\Container;
use think\facade\Cache;
//基类，封装一些常用的


class  Basic {


    //返回数据
    /**
     * @param string $msg
     * @param int $code  1 成功，2错误提示信息，0 异常信息
     * @param array $data
     * @param array $ext
     * @return array
     */
    public function back($data=[],$code=1, $msg='success',$type='json') {
        $r = ['status'=>$code,'msg'=>$msg, 'data'=>$data];
        switch ($type) {
            case 'json':
                $r = Container::get('response')->create($r, 'json');
                break;
        }
        return $r;
    }
}