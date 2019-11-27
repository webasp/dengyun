<?php
/**
 * User: dengyun
 * Date: 2019/11/15 15:44
 */

namespace app\api\service;


use app\api\model\Admin;
use app\lib\exception\TokenException;
use think\facade\Config;

class AdminToken extends Token
{
    public function get($data)
    {
        $data['password'] = md5($data['password']);
        $admin = Admin::check($data);
        if(!$admin){
            throw new TokenException([
                'msg' => '授权失败',
                'errorCode' => 10004
            ]);
        } else {
            // 保存到缓存
            $token = $this->saveToCache($admin);
            return $token;
        }
    }

    private function saveToCache($values){
        $token = self::generateToken();
        $value = json_encode($values);

        $expire_in = Config::get('system.TOKEN_EXPIRE_IN');
        $request = cache($token,$value,$expire_in);
        if(!$request){
            throw new TokenException([
                'msg' => '无服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $token;
    }
}