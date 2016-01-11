<?php

define('DS', DIRECTORY_SEPARATOR);

define('ROOT_DIR', realpath(__DIR__ . DS . '../..'));
define('SRC_DIR', ROOT_DIR . DS . 'src');
define('VENDOR_DIR', ROOT_DIR . DS . 'vendor');
define('CONFIG_DIR', __DIR__);
define('VIEWS_DIR', SRC_DIR . DS . 'views');
define('CACHE_DIR', SRC_DIR . DS . '.cache');