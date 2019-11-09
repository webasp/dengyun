<?php
/**
 * User: dengyun
 * Date: 2019/11/6 15:43
 */
namespace app\api\model;

use think\facade\Config;

class Photo extends BasicModel
{
    protected $hidden = ['album_id','update_at','status','cat_id'];

    // 关联照片列表
    public function item()
    {
        return $this->hasMany('PhotoItem', 'photo_id', 'id');
    }

    // 关联评论列表
    public function review()
    {
        return $this->hasMany('PhotoReview','photo_id','id');
    }

    // 关联喜欢列表
    public function like()
    {
        return $this->hasMany('PhotoLike','photo_id','id');
    }

    // 获取相册列表
    public static function getPhotoList($page=1)
    {
        return self::with([
            'item' => function ($query){
                $query->order('id', 'desc');
            },
            'review'=> function ($query){
                $query->with('user')->order('id', 'desc')->limit(3);
            },
            'like' => function ($query){
                $query->with('user')->order('id', 'desc')->limit(5);
            }
        ])->order('id desc')
        ->page($page,Config::get('photo.PAGE_ROWS'))->select();
    }






}