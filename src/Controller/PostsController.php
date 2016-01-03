<?php

namespace Controller;

use \Cake\Utility\Inflector;
use \Cake\Utility\Hash;

class PostsController extends \Core\Controller {

	protected $models = ['Post', 'Category', 'Media', 'MediaToPost'];

	public function index() {
		$lastPosts = $this->Post->getPosts()->fetchAll();
		$categories = $this->Category->q()->where('id', Hash::extract($lastPosts, '{n}.category_id'))->fetchAll('id');

		$lastPosts = array_merge($lastPosts, $lastPosts, $lastPosts, $lastPosts, $lastPosts);

		$this->render('index.php', [
			'posts' => $lastPosts,
			'categories' => $categories
		]);
	}

	public function post($id, $country, $region, $site) {
		$post = $this->Post->q()->where('id', $id)->fetch();

		if (!$post 
			|| Inflector::slug($post['country'], '-') != $country
			|| Inflector::slug($post['region'], '-') != $region
			|| Inflector::slug($post['site'], '-') != $site)
			$this->app->notFound();

		$category = $this->Category->q()->where('id', $post['category_id'])->fetch();

		$mediasIds = $this->MediaToPost->q()->where('post_id', $post['id'])->fetchPairs('id', 'id');
		$medias = $this->Media->q()->where('id', $mediasIds)->fetchAll();


		$this->render('posts/post.php', [
			'post' => $post,
			'category' => $category,
			'medias' => $medias
		]);
	}

	/*** ADMIN ***/
	public function admin_post($id) {
		$post = $this->Post->q()->where('id', $id)->fetch();
		$categories = $this->Category->q()->fetchAll();
		$this->render('posts/admin_post.php', [
			'post' => $post,
			'categories' => $categories
		]);
	}

	public function admin_postEdited($id) {
		$this->Post->queryB()->update($this->Post->table())->set($this->app->request->post())->where('id', $id)->execute();

		$this->app->flash('success', 'Le post a bien été mis a jour');
		$this->app->response->redirect($this->app->urlFor('adminPost', ['id' => $id]), 200);
	}
}