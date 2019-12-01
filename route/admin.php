<?php

    Route::group('admin', function() {
        Route::get('/$','admin/Index/index');
        Route::get('main$','admin/Index/main');
        Route::get('login$','admin/Login/index');
        Route::get('article$','admin/Article/index');
    });
