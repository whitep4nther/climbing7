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

		$this->render('posts/admin_post.twig', [
			'post' => $post,
			'categories' => $categories
		]);
	}

	public function admin_postEdited($id) {
		$this->Post->queryB()->update($this->Post->table())->set($this->app->request->getParsedBody())->where('id', $id)->execute();

		return $this->redirectResponse('admin_post', ['id' => $id]);
	}
}