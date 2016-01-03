<?php

namespace Helper;

use \Cake\Utility\Inflector;

class PostHelper {

	static public function title($post) {

		if ($post['title'] != '')
			return $post['title'];

		return $post['site'].', '.$post['region'].', '.$post['country'];
	}

	static public function rateToStars($rate, $fullStar = '★', $emptyStar = '☆') {

		$string = '';

		for ($i = 0; $i < 5; $i++) {
			if ($i < $rate)
				$string .= $fullStar;
			else
				$string .= $emptyStar;
		}
		return $string;
	}

	static public function urlForPost($post) {
		return \Slim\Slim::getInstance()->urlFor('postRoute', [
			'id' => $post['id'],
			'country' => Inflector::slug($post['country'], '-'),
			'region' => Inflector::slug($post['region'], '-'),
			'site' => Inflector::slug($post['site'], '-')
		]);
	}
}