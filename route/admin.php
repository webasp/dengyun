<?php

    Route::group('admin', function() {
        Route::post('token$','api/Token/adminToken');
        Route::post('token/verify','api/Token/verifyToken');
    });