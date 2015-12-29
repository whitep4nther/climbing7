<?php

use \Core\Controller;
use \Symfony\Component\DomCrawler\Crawler;

namespace Controller;

class MigratingController extends \Core\Controller {

	protected $models = ['Post', 'MediaFolder', 'Media', 'MediaToPost'];

	public function importWordpressPage() {
		$category = 'Canyoning';
		$categoryId = 3;

		$crawler = new \Symfony\Component\DomCrawler\Crawler();
		$crawler->addContent(file_get_contents(__DIR__ . '/hihi.html'));

		$title = explode(',', $crawler->filter('#single .entry-title')->text());

		$post = [];

		$post['site'] = trim($title[0]);
		$post['region'] = trim($title[1]);
		$post['country'] = trim(substr($title[2], 0, strpos($title[2], '✯')));
		$post['rate'] = substr_count(strstr($title[2], '✯'), '✯');
		$post['category_id'] = $categoryId;

		$post['title'] = '';
		$post['approach'] = '';
		$stringDate = substr(preg_replace('/(.*)entrée a été publiée le (.*) par(.*)$/i', '$2', $crawler->filter('.meta .meta-information')->text()), 16);
		$stringDate = explode(' ', $stringDate);
		$months = ['', 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
		$stringDate[0] = str_pad($stringDate[0], 2, '0', STR_PAD_LEFT);
		$stringDate[1] = array_search($stringDate[1], $months);
		$post['date'] =  implode('-', array_reverse($stringDate));

		$ps = $crawler->filter('#single > p');
		for ($i = 0; $i < count($ps); $i++) {
			$p = $ps->eq($i);
			if ($i == 0) {
				$post['label'] = substr($p->text(), 0, 250);
				$post['presentation'] = $p->text();
			} else {
				if ($p->text() == "Topo du canyon")
					break ;
				$post['approach'] .= str_replace('<br>', "\n", $p->html())."\n\n";
			}
			
		}

		$post['label'] = substr($crawler->filter('#single > p')->first()->text(), 0, 250);
		$post['presentation'] = $crawler->filter('#single > p')->first()->text();

		$imgs = $crawler->filter('.tiled-gallery img');

		$folder = $this->MediaFolder->q()->where('title', $category)->fetch();
		$lastId = (!$folder) ? $this->MediaFolder->create(0, 'Canyoning')->execute() : $folder['id'];

		$folder = $this->MediaFolder->q()->where(['title' => $post['country'], 'parent_id' => $lastId])->fetch();
		$lastId = (!$folder) ? $this->MediaFolder->create($lastId, $post['country'])->execute() : $folder['id'];

		$folder = $this->MediaFolder->q()->where(['title' => $post['region'], 'parent_id' => $lastId])->fetch();
		$lastId = (!$folder) ? $this->MediaFolder->create($lastId, $post['region'])->execute() : $folder['id'];

		$folder = $this->MediaFolder->q()->where(['title' => $post['site'], 'parent_id' => $lastId])->fetch();
		$lastId = (!$folder) ? $this->MediaFolder->create($lastId, $post['site'])->execute() : $folder['id'];

		$urls = array_map(function ($v) {
			return strtok($v, '?');
		}, $imgs->extract(['src']));
		$urls = array_slice($urls, 0, 3);
		$ids = $this->Media->downloadFilesToFolder($urls, $lastId);

		$postId = $this->Post->queryB()->insertInto($this->Post->table(), $post)->execute();

		foreach ($ids as $mediaId) {
			$this->MediaToPost->createRelationship($mediaId, $postId, 'gallery')->execute();
		}

		debug($post);
	}

}