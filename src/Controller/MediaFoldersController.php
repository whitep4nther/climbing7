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
		$medias = $this->Media->mediasForFolder($folderId)->fetchAll();
		$subfolders = $this->MediaFolder->directoriesWithParent($folderId)->fetchAll();
		
		$this->render('json.php', ['data' => array_merge($medias, $subfolders)]);
	}
}