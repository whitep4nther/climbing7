<?php

define('DS', DIRECTORY_SEPARATOR);

define('ROOT_DIR', realpath(__DIR__ . DS . '../..'));

define('CONFIG_DIR', __DIR__);
define('VENDOR_DIR', ROOT_DIR . DS . 'vendor');

define('SRC_DIR', ROOT_DIR . DS . 'src');
	define('PUBLIC_DIR', SRC_DIR . DS . 'public');
		define('IMG_DIR', PUBLIC_DIR . DS . 'img');
			define('IMG_CACHE_DIR', IMG_DIR . DS . '.cache');
		define('LIBRARY_DIR', PUBLIC_DIR . DS . 'library');
	

	define('VIEWS_DIR', SRC_DIR . DS . 'views');
	define('CACHE_DIR', SRC_DIR . DS . 'views' . DS . '.cache');