<?php

use \Slim\Slim;

namespace Core;

class Controller {

	protected $c;
	protected $request;
	protected $response;

	protected $models = [];

	public function __construct($container, $request, $response) {
		$this->app = $container;
		$this->request = $request;
		$this->response = $response;

		foreach ($this->models as $model) {
			$this->{$model} = $this->app['rqModel']($model);
		}
	}

	public function render($template, $data = array()) {
		$this->app->view->render($this->app->response, $template, $data);
	}

	public function redirectResponse($routeName, $data = []) {
		return $this->response->withRedirect($this->app->router->pathFor($routeName, $data), 302);
	}

	public function jsonResponse($json) {
		$res = $this->response->withHeader('Content-Type', 'application/json');
		$res->write(json_encode($json));
		return $res;
	}

}