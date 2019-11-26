<?php
/**
 * User: dengyun
 * Date: 2019/11/6 15:43
 */
namespace app\api\model;

use think\facade\Config;
use think\facade\Request;

class Photo extends BasicModel
{
    protected $hidden = ['album_id','update_at','status','cat_id'];
    protected $user_id = null;

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
    public function likeList()
    {
        return $this->hasMany('PhotoLike','photo_id','id');
    }

    // 关联喜欢列表
    public function like()
    {
        return $this->hasOne('photoLike');
    }

    // 关联标签列表
    public function tags ()
    {
        return $this->belongsToMany('PhotoTags', 'PhotoTagsMap', 'photo_id', 'tag_id');
    }

    // 获取相册列表
    public static function getPhotoList($page = 1)
    {
        return self::with([
            'item' => function ($query){
                $query->order('id', 'desc');
            },
            'review'=> function ($query){
                $query->with('user')->order('id', 'desc')->limit(3);
            },
            'likeList' => function ($query){
                $query->with('user')->order('id', 'desc')->limit(5);
            },
            'like' => function ($query) {
                $query->where('user_id','2');
            },
            'tags' => function ($query) {
                $query->field('id,name')->order('click', 'desc');
            }
        ])
            ->where('status','1')
            ->order('id desc')
            ->paginate(
                   Config::get('photo.PAGE_ROWS'),
                   false,
                   ['page' => $page]
                 );
    }

}