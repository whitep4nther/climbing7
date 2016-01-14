<?php

use \Core\Controller;

namespace Controller;

class MediasToPostsController extends \Core\Controller {

	protected $models = ['MediaToPost'];

	public function admin_attachMediasToPost($postId) {
		$data = $this->request->getParsedBody();

		foreach ($data['medias'] as $media) {
			$this->MediaToPost->createRelationship($media, $postId, $data['identifier'])->execute();
		}
	}

	public function admin_detachMediaFromPost($postId) {
		$data = $this->request->getParsedBody();

		$this->MediaToPost->destroyRelationship($data['relationshipId'])->execute();
	}
}