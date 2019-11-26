<?php
    namespace app\admin\controller;

    use think\Controller;

    class Login extends Controller
    {
        public function index()
        {
            $this->assign('name', 'thinkphp');
            return $this->fetch();
        }
    }