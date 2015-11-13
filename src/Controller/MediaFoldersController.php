<?php

use \Core\Controller;
use \Model\MediaFolder;

namespace Controller;

class MediaFoldersController extends \Core\Controller {

	public function index() {
		$this->render('json.php', ['data' => $this->app->rqModel('MediaFolder')->index()->fetchAll()]);
	}
}