<?php

require_once 'src/config/constants.php';
require CONFIG_DIR . DS . 'bootstrap.php';

$app = new \Core\Slimmy([
	'templates.path' => './src/views'
]);

/**
 * Application Dependencies
 */
$app->container->singleton('PDO', function () {
	return new \PDO("mysql:dbname=climbing7;host=localhost;", "root", "");
});
$app->container->singleton('fPDO', function () use ($app) {
	return new \FluentPDO($app->PDO);
});

/**
 * Application Helpers
 */
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
$app->get('/', function () use ($app) 	{
	$ctrl = new \Controller\PostsController($app);
	$ctrl->index();
});

$app->get('/library', function () use ($app) 	{
	$ctrl = new \Controller\MediaManagerController($app);
	$ctrl->manager();
});

$app->get('/library/folders', function () use ($app) 	{
	$ctrl = new \Controller\MediaFoldersController($app);
	$ctrl->rootDirectories();
});

$app->get('/library/folder/:id', function ($id) use ($app) 	{
	$ctrl = new \Controller\MediaFoldersController($app);
	$ctrl->contentOfFolder($id);
});

$app->get('/library/create-folder/:id', function ($id) use ($app) 	{
	$ctrl = new \Controller\MediaFoldersController($app);
	$ctrl->create($id);
});

$app->run();