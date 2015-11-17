<?php

use \Core\Model;

namespace Model;

class MediaFolder extends \Core\Model {

	public $table = 'media_folders';

	public function rootDirectories() {
		return $this->directoriesWithParent(NULL);
	}

	public function directoriesWithParent($parent) {
		return $this->queryB
			->from($this->table)
			->where('parent_id', $parent);
	}

	public function index() {

		return $this->queryB
			->from($this->table);
	}

	public function create($parentId) {
		if ($parentId == 0)
			$parentId = NULL;
		return $this->queryB
			->insertInto($this->table, ['parent_id' => $parentId]);
	}
}