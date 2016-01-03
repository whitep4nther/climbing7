<?php

use \Core\Model;

namespace Model;

class Post extends \Core\Model {

	protected $table = 'posts';

	public function getPosts($start = 0, $limit = 8) {
		return $this->q()
			->offset($start)
			->limit($limit);
	}

}