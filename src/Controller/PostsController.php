<?php

namespace Controller;

class PostsController extends \Core\Controller {

	protected $models = ['Post', 'Category', 'Media', 'MediaToPost'];

	public function index() {

		$this->render('posts/index.php');
	}

	public function post($id) {
		$post = $this->Post->q()->where('id', $id)->fetch();
		$category = $this->Category->q()->where('id', $post['category_id'])->fetch();

		$mediasIds = $this->MediaToPost->q()->where('post_id', $post['id'])->fetchPairs('id', 'id');
		$medias = $this->Media->q()->where('id', $mediasIds)->fetchAll();


		$this->render('posts/post.php', [
			'post' => $post,
			'category' => $category,
			'medias' => $medias
		]);
	}
}