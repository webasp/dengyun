<?php
/**
 * User: dengyun
 * Date: 2019/11/6 15:43
 */
namespace app\api\model;


class PhotoReview extends BasicModel
{
    protected $hidden = ['user_id','parent_id','photo_id','update_at'];
    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }
}