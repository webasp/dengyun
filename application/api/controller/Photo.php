<?php
    namespace app\api\controller;

    use app\api\model\Photo as ModelPhoto;

    class Photo
    {
        public function index()
        {

            return ModelPhoto::getPhotoList();


        }
    }