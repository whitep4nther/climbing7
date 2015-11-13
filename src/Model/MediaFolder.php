<?php

use \Core\Model;

namespace Model;

class MediaFolder extends \Core\Model {

	protected $table = 'media_folders';

	public function index() {

		return $this->queryB
			->from($this->table);
	}
}