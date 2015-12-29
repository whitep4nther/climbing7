<?= js(['Api.js', 'bundle.js']) ?>

<div id="root">
</div>

<script type="text/javascript">
ReactDOM.render(
	React.createElement(Navigator),
	document.getElementById('root')
);
</script>