<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.4/react.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.4/react-dom.min.js"></script>
<?= js(['fetch.js', 'Api.js', 'bundle.js']) ?>

<div id="root">
</div>

<script type="text/javascript">
ReactDOM.render(
	React.createElement(Navigator),
	document.getElementById('root')
);
</script>