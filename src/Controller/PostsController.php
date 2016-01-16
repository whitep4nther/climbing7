<?php

namespace Controller;

use \Cake\Utility\Inflector;
use \Cake\Utility\Hash;

class PostsController extends \Core\Controller {

	protected $models = ['Post', 'Category', 'Media', 'MediaToPost'];

	public function index() {
		$posts = $this->Post->getPosts()->fetchAll();
		$categories = $this->Category->q()->where('id', Hash::extract($posts, '{n}.category_id'))->fetchAll('id');
		$posts = array_merge($posts, $posts, $posts, $posts, $posts);

		$this->render('home.twig', [
			'featuredPosts' => array_splice($posts, 0, 2),
			'posts' => $posts,
			'categories' => $categories
		]);
	}

	public function post($id, $title) {
		$post = $this->Post->q()->where('id', $id)->fetch();

		if (!$post 
			|| Inflector::slug($post['title'], '-') != $title)
			return $this->app['notFoundHandler']($this->request, $this->response);

		$category = $this->Category->q()->where('id', $post['category_id'])->fetch();

		$mediasIds = $this->MediaToPost->q()->where('post_id', $post['id'])->fetchPairs('id', 'media_id');
		$medias = $this->Media->q()->where('id', $mediasIds)->fetchAll();

		$this->render('posts/post.twig', [
			'post' => $post,
			'category' => $category,
			'medias' => $medias
		]);
	}

	/*** 
	* ADMIN 
	***/
	public function admin_post($id) {
		$post = $this->Post->q()->where('id', $id)->fetch();
		$categories = $this->Category->q()->fetchAll();

		$cover = $this->Media->q($post['cover_id'])->fetch();
		$gallery = $this->Media->mediasForPost($id)->fetchAll();

		$this->render('posts/admin_post.twig', [
			'post' => $post,
			'cover' => $cover,
			'gallery' => $gallery,
			'categories' => $categories
		]);
	}

	public function admin_postEdited($id) {
		$data = $this->request->getParsedBody();
		unset($data['action']);
		$this->Post->queryB()->update($this->Post->table(), $data, $id)->execute();

		return $this->redirectResponse('admin_post', ['id' => $id]);
	}

	public function admin_postChangeFields($id) {
		$this->Post->queryB()->update($this->Post->table(), $this->request->getParsedBody(), $id)->execute();
	}
}