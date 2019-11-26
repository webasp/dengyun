<?php
    /**
     * Created by PhpStorm.
     * User: dengyun
     * Date: 2019/11/16
     * Time: 22:12
     */

    namespace app\home\model;

    use think\facade\Config;

    class Article extends BasicModel
    {
        protected $hidden = ['update_at','selected','content','status'];


        // 给图片加前缀域名
        public function getThumbAttr($value, $data)
        {
            return $this->prefixImgUrl($value, $data);
        }

        // 关联类别
        public function cat ()
        {
            return $this->hasOne('ArticleCat','id','cat_id');
        }
        // 获取精选文章
        public static function getSelectedArt()
        {
            return self::with(['cat'])
                ->where('status','1')
                ->where('selected','1')
                ->order('create_at desc')
                ->paginate(Config::get('web.home_page'));
        }

        // 最新4条文章
        public static function newArt()
        {
            return self::field('id,title,create_at')->where('status','1')
                ->where('selected','1')
                ->order('create_at desc')
                ->limit('4')
                ->select();
        }
    }