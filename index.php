<?php

require_once 'src/config/bootstrap.php';

$container = new \Slim\Container(include CONFIG_DIR . DS . 'container.config.php');
$app = new \Slim\App($container);
// debug($_SERVER);

/**
 * Application Helpers
 */
function library($path) {
	return asset('library'.$path);
}

function asset($asset) {
	global $app;
	return $app->request()->getRootUri() . '/src/public/' . $asset;
}

function js($asset) {
	if (!is_array($asset))
		$asset = [$asset];
	$str = '';
	foreach ($asset as $a) {
		$str .= '<script type="text/javascript" src="'.asset('js/'.$a).'"></script>';
	}
	return $str;
}

function jsx($asset) {
	if (!is_array($asset))
		$asset = [$asset];
	$str = '';
	foreach ($asset as $a) {
		$str .= '<script type="text/babel" src="'.asset('jsx/'.$a).'"></script>';
	}
	return $str;
}

function css($asset) {
	if (!is_array($asset))
		$asset = [$asset];
	$str = '';
	foreach ($asset as $a) {
		$str .= '<link rel="stylesheet" type="text/css" href="'.asset('css/'.$a).'"/>';
	}
	return $str;
}

/**
 * Application Routing
 */
function CallControllerMethod($controller, $method) {
	$controller = '\\Controller\\'.$controller;

	return function ($request, $response, $args) use ($controller, $method) {
		$ctrl = new $controller($this, $request, $response);
		$return = call_user_func_array([$ctrl, $method], $args);
		if ($return)
			return $return;
	};
}


$app->get('/', CallControllerMethod('PostsController', 'index'));

$app->get('/post/{id:\d+}/{title}', CallControllerMethod('PostsController', 'post'))->setName('post');

$app->get('/migrate', function ($request, $response, $args) {
	$ctrl = new \Controller\MigratingController($this);
	$ctrl->importWordpressPage();
});

/** ADMIN ***/
$app->group('/admin', function () {

	$this->get('/post/{id:\d+}', CallControllerMethod('PostsController', 'admin_post'))->setName('admin_post');
	$this->post('/post/{id:\d+}', CallControllerMethod('PostsController', 'admin_postEdited'))->setName('admin_postEdited');

	$this->post('/post/change/{id:\d+}', CallControllerMethod('PostsController', 'admin_postChangeFields'))->setName('admin_postChangeField');
});

/** LIBRARY ***/
$app->group('/library', function () {

	$this->get('', CallControllerMethod('MediaManagerController', 'manager'));

	$this->get('/folders', CallControllerMethod('MediaFoldersController', 'getRootDirectories'));

	$this->get('/folder/{id:\d+}', CallControllerMethod('MediaFoldersController', 'getContentOfFolder'));

	$this->get('/create/{id:\d+}', CallControllerMethod('MediaFoldersController', 'create'));

	$this->post('/upload-to/{id:\d+}', CallControllerMethod('MediasController', 'uploadTo'));
});



$app->run();