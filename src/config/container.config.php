<?php

require_once 'constants.php';

return [
	'settings' => [
        'displayErrorDetails' => true,
    ],
	/**
	* Tools
	*/
	'rqModel' => function ($c) {
		return function ($modelName) use ($c) {
			$class = '\\Model\\'.$modelName;
			return new $class($c->fPDO);
		};
	},
	/**
	* Database 
	**/
	'PDO' => function ($c) {
		return new \PDO("mysql:dbname=climbing7;host=localhost;", "root", "123456");
	},
	'fPDO' => function ($c) {
		return new \FluentPDO($c['PDO']);
	},
	/**
	* Twig
	**/
	'view' => function ($c) {
	    $view = new \Slim\Views\Twig(VIEWS_DIR, [
	        // 'cache' => CACHE_DIR
	    ]);

	    // Instantiate and add Slim specific extension
	    $view->addExtension(new Slim\Views\TwigExtension(
	        $c['router'],
	        $c['request']->getUri()
	    ));

	    $view->addExtension(new \Climbing7HelpersExtension(
	    	$c['router'],
	    	$c['request']->getUri()
	    ));

	    $view->getEnvironment()->registerUndefinedFunctionCallback(function($name) {
		    if (function_exists($name)) {
		        return new Twig_SimpleFunction($name, function() use($name) {
		            return call_user_func_array($name, func_get_args());
		        });
		        return false;
		    }
		});

	    return $view;
	}
];