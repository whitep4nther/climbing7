<?php

namespace Controller;

use \Core\Controller;
use \Symfony\Component\DomCrawler\Crawler;
use \Cake\Utility\Inflector;

class MigratingController extends \Core\Controller {

	protected $models = ['Post', 'MediaFolder', 'Media', 'MediaToPost'];

	public function listUrls() {
		set_time_limit(0);
		$crawler = new \Symfony\Component\DomCrawler\Crawler();
		$crawler->addContent(file_get_contents(__DIR__ . '/hihi.html'));

		$urls = $crawler->filter('div.post h2 a')->extract('href');

		array_shift($urls);
		foreach ($urls as $url) {
			$this->importWordpressPage($url);
		}
		// debug($urls);
	}

	public function importWordpressPage($url) {
		$category = 'Canyoning';
		$categoryId = 3;

		$crawler = new \Symfony\Component\DomCrawler\Crawler();
		$crawler->addContent(file_get_contents($url));

		$title = $crawler->filter('#single .entry-title')->text();

		$post = [];

		$post['rate'] = substr_count(strstr($title, '✯'), '✯');
		$post['category_id'] = $categoryId;

		$post['title'] = $title;
		$post['approach'] = '';
		$stringDate = substr(preg_replace('/(.*)entrée a été publiée le (.*) par(.*)$/i', '$2', $crawler->filter('.meta .meta-information')->text()), 16);
		$stringDate = explode(' ', $stringDate);
		$months = ['', 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
		$stringDate[0] = str_pad($stringDate[0], 2, '0', STR_PAD_LEFT);
		$stringDate[1] = array_search($stringDate[1], $months);
		$post['date'] =  implode('-', array_reverse($stringDate));

		$ps = $crawler->filter('#single > p')->reduce(function($node, $i) {
			if (preg_match('/^<strong>(.*)topo(.*)<\/strong>$/i', $node->html())
				|| preg_match('/^<strong>(.*)galerie(.*)<\/strong>$/i', $node->html()))
				return false;
			return true;
		})->extract('_text');

		debug($ps);

		$post['presentation'] = array_shift($ps);
		$post['label'] = substr($post['presentation'], 0, 255);
		$post['access'] = array_shift($ps);
		$post['approach'] = array_shift($ps);

		$post['parcours'] = '';
		$txt = &$post['parcours'];
		foreach ($ps as $i => $p) {
			if (preg_match('/^(.*)(sortie|retour)(.*)(?s)(.*)$/i', $p)) {
				$post['back'] = '';
				$txt = &$post['back'];
			}
			$txt .= $p;
		}

		$imgs = $crawler->filter('.tiled-gallery img');

		$folder = $this->MediaFolder->q()->where('title', $stringDate[2])->fetch();
		$lastId = (!$folder) ? $this->MediaFolder->create(0, $stringDate[2])->execute() : $folder['id'];

		$folder = $this->MediaFolder->q()->where(['title' => $title, 'parent_id' => $lastId])->fetch();
		$lastId = (!$folder) ? $this->MediaFolder->create($lastId, $title)->execute() : $folder['id'];

		$ids = $this->Media->downloadFilesToFolder($imgs, $lastId);

		$postId = $this->Post->queryB()->insertInto($this->Post->table(), $post)->execute();

		foreach ($ids as $mediaId) {
			$this->MediaToPost->createRelationship($mediaId, $postId, 'gallery')->execute();
		}
	}

}