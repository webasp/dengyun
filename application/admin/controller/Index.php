<?php
    namespace app\admin\controller;

    class Index extends BasicAdmin
    {
        public function index()
        {
            return $this->fetch();
        }
    }