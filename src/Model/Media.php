<?php

use \Core\Model;

namespace Model;

class Media extends \Core\Model {

	protected $table = 'medias';

	public function mediasForFolder($folderId) {
		return $this->queryB
			->from($this->table)
			->where('folder_id', $folderId);
	}

}