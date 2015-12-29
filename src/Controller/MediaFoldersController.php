<?php

use \Core\Controller;
use \Model\MediaFolder;

namespace Controller;

class MediaFoldersController extends \Core\Controller {

	protected $models = ['MediaFolder', 'Media'];

	public function rootDirectories() {
		$this->render('json.php', ['data' => $this->MediaFolder->rootDirectories()->fetchAll()]);
	}

	public function create($parentId) {
		
		$this->render('json.php', [
			'data' => $this->MediaFolder->create($parentId)->execute()	
		]);
	}

	public function contentOfFolder($folderId) {
		$folder = $this->MediaFolder->queryB()
			->from($this->MediaFolder->table, $folderId)->fetch();

		$medias = $this->Media->mediasForFolder($folderId)->fetchAll();
		$medias = array_map(function ($value) {
			$value['type'] = 'media';
			return $value;
		}, $medias);
		$subfolders = $this->MediaFolder->directoriesWithParent($folderId)->fetchAll();
		$subfolders = array_map(function ($value) {
			$value['type'] = 'folder';
			return $value;
		}, $subfolders);
		
		$this->render('json.php', ['data' => [
			'folder' => $folder,
			'content' => array_merge($medias, $subfolders)
		]]);
	}
}