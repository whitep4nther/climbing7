var API = {};

API._makeRequest = function (url) {
	return $.getJSON(ROOT + url);
}

API.getFolders = function () {
	return this._makeRequest('/library/folders');
};

API.getFolderContents = function (folderId) {
	return this._makeRequest('/library/folder/' + folderId);
};

API.createFolder = function (parentId) {
	return this._makeRequest('/library/create-folder/' + parentId);
};

API.renameFolder = function (folderId, newName) {
	return this._makeRequest('/library/', {method: 'post'});
};

API.uploadFiles = function (folderId, files) {
	$.ajax({
		url: ROOT + '/library/upload-to/' + folderId,
		processData: false,
		contentType: false,
		type: 'POST',
		data: new FormData(files)
	});
};