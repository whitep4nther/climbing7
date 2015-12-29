<?php

namespace Helper;

class PostHelper {

	static public function title($post) {

		if ($post['title'] != '')
			return $post['title'];

		return $post['site'].', '.$post['region'].', '.$post['country'];
	}

	static public function rateToStars($rate) {

		$string = '';

		for ($i = 0; $i < 5; $i++) {
			if ($i < $rate)
				$string .= '★';
			else
				$string .= '☆';
		}
		return $string;
	}
}