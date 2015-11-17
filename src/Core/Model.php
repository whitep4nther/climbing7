<?php

namespace Core;

class Model {

	protected $table;
	protected $queryB;

	public function __construct($queryBuilder) {
		$this->queryB = $queryBuilder;
	}

	public function table() {
		return $this->table;
	}

	public function queryB() {
		return $this->queryB;
	}
}

?>