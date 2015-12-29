var API = {};

API._makeRequest = function (url) {
	return $.getJSON(ROOT + url);
}

API.getFolderContents = function (folderId) {
	return this._makeRequest('/library/folder/' + folderId);
};

API.createFolder = function (parentId) {
	return this._makeRequest('/library/create-folder/' + parentId);
};