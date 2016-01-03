<?php

use \Core\Model;

namespace Model;

class MediaFolder extends \Core\Model {

	public static $libraryWebPath = '/library';
	public $libraryPath;

	public $table = 'media_folders';

	public $defaultFolderName = 'Nouveau dossier';


	public function __construct($qb) {
		parent::__construct($qb);
		$this->libraryPath = realpath(dirname(__FILE__) . DS . '..' . DS . 'public' . DS . 'library');
	}

	/**
	 * QUERIES all folder at top-level
	 */
	public function rootDirectories() {
		return $this->directoriesWithParent([0, NULL]);
	}

	/**
	 * QUERIES all folder inside specified folder
	 */
	public function directoriesWithParent($parent) {
		return $this->queryB
			->from($this->table)
			->where('parent_id', $parent);
	}

	/**
	 * QUERIES everithing
	 */
	public function index() {

		return $this->queryB
			->from($this->table);
	}

	/**
	 * CREATE a folder with specified parent_id and default folder name
	 */
	public function create($parentId, $name = null) {
		$name = $name ? $name : $this->defaultFolderName;
		$path = $real = '';
		if ($parentId != 0) {
			$parentPath = $this->queryB->from($this->table, $parentId)->fetch('path');
			$path .= $parentPath;
			$real .= $parentPath;
		}

		$uniqueName = $this->_mkdirFolderWithRetries($this->libraryPath . $path, $name);
		$slug = \Cake\Utility\Inflector::slug($uniqueName);

		return $this->queryB
			->insertInto($this->table, [
				'title' => $uniqueName,
				'slug' => $slug,
				'path' => $path . '/' . $slug,
				'parent_id' => $parentId
			]);
	}

	/**
	 * Creates associated folder and retries until no duplicate found - adding a suffix (in the form ' {number}')
	 *
	 *	@return created name
	 */
	protected function _mkdirFolderWithRetries($path, $name) {
		$slug = \Cake\Utility\Inflector::slug($name);

		if ($this->_mkdirCatch($path . '/' . $slug) == false) {
			$number = 2;
			while (1) {
				$newName = $name . ' ' . $number;
				$newSlug = \Cake\Utility\Inflector::slug($newName);
				if ($this->_mkdirCatch($path . '/' . $newSlug) == true)
					break ;
				else
					$number++;
			}

			$name = $newName;
		}
		return $name;
	}

	/**
	 * Helper function to try/catch the mkdir function
	 */
	protected function _mkdirCatch($path) {
		try {
			mkdir($path);
		} catch (\Exception $e) {
			return false;
		}
		return true;
	}
}