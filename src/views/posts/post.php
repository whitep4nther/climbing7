<?php debug(array_keys(get_defined_vars())); ?>

	<img src="<?= asset('img/canyoning.jpg') ?>" style="display:block; width:175px;height:175px;border:2px solid white;position:absolute;z-index:10;top:265px;"/>
<!--PRESENTATION TOPO-->
	<section id="topPresentation">
		<p class="categorie"><span style="background-color:#8c6239;;color:#fff;padding:0px 5px;"><?= $category['name'] ?></span> <span style="color:#8c6239;padding:0;"><?= \Helper\PostHelper::rateToStars($post['rate']) ?></span></p>
		<p class="titre"><?= \Helper\PostHelper::title($post) ?></p>
		<p class="soustitre"><?= implode(', ', [$post['site'], $post['region'], $post['country']]) ?></p>	
	</section>	
	<section id="presentation">
		<img src="<?= asset('img/photoPostA.jpg') ?>" style="width:500px;height:375px;display:block;float:left;margin-right:40px;"/>
		<section>
			<p class="date"><?= strftime('Le %d %B %Y', strtotime($post['date'])) ?></p>
			<ul id="iconMenu">
				<li><a href="#topo" class="scroll"><img title="topo du parcours" src="<?= asset('img/topo.png') ?>"/></a></li>
				<li><a href="#photos" class="scroll"><img title="photos du parcours" src="<?= asset('img/photos.png') ?>"/></a></li>
				<li><a href="#comments" class="scroll"><img title="laisser ou voir les commentaires" src="<?= asset('img/comments.png') ?>"/></a></li>
				<li><a href="" class="scroll"><img title="imprimer le topo" src="<?= asset('img/print.png') ?>"/></a></li>
			</ul>
			
			<?= nl2br($post['presentation']) ?>

		</section>
	</section>
<!--FIN DE PRESENTATION TOPO-->
<!--TOPO -->
	<section style="width:1000px;margin:auto;margin-bottom:60px;overflow:hidden;">
		<section style="text-align:center;margin-top:20px;">
			<p class="etiquette"><span style="background-color:#8c6239;color:#fff;padding:0px 5px;">Topo du parcours</span><a href="#top" id="topo" class="scroll top" style="color:#8c6239;padding:0 4px;margin:0;text-decoration:none;">top page</a></p>
		</section>
		<br/>
		<aside id="caracteristiques">
			<p class="titre">Caractérisques</p>
			<p>
				<?= nl2br($post['characteristics']) ?>
			</p>

			<p class="titre">Accès</p>
			<p>
				<?= nl2br($post['access']) ?>
			</p>

			<p class="titre">Topo</p>
			<img class="imgTopo" src="<?= asset('img/imgTopo.jpg') ?>" />
		</aside>
		<section id="parcours">
			<p class="titre">Approche</p>
			<p>
				<?= nl2br($post['approach']) ?>
			</p>

			<p class="titre">Parcours</p>
			<p>
				<?= nl2br($post['parcours']) ?>
			</p>

			<p class="titre">Retour</p>
			<p>
				<?= nl2br($post['back']) ?>
			</p>

		</section><!--fin div parcours-->
	</section>
<!--FIN TOPO-->
<!--POST RELIÉS-->		
	<section style="text-align:center;margin-top:0;">
		<p class="etiquette"><span style="background-color:#8c6239;color:#fff;padding:0px 5px;">Posts reliés</span><a href="#top" id="topo" class="scroll top" style="color:#8c6239;padding:0 4px;margin:0;text-decoration:none;">top page</a></p>
	</section>	
	<br/><br/>
	<aside class="tag4posts">
		<img src="<?= asset('img/photoPostA.jpg') ?>" width="208px;" />
		<p class="titre">Titre du post en entier</p>
		<p class="sousTitre">Catégorie, Pays</p>
		<p class="date">26 NOVEMBRE 2015</p>
	</aside>	
	<aside class="tag4posts">
		<img src="<?= asset('img/photoPostB.jpg') ?>" width="208px;" />
		<p class="titre">Titre du post en entier</p>
		<p class="sousTitre">Catégorie, Pays</p>
		<p class="date">26 NOVEMBRE 2015</p>
	</aside>			
	<aside class="tag4posts">
		<img src="<?= asset('img/photoPost.jpg') ?>" width="208px;" />
		<p class="titre">Titre du post en entier</p>
		<p class="sousTitre">Catégorie, Pays</p>
		<p class="date">26 NOVEMBRE 2015</p>
	</aside>
	<aside class="tag4posts">
		<img src="<?= asset('img/photoPostA.jpg') ?>" width="208px;" />
		<p class="titre">Titre du post en entier</p>
		<p class="sousTitre">Catégorie, Pays</p>
		<p class="date">26 NOVEMBRE 2015</p>
	</aside>
	<section class="plusDePost">
		<p>Voir plus de posts</p>
	</section>
<!--FIN POSTS RELIES-->	
	<br/><br/>
<!--GALERIE PHOTOS-->	
	<section style="text-align:center;margin-top:0;">
		<p class="etiquette"><span style="background-color:#8c6239;color:#fff;padding:0px 5px;">Galerie de photos</span><a href="#top" id="photos" class="scroll top" style="color:#8c6239;padding:0 4px;margin:0;text-decoration:none;">top page</a></p>
	</section>	
	<br/><br/>
	<section id="galerie">
		<div id="mygallery" class="swipe-box">
			<?php
			if ($medias) {
				foreach ($medias as $media) {
			?>
					<a title="légende photo 1"><img src="<?= library($media['full_path']) ?>"/></a>
	        <?php
		        }
	    	}
	        ?>
 		</div> <!-- mygallery-->
 	</section>		
 	<script> $(document).ready(function () {
            $('.swipe-box').each(function (i, el) {
                $(el).justifiedGallery({rel: 'gal' + i, 'lastRow': 'justify', 'rowHeight':250, 'maxRowHeight':-1, 'randomize':false, 'margins':2}).on('jg.complete', function () {
                    if (i == 0) $('.swipe-box a').swipebox();
                });
            });
        });
	</script>
<!--FIN GALERIE-->
<!--COMMENTAIRES-->
	<section style="text-align:center;margin-top:0;">
		<p class="etiquette"><span style="background-color:#8c6239;color:#fff;padding:0px 5px;">Commentaires</span><a href="#top" id="comments" class="scroll top" style="color:#8c6239;padding:0 4px;margin:0;text-decoration:none;">top page</a></p>
	</section>		
	<section id="commentaires">
		<p> Il n' y a aucun commentaire pour le moment. Soyez le premier ! </p>
		<br/><br/>
		<p style="display:inline;background-color:#936436;font-family:oswaldlight;font-size:16px;color:#fff;letter-spacing:0.5px;padding:2px 6px 2px 6px;border-radius:5px;" >Laisser un commentaire</p>
	</section>
<!--FIN COMMENTAIRES-->
