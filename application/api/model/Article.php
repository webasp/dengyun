<?php
/**
 * User: dengyun
 * Date: 2019/11/6 15:43
 */
namespace app\api\model;

class Article extends BasicModel
{
    protected $hidden = ['cat_id'];

    // 设置缩略图地址
    public function getThumbAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    // 关联标签列表
    public function tags ()
    {
        return $this->belongsToMany('ArticleTags', 'ArticleTagsMap', 'article_id', 'tag_id');
    }


    // 关联分类表
    public function cat()
    {
        return $this->hasOne('ArticleCat','id','cat_id');
    }

    // 获取所有文章列表
    public static function getAllArt()
    {
        return self::with(['cat','tags'])
            ->order('id desc')
            ->paginate(10)->toArray();
    }





}