<?php
    Route::group('api', function() {
        Route::get('photo$','api/Photo/index');
        Route::post('token$','api/Token/getToken');
        Route::post('token/app','api/Token/appToken');
    });