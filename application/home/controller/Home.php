<?php
    namespace app\home\controller;


    use app\home\model\Article;
    use think\facade\Cache;

    class Home extends BaseController
    {
        public function index()
        {
            $article = Article::getSelectedArt();
            $this->assign('empty','<div class="empty"> Empty </div>');
            $this->assign('article', $article);
            return $this->fetch();
        }
    }