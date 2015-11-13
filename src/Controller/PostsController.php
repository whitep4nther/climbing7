<?php

namespace Controller;

class PostsController extends \Core\Controller {

	public function index() {

		$this->render('posts/index.php');
	}
}