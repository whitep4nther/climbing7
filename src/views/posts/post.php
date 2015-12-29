<!-- <?php debug($post); ?> -->

<section  style="width:1000px;margin:auto;">
	<img src="<?= asset('img/canyoning.jpg') ?>" style="display:bloc; width:175px;height:175px;border:2px solid white;position:absolute;z-index:10;top:265px;"/>
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
			
			<?= $post['presentation'] ?>

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
			<p>☰ Paroi de Catalunya<br/>
				☰ Voie équipée de 260m<br/>
				☰ Grande voie en 6 longueurs<br/>
				☰ Difficulté obligatoire 6a ou V+/A0<br/>
				☰ Exposition Est</p>
				<p>Plus du bla bla sur les dificultés éventuelle pour l'orientation, la période, le matériel à prévoir…etc ou en core sur le guide de référence, les sites qui en parle ou le liens pour s'informer..</p>
			<p class="titre">Accès</p>
			<br/>
			<iframe width="340" height="255" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://mapsengine.google.com/map/embed?mid=zrRTl-jdUK5Q.kot_BP2q0jjw"></iframe>
			<p>Une fois dans le village de Santa Maria Navarrese, se rendre dans la partie haute, au dessus du petit port au niveau du restaurant Il Pozzo où l’on peut se garer (même départ que le trek du Monte Oro)</p>
			<p class="titre">Topo</p>
			<img class="imgTopo" src="<?= asset('img/imgTopo.jpg') ?>" />
		</aside>
		<section id="parcours">
			<!-- <p class="titre">Approche (10')</p>
			<p>Prendre depuis le restaurant la Via Pedra Longa qui part et monte en face. La suivre pour rejoindre au bout le restai Bella Vista. Passer derrière pour trouver le départ avec un grand panneau indicateur et une porte de berger d’accès.</p>
			<p class="titre">Parcours</p>
			<p>Le guide de référence utilisé est le guide de randonnée en Sardaigne chez Rother. les indications sont précises (parfois tellement détaillées qu’on s’y perd mais le croquis peut suffire. La difficulté réside principalement dans l’ascension centrale abrupte depuis le pied de la Punta jusqu’au plateau Di Golgo et éventuellement dans l’orientation dans le final vers le sommet. Le marquage est un peu brouillon et aléatoire, ce qui est une caractéristique dans le coin, avec des points bleus (Selvaggio Blu), des points rouges, des cairns qui apparaissent de façon illogique par endroit (beaucoup d’un coup puis plus rien). Cependant l’itinéraire est assez évident car les passages naturels ne laissent pas trop le choix. Les temps sont indicatifs mais compter au moins 4/5 heures pour aller au sommet de la Punta depuis le départ.</p>
			<p><u>Part 1: jusqu’au pied de la Punta (1h30)</u><br/>
			Suivre le sentier qui traverse à flanc au dessus des falaises et de la côte dans le maquis jusqu’à Pedra Longa, avec des petites montées et descentes. Au niveau de Pedra Longa, attraper le sentier au dessus devant la maisonnette orange d’électricité. Continuer sans problème dans le maquis jusqu’à en gros se trouver à l’aplomb de la Punta. Là tourner à gauche (cairn placé car on a pas trouvé dans un 1er temps) et monter abrupt en lacets courts vers la base de la Punta. Le sentier avec quelques passages de grimpe faciles va rejoindre une large rampe à mi hauteur qui va raser la base du rocher, par la gauche (peu visible du bas). Continuer sans difficulté, avec des vues incroyable sur Pedra Longa. À la fin on rejoint des huttes de bois et maisons de berger pour sortir par une petite porte et rejoindre une piste large.</p>
			<p><u>Part 2: la Punta (2h30)</u><br/>
			Continuer la piste jusqu’à croiser la piste principale à remonter vers la gauche sur 250m environ et trouver le sentier qui part à droite (cairn). Suivre ce sentier étroits marqués de points bleus ou de cairns pour finir sur la crête jusqu’à la pointe. C’est aérien et moyennement tracé mais évident car on voit la crête à vue.</p>
			<p class="titre">Retour (1h30)</p>
			<p>Faire sentier inverse depuis la Punta jusque’à la piste (pas évident car marquage confus) et reprendre la piste principale à gauche. Descendre puis remonter dans les bois, c’est long, rester sur la piste principale en gros en laissant les pistes secondaires. Après un bon moment, on rejoint une autre piste avec un bassin à gauche. Là tourner à gauche pour rejoindre la route bitumée plus loin. restent 3 kms de route pour rejoindre en contre-bas Baunei. Du centre du village, attraper un bus ARST (avec de la chance), billet à acheter au bar à coté de l’arrêt pour revenir à Santa Maria Navarrese (sinon stop car il y a 9 kms).</p> -->

			<?= nl2br($post['approach']) ?>


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
			foreach ($medias as $media) {
			?>
				<a title="légende photo 1"><img src="<?= library($media['full_path']) ?>"/></a>
            <?php
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
</section>