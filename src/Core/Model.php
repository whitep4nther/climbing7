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

	public function q($id = null) {
		if (!$id)
			return $this->queryB->from($this->table);
		return $this->queryB->from($this->table, $id);	
	}
}

?>