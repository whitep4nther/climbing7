<?php

use \Core\Model;

namespace Model;

class MediaToPost extends \Core\Model {


	protected $table = 'medias_to_posts';

	public function createRelationship($mediaId, $postId, $identifier) {
		return $this->queryB->insertInto($this->table, [
			'media_id' => $mediaId,
			'post_id' => $postId,
			'identifier' => $identifier
		]);
	}
}