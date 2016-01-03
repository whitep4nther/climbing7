<?php

require_once 'src/config/constants.php';
require CONFIG_DIR . DS . 'bootstrap.php';

$app = new \Core\Slimmy([
	'view' => new \Core\CustomView(),
	'templates.path' => './src/views'
]);
$app->add(new \Slim\Middleware\SessionCookie(array(
    'expires' => '300 minutes'
)));

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

$app->post('/library/upload-to/:id', function ($id) use ($app) 	{
	$ctrl = new \Controller\MediasController($app);
	$ctrl->uploadTo($id);
});

$app->get('/migrate', function () use ($app) 	{
	$ctrl = new \Controller\MigratingController($app);
	$ctrl->importWordpressPage();
});


$app->get('/post/:id/:country/:region/:site', function ($id, $country, $region, $site) use ($app) {
	$ctrl = new \Controller\PostsController($app);
	$ctrl->post($id, $country, $region, $site);
})->name('postRoute');

/** ADMIN ***/
$app->group('/admin', function () use ($app) {

	$app->get('/post/:id', function ($id) use ($app) {
		$ctrl = new \Controller\PostsController($app);
		$ctrl->admin_post($id);
	})->name('adminPost');

	$app->post('/post/:id', function ($id) use ($app) {
		$ctrl = new \Controller\PostsController($app);
		$ctrl->admin_postEdited($id);
	})->name('postEdited');
});

$app->run();