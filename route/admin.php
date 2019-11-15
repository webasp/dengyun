<?php
    Route::post('admin/token$','api/Token/adminToken');
    Route::group('admin', function() {

        Route::post('token/verify','api/Token/verifyToken');
    })->middleware('authToken');