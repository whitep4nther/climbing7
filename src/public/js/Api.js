var API = {};

API._makeRequest = function (url) {
	return fetch(ROOT + url);
}

API.getFolderContents = function (folderId) {
	return this._makeRequest('/library/folder/' + folderId);
};

API.createFolder = function (parentId) {
	return this._makeRequest('/library/create-folder/' + parentId);
};

API.renameFolder = function (folderId, newName) {
	return fetch(ROOT + '/library/', {method: 'post'});
};