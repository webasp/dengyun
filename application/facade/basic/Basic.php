<?php
namespace app\facade\basic;
use think\facade;
/**
 * @see \app\common\basic\Basic  //点击这里可以看到具体方法
 * @method back($msg='',$code=0,$data=[],$type='json') static
 */

class Basic extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\common\basic\Basic';
    }
}



