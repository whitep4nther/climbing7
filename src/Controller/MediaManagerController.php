<?php

namespace Controller;

class MediaManagerController extends \Core\Controller {


	public function manager() {
		$this->render('media_manager/manager.twig');
	}
}