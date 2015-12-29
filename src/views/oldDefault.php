<html>
	<head>
		<title>Coucou</title>

		<script type="text/javascript">
		var ROOT = '<?= \Slim\Slim::getInstance()->request()->getRootUri(); ?>';
		</script> 
		<?= js(['functions.js']) ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.2/react.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.2/react-dom.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

		<?= css(['main.css', 'reset.css', 'manager.css']) ?>
	</head>
<body>
	<?php echo $content_for_layout; ?>
</body>
</html>