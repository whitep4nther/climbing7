
var Dispatcher = require('../Dispatcher'),
	ActionsTypes = require('./');

module.exports = {

	navigateToFolder: function (folderId) {
		API
		.getFolderContents(folderId)
		.then(function (folder) {
			Dispatcher.emit(ActionsTypes.NAVIGATE_TO_FOLDER, folder);
		}.bind(this));
	},

	clickedFile: function (file) {
		Dispatcher.emit(ActionsTypes.CLICKED_FILE, file);
	}

};
