<?php

namespace app\common\basic;


use think\Container;
class  Basic {
    // 返回正常数据
    public function back($data=[],$code=1, $msg='success') {
        return Container::get('response')->create(['status'=>$code,'msg'=>$msg, 'data'=>$data],'json');
    }

    // 返回表格数据
    public function backTableData($data,$count,$code = 0,$msg = 'success'){
        return Container::get('response')->create(['code'=>$code,'count'=>$count,'msg'=>$msg, 'data'=>$data],'json');
    }
}