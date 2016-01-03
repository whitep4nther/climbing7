<html>
	<head>
		<title>Coucou</title>

		<script type="text/javascript">
		var ROOT = '<?= $app->request()->getRootUri(); ?>';
		</script> 
		<?= js(['functions.js']) ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.2/react.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.2/react-dom.js"></script>

		<?= css(['main.css', 'reset.css', 'manager.css']) ?>
	</head>
<body>
	<?php echo $content_for_layout; ?>
</body>
</html>