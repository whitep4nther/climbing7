<html>
	<head>
		<title>Coucou</title>

		<script type="text/javascript">
		var ROOT = '<?= \Slim\Slim::getInstance()->request()->getRootUri(); ?>';
		</script> 
		<?= js('media.js'); ?>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.4/handlebars.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
	</head>
<body>
	<?php echo $content_for_layout; ?>
</body>
</html>