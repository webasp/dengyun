<?php

    Route::group('api', function() {
        Route::get('photo','api/Photo/index');
        Route::post('token','api/Token/getToken');
    });