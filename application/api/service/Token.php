<?php
/**
 * User: dengyun
 * Date: 2019/11/15 9:30
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use think\facade\Cache;
use think\facade\Request;

class Token
{

   // 生成Token 随机字符串
    public static function generateToken()
    {
        return getRandChar(32);
    }

    // 根据 Token 找到用户ID
    public static function getCurrentUserId()
    {
        $user_id = self::getCurrentTokenVar('user_id');
        return $user_id;
    }

    // 根据 Token 找到缓存信息
    public static function getCurrentTokenVar($key)
    {
        $token = Request::instance()->header('token');
        $vars = Cache::get($token);
        if(!$vars){
            throw new TokenException();
        } else {
            if(!is_array($vars)){
                $vars = json_decode($vars,true);
            }

            if(array_key_exists($key,$vars)){
                return $vars[$key];
            } else {
                throw new \Exception([
                    '获取Token 变量不存在'
                ]);
            }
        }
    }

    // 根据Token 获取缓存
    public static function verifyToken($token)
    {
        $exist = Cache::get($token);
        if($exist){
            return true;
        }
        else{
            return false;
        }
    }

}