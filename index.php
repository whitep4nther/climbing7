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
	return new \PDO("mysql:dbname=climbing7;host=localhost;", "root", "123456");
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
	return '<script type="text/javascript" src="'.asset('js/'.$asset).'"></script>';
}

function css($asset) {
	return '<link rel="stylesheet" type="text/css" href="'.asset('css/'.$asset).'"/>';
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
	$ctrl->index();
});

$app->run();