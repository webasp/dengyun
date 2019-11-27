<?php
    namespace app\admin\controller;

    class Index extends BasicAdmin
    {
        // 后台框架
        public function index()
        {
            return $this->fetch();
        }

        // 后台主页
        public function main()
        {
            return $this->fetch();
        }

    }