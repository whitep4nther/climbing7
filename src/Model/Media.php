<?php

use \Core\Model;

namespace Model;

class Media extends \Core\Model {

	protected $table = 'medias';

	public function mediasForPost($postId) {
		$MediaToPost = new \Model\MediaToPost($this->queryB);

		return $MediaToPost->q()->select(null)->select('medias_to_posts.id AS relationship_id')->where('post_id', $postId)->innerJoin('medias ON medias.id = medias_to_posts.media_id')->select('medias.*');
	}

	public function mediasForFolder($folderId) {
		return $this->queryB
			->from($this->table)
			->where('folder_id', $folderId);
	}

	public function uploadFilesToFolder($files, $folderId) {
		$MediaFolder = new \Model\MediaFolder($this->queryB);
		$folder = $MediaFolder->queryB->from($MediaFolder->table, $folderId)->fetch();

		foreach ($files['name'] as $i => $name) {
			$infos = pathinfo($name);
			$slug = \Cake\Utility\Inflector::slug($infos['filename']);

			if (move_uploaded_file($files['tmp_name'][$i], $MediaFolder->libraryPath . $folder['path'] .'/'.$slug.'.'.$infos['extension'])) {
				$this->queryB
					->insertInto($this->table, [
						'title' => $infos['filename'],
						'folder_id' => $folderId,
						'filename' => $slug. '.' .$infos['extension'],
						'full_path' => $folder['path'] .'/'.$slug.'.'.$infos['extension']
					])->execute();
			}
		}
	}

	public function downloadFilesToFolder($urls, $folderId) {
		$ids = [];

		foreach ($urls as $url) {
			if ($id = $this->downloadFileToFolder($url, $folderId)) {
				$ids[] = $id;
			}
		}
		return $ids;
	}

	public function downloadFileToFolder($url, $folderId) {
		$MediaFolder = new \Model\MediaFolder($this->queryB);
		$folder = $MediaFolder->queryB->from($MediaFolder->table, $folderId)->fetch();

		$infos = pathinfo(parse_url($url)['path']);
		$slug = \Cake\Utility\Inflector::slug($infos['filename']);
		if (file_put_contents($MediaFolder->libraryPath . $folder['path'] .'/'.$slug.'.'.$infos['extension'], file_get_contents($url))) {
		
			return $this->queryB
				->insertInto($this->table, [
					'title' => $infos['filename'],
					'folder_id' => $folderId,
					'filename' => $slug. '.' .$infos['extension'],
					'full_path' => $folder['path'] .'/'.$slug.'.'.$infos['extension']
				])->execute();
		}
	}

}