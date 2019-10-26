<?php
namespace think;
define('APP_PATH', __DIR__ . '/application/');
require __DIR__ . '/thinkphp/base.php';
Container::get('app')->path(APP_PATH)->run()->send();
