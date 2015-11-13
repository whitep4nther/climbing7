<?php

namespace Core;

class Slimmy extends \Slim\Slim {
	
	public function rqModel($modelName) {
		$class = '\\Model\\'.$modelName;
		return new $class($this->fPDO); 
	}
}