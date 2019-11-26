<?php
    namespace app\home\controller;

    use app\home\model\Article;
    use think\App;
    use think\Controller;
    use think\facade\Cache;
    use think\facade\Config;

    class BaseController extends Controller
    {
        function __construct(App $app = null)
        {
            parent::__construct($app);
            // 公共内容
            $this->assign('links',Config::get('web.links'));
            $this->assign('empty','<li><a>Empty..</a></li>');


            $newArt = Cache::get('newArt');
            if(empty($newArt)){
                $art = Article::newArt();
                $newArt = Cache::set('newArt',$art->toArray(),7200);
            }

            $newComments = Cache::get('newComments');
            if(empty($newComments)){
                $comments = Article::newArt();
                $newComments = Cache::set('newComments',$comments->toArray(),7200);
            }

            $this->assign('newArt',$newArt);
            $this->assign('newComments',$newComments);

        }
    }