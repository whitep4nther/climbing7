var MediaManager = {};

MediaManager.loadFolders = function (template, element) {
	$.getJSON(ROOT + '/library/folders', function (data) {
		var html = Handlebars.compile(template.innerHTML)({
			folders: data
		});

		element.innerHTML = html;
	})
	.always(function () {
		console.log('success')
	});
};