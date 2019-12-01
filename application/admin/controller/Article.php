<?php
    /**
     * Created by PhpStorm.
     * User: dengyun
     * Date: 2019/11/30
     * Time: 18:23
     */

    namespace app\admin\controller;


    class Article extends BasicAdmin
    {
        // 文章列表页
        public function index()
        {
            return $this->fetch();
        }
    }