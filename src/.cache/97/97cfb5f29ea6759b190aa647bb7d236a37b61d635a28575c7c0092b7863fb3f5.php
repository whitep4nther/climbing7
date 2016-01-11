<?php

/* index.php */
class __TwigTemplate_959823652d00796f0e2ea61c5ac90599f7051290c8cfe3ba87105b717a9e3051 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
\t<img src=\"<?= asset('img/canyoning.jpg') ?>\" style=\"display:bloc; width:175px;height:175px;border:2px solid white;position:absolute;z-index:10;top:265px;\"/>
<!--COLONNE GAUCHE-->
\t<aside id=\"leftSideBar\">
\t\t<br/><br/>
\t\t<h4>SUIVRE LE SITE</h4>
\t\t<p>Suivez les nouvelles publications en recevant un mail lorsqu'un nouveau post est en ligne. Aucune inscription, il suffit de laisser une adresse email.</p>
\t\t<p style=\"width:100px;background-color:#333;color:white;border-radius:5px;padding:2px 5px;\">je m'abonne</p>
\t\t<p>Abonnés (5)</p>
\t\t<img src=\"<?= asset('img/avatar.png') ?>\" style=\"display:bloc;float:left;width:55px;margin:0;\"/><img src=\"<?= asset('img/avatar.png') ?>\" style=\"display:bloc;float:left;width:55px;margin:0;\"/><img src=\"<?= asset('img/avatar.png') ?>\" style=\"display:bloc;float:left;width:55px;margin:0;\"/><img src=\"<?= asset('img/avatar.png') ?>\" style=\"display:bloc;float:left;width:55px;margin:0;\"/><img src=\"<?= asset('img/avatar.png') ?>\" style=\"display:bloc;float:left;width:55px;margin:0;\"/>
\t\t<br/ style=\"clear:left\">
\t\t<h4>STATS</h4>\t\t
\t\t<p>6000 visiteurs</p>
\t\t<h4>DERNIERS COMMENTAIRES</h4>
\t\t<img src=\"<?= asset('img/avatar.png') ?>\" style=\"display:bloc;float:left;width:45px;margin:0 10px 0 0;\"/>
\t\t<p class=\"titreComment\"><span style=\"font-family:oswaldbook;font-size:16px;color:#4e7c8f;\">Jérémy Untel</span><br/>le 12 janvier 2015</p>
\t\t<p>‟ Patati patata patati patata et pas que ça car il y a autre chose…”</p>
\t\t<p style=\"font-size:12px;\"><i>à propos de</i><br/><a style=\"font-size:12px;\" href=\"\">Puntas Salinas, Trekking, Sardaigne</a></p>
\t\t<br/>
\t\t<img src=\"<?= asset('img/avatar.png') ?>\" style=\"display:bloc;float:left;width:45px;margin:0 10px 0 0;\"/>
\t\t<p class=\"titreComment\"><span style=\"font-family:oswaldbook;font-size:16px;color:#4e7c8f;\">Jérémy Untel</span><br/>le 12 janvier 2015</p>
\t\t<p>‟ Patati patata patati patata et pas que ça car il y a autre chose…”</p>
\t\t<p style=\"font-size:12px;\"><i>à propos de</i><br/><a style=\"font-size:12px;\" href=\"\">Puntas Salinas, Trekking, Sardaigne</a></p>
\t\t<br/>
\t\t<img src=\"<?= asset('img/avatar.png') ?>\" style=\"display:bloc;float:left;width:45px;margin:0 10px 0 0;\"/>
\t\t<p class=\"titreComment\"><span style=\"font-family:oswaldbook;font-size:16px;color:#4e7c8f;\">Jérémy Untel</span><br/>le 12 janvier 2015</p>
\t\t<p>‟ Patati patata patati patata et pas que ça car il y a autre chose…”</p>
\t\t<p style=\"font-size:12px;\"><i>à propos de</i><br/><a style=\"font-size:12px;\" href=\"\">Puntas Salinas, Trekking, Sardaigne</a></p>
\t\t<br/>
\t\t<img src=\"<?= asset('img/avatar.png') ?>\" style=\"display:bloc;float:left;width:45px;margin:0 10px 0 0;\"/>
\t\t<p class=\"titreComment\"><span style=\"font-family:oswaldbook;font-size:16px;color:#4e7c8f;\">Jérémy Untel</span><br/>le 12 janvier 2015</p>
\t\t<p>‟ Patati patata patati patata et pas que ça car il y a autre chose…”</p>
\t\t<p style=\"font-size:12px;\"><i>à propos de</i><br/><a style=\"font-size:12px;\" href=\"\">Puntas Salinas, Trekking, Sardaigne</a></p>\t\t\t
\t\t<h4>CONTACT</h4>\t\t
\t\t<p class=\"texte\">Stéphane<br/>arcodep@gmail.com<br/>Tel: +971 27 38 673</p>
\t</aside>\t\t
<!--CORPS-->
\t<section id=\"lastPosts\">
\t\t<h4>DERNIERS POSTS</h4>

\t\t<?php
\t\t\$lastPosts1 = array_splice(\$posts, 0, 2);

\t\tforeach (\$lastPosts1 as \$post1) {
\t\t?>
\t\t<aside class=\"lastPost1\">
\t\t\t<img src=\"<?= asset('img/photoPostA.jpg') ?>\" style=\"width:333px;margin:0;\" />
\t\t\t<p style=\"font-family:oswaldbook;font-size:20px;margin:10px 0 0 0px;\"><?= \$post1['title'] ?> <?= \\Helper\\PostHelper::rateToStars(\$post1['rate'], '*', '') ?></p>
\t\t\t<p style=\"font-family:oswaldlight;font-size:18px;color:#8c6239;margin:0 0 5px; 0;\"><?= \$categories[\$post1['category_id']]['name'] ?> <?= sprintf(\"%s, %s, %s\", \$post1['country'], \$post1['region'], \$post1['site']) ?></p>
\t\t\t<p style=\"font-family:oswaldlight;font-size:12px;color:#4e7c8f;margin:0 0 10px; 0;\">POSTÉ <?= mb_strtoupper(strftime('LE %d %B %Y', strtotime(\$post1['date'])), 'UTF-8') ?></p>
\t\t\t<p style=\"font-family:oswaldlight;font-size:14px;\">
\t\t\t\t<?= substr(\$post1['presentation'], 0, 280).\"[...]\" ?>
\t\t\t</p>
\t\t\t<p><a href=\"<?= \\Helper\\PostHelper::urlForPost(\$post1) ?>\">Lire la suite du post</a></p>
\t\t</aside>

\t\t<?php
\t\t}

\t\tforeach (\$posts as \$post) {
\t\t?>
\t\t<aside class=\"lastPost\">
\t\t\t<img src=\"<?= asset('img/photoPost.jpg') ?>\" style=\"width:208px;margin:0;\" />
\t\t\t<p style=\"font-family:oswaldbook;font-size:16px;margin:10px 0 0 0px;\"><?= \$post1['title'] ?></p>
\t\t\t<p style=\"font-family:oswaldlight;font-size:14px;color:#8c6239;margin:0 0 5px; 0;\"><?= \$categories[\$post1['category_id']]['name'] ?> <?= sprintf(\"%s, %s, %s\", \$post1['country'], \$post1['region'], \$post1['site']) ?></p>
\t\t\t<p style=\"font-family:oswaldlight;font-size:10px;color:#4e7c8f;margin:0 0 10px; 0;\">POSTÉ <?= mb_strtoupper(strftime('LE %d %B %Y', strtotime(\$post1['date'])), 'UTF-8') ?></p>
\t\t\t<p style=\"font-family:oswaldlight;font-size:14px;\">
\t\t\t\t<?= substr(\$post1['presentation'], 0, 280).\"[...]\" ?>
\t\t\t</p>
\t\t\t<p><a href=\"<?= \\Helper\\PostHelper::urlForPost(\$post) ?>\">Lire la suite du post</a></p>
\t\t</aside>
\t\t<?php
\t\t}
\t\t?>

\t\t<section class=\"plusDePost\">
\t\t\t<p>Voir plus de posts</p>
\t\t</section>
\t\t<br/><br/>
\t</section>\t\t\t
";
    }

    public function getTemplateName()
    {
        return "index.php";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
/* */
/* 	<img src="<?= asset('img/canyoning.jpg') ?>" style="display:bloc; width:175px;height:175px;border:2px solid white;position:absolute;z-index:10;top:265px;"/>*/
/* <!--COLONNE GAUCHE-->*/
/* 	<aside id="leftSideBar">*/
/* 		<br/><br/>*/
/* 		<h4>SUIVRE LE SITE</h4>*/
/* 		<p>Suivez les nouvelles publications en recevant un mail lorsqu'un nouveau post est en ligne. Aucune inscription, il suffit de laisser une adresse email.</p>*/
/* 		<p style="width:100px;background-color:#333;color:white;border-radius:5px;padding:2px 5px;">je m'abonne</p>*/
/* 		<p>Abonnés (5)</p>*/
/* 		<img src="<?= asset('img/avatar.png') ?>" style="display:bloc;float:left;width:55px;margin:0;"/><img src="<?= asset('img/avatar.png') ?>" style="display:bloc;float:left;width:55px;margin:0;"/><img src="<?= asset('img/avatar.png') ?>" style="display:bloc;float:left;width:55px;margin:0;"/><img src="<?= asset('img/avatar.png') ?>" style="display:bloc;float:left;width:55px;margin:0;"/><img src="<?= asset('img/avatar.png') ?>" style="display:bloc;float:left;width:55px;margin:0;"/>*/
/* 		<br/ style="clear:left">*/
/* 		<h4>STATS</h4>		*/
/* 		<p>6000 visiteurs</p>*/
/* 		<h4>DERNIERS COMMENTAIRES</h4>*/
/* 		<img src="<?= asset('img/avatar.png') ?>" style="display:bloc;float:left;width:45px;margin:0 10px 0 0;"/>*/
/* 		<p class="titreComment"><span style="font-family:oswaldbook;font-size:16px;color:#4e7c8f;">Jérémy Untel</span><br/>le 12 janvier 2015</p>*/
/* 		<p>‟ Patati patata patati patata et pas que ça car il y a autre chose…”</p>*/
/* 		<p style="font-size:12px;"><i>à propos de</i><br/><a style="font-size:12px;" href="">Puntas Salinas, Trekking, Sardaigne</a></p>*/
/* 		<br/>*/
/* 		<img src="<?= asset('img/avatar.png') ?>" style="display:bloc;float:left;width:45px;margin:0 10px 0 0;"/>*/
/* 		<p class="titreComment"><span style="font-family:oswaldbook;font-size:16px;color:#4e7c8f;">Jérémy Untel</span><br/>le 12 janvier 2015</p>*/
/* 		<p>‟ Patati patata patati patata et pas que ça car il y a autre chose…”</p>*/
/* 		<p style="font-size:12px;"><i>à propos de</i><br/><a style="font-size:12px;" href="">Puntas Salinas, Trekking, Sardaigne</a></p>*/
/* 		<br/>*/
/* 		<img src="<?= asset('img/avatar.png') ?>" style="display:bloc;float:left;width:45px;margin:0 10px 0 0;"/>*/
/* 		<p class="titreComment"><span style="font-family:oswaldbook;font-size:16px;color:#4e7c8f;">Jérémy Untel</span><br/>le 12 janvier 2015</p>*/
/* 		<p>‟ Patati patata patati patata et pas que ça car il y a autre chose…”</p>*/
/* 		<p style="font-size:12px;"><i>à propos de</i><br/><a style="font-size:12px;" href="">Puntas Salinas, Trekking, Sardaigne</a></p>*/
/* 		<br/>*/
/* 		<img src="<?= asset('img/avatar.png') ?>" style="display:bloc;float:left;width:45px;margin:0 10px 0 0;"/>*/
/* 		<p class="titreComment"><span style="font-family:oswaldbook;font-size:16px;color:#4e7c8f;">Jérémy Untel</span><br/>le 12 janvier 2015</p>*/
/* 		<p>‟ Patati patata patati patata et pas que ça car il y a autre chose…”</p>*/
/* 		<p style="font-size:12px;"><i>à propos de</i><br/><a style="font-size:12px;" href="">Puntas Salinas, Trekking, Sardaigne</a></p>			*/
/* 		<h4>CONTACT</h4>		*/
/* 		<p class="texte">Stéphane<br/>arcodep@gmail.com<br/>Tel: +971 27 38 673</p>*/
/* 	</aside>		*/
/* <!--CORPS-->*/
/* 	<section id="lastPosts">*/
/* 		<h4>DERNIERS POSTS</h4>*/
/* */
/* 		<?php*/
/* 		$lastPosts1 = array_splice($posts, 0, 2);*/
/* */
/* 		foreach ($lastPosts1 as $post1) {*/
/* 		?>*/
/* 		<aside class="lastPost1">*/
/* 			<img src="<?= asset('img/photoPostA.jpg') ?>" style="width:333px;margin:0;" />*/
/* 			<p style="font-family:oswaldbook;font-size:20px;margin:10px 0 0 0px;"><?= $post1['title'] ?> <?= \Helper\PostHelper::rateToStars($post1['rate'], '*', '') ?></p>*/
/* 			<p style="font-family:oswaldlight;font-size:18px;color:#8c6239;margin:0 0 5px; 0;"><?= $categories[$post1['category_id']]['name'] ?> <?= sprintf("%s, %s, %s", $post1['country'], $post1['region'], $post1['site']) ?></p>*/
/* 			<p style="font-family:oswaldlight;font-size:12px;color:#4e7c8f;margin:0 0 10px; 0;">POSTÉ <?= mb_strtoupper(strftime('LE %d %B %Y', strtotime($post1['date'])), 'UTF-8') ?></p>*/
/* 			<p style="font-family:oswaldlight;font-size:14px;">*/
/* 				<?= substr($post1['presentation'], 0, 280)."[...]" ?>*/
/* 			</p>*/
/* 			<p><a href="<?= \Helper\PostHelper::urlForPost($post1) ?>">Lire la suite du post</a></p>*/
/* 		</aside>*/
/* */
/* 		<?php*/
/* 		}*/
/* */
/* 		foreach ($posts as $post) {*/
/* 		?>*/
/* 		<aside class="lastPost">*/
/* 			<img src="<?= asset('img/photoPost.jpg') ?>" style="width:208px;margin:0;" />*/
/* 			<p style="font-family:oswaldbook;font-size:16px;margin:10px 0 0 0px;"><?= $post1['title'] ?></p>*/
/* 			<p style="font-family:oswaldlight;font-size:14px;color:#8c6239;margin:0 0 5px; 0;"><?= $categories[$post1['category_id']]['name'] ?> <?= sprintf("%s, %s, %s", $post1['country'], $post1['region'], $post1['site']) ?></p>*/
/* 			<p style="font-family:oswaldlight;font-size:10px;color:#4e7c8f;margin:0 0 10px; 0;">POSTÉ <?= mb_strtoupper(strftime('LE %d %B %Y', strtotime($post1['date'])), 'UTF-8') ?></p>*/
/* 			<p style="font-family:oswaldlight;font-size:14px;">*/
/* 				<?= substr($post1['presentation'], 0, 280)."[...]" ?>*/
/* 			</p>*/
/* 			<p><a href="<?= \Helper\PostHelper::urlForPost($post) ?>">Lire la suite du post</a></p>*/
/* 		</aside>*/
/* 		<?php*/
/* 		}*/
/* 		?>*/
/* */
/* 		<section class="plusDePost">*/
/* 			<p>Voir plus de posts</p>*/
/* 		</section>*/
/* 		<br/><br/>*/
/* 	</section>			*/
/* */
