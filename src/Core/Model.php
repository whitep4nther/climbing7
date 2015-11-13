<?php

namespace Core;

class Model {

	protected $table;
	protected $queryB;

	public function __construct($queryBuilder) {
		$this->queryB = $queryBuilder;
	}
}

?>