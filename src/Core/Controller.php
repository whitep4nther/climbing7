<?php

use \Slim\Slim;

namespace Core;

class Controller {

	protected $app;

	public function __construct($app) {
		$this->app = $app;
	}

	public function render($template, $data = array(), $layout = false) {
		$view = $this->app->view->fetch($template, $data);

		if (!$layout)
			$layout = 'default';

		$this->app->render($layout . '.php', ['content_for_layout' => $view]);
	}

}