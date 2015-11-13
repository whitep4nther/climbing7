<script id="navigatorTemplate" type="text/x-handlebars-template">
	<ul id="folderList">
		{{#each folders}}
			<li>{{this.title}}</li>
		{{/each}}
	</ul>
</script>

<div id="manager">
	<div id="navigator">
		
	</div>
	<div id="main">
	</div>
</div>

<script>
$(document).ready(function () {
	MediaManager.loadFolders(document.getElementById('navigatorTemplate'), document.getElementById('navigator'));
});
</script>