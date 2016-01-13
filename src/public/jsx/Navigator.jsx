
var ItemList = require('./ItemList.jsx');
var NavigatorItem = require('./NavigatorItem.jsx');
var WindowItem = require('./WindowItem.jsx');

var _updateSelectedFiles = function (selectedFiles, clickedFile) {
	var n = selectedFiles.slice();
	var end = 0;
	for (var i = 0; i < n.length; i++) {
		if (n[i].id === clickedFile.id) {
			n.splice(i, 1);
			return n;
		}
	}
	n.push(clickedFile);
	return n;
};

var _updateBreadcrumbs = function (breadcrumbs, folder) {
	var end = 0;
	for (var i = 0; i < breadcrumbs.length; i++) {
		if (breadcrumbs[i].id === folder.parent_id) {
			end = i + 1;
			break ;
		}
	}
	var r = breadcrumbs.slice(0, end);
	r.push(folder);
	return r;
};

window.Navigator = React.createClass({

	_callbackSelectionDone: null,

	getInitialState: function () {
		return {
			selectedFiles: [],
			breadcrumbs: [],
			navigatorItems: [],
			windowItems: []
		};
	},

	componentDidMount: function () {
		var queryParams = getQueryParams();

		if (queryParams['callback'])
			this._callbackSelectionDone = queryParams['callback'];

		API
		.getFolders()
		.then(function (json) {
			this.setState({
				navigatorItems: json
			});
		}.bind(this));

		this.loadFolder(27);
	},

	currentFolder: function () {
		return this.state.breadcrumbs[this.state.breadcrumbs.length - 1];
	},
	currentFolderId: function () {
		var folder = this.currentFolder();
		return folder ? folder.id : 0;
	},

	loadFolder: function (folderId) {
		API
		.getFolderContents(folderId)
		.then(function (json) {
			this.setState({
				breadcrumbs: _updateBreadcrumbs(this.state.breadcrumbs, json.folder),
				windowItems: json.content
			});
		}.bind(this));
	},
	createFolder: function () {
		var id = this.state.breadcrumbs.length > 0 ? this.currentFolder().id : 0;

		API
		.createFolder(id)
		.then(function (res) {
			this.loadFolder(id);
		}.bind(this));
	},

	uploadHere: function (e) {
		e.preventDefault();
		API
		.uploadFiles(this.currentFolderId(), this.refs.filesForm);
	},

	isFileSelected: function (file) {
		for (var i = 0; i < this.state.selectedFiles.length; i++) {
			if (this.state.selectedFiles[i].id == file.id)
				return true;
		}
		return false;
	},
	toggleSelectedFile: function (file) {
		this.setState({
			selectedFiles: _updateSelectedFiles(this.state.selectedFiles, file)
		});
		// if (this._callbackSelectionDone && window.opener && window.opener[this._callbackSelectionDone]) {
		// 	window.opener[this._callbackSelectionDone](file);
		// 	window.close();
		// } else
		// 	alert('File selected, but no callback associated');
	},
	confirmSelection: function () {
		if (window.opener && this.props.callback && window.opener[this.props.callback]) {
			window.opener[this.props.callback](this.state.selectedFiles);
			window.close();
		} else
			alert('Selection confirmed, but no callback has been specified (contact Ilyes hehe)');
	},
	render: function () { 
		var files = this.state.selectedFiles.map(function (file) {
			return (
				<div className="selected-file" onClick={this.toggleSelectedFile.bind(this, file)}>
						<img src={MEDIA_DIR + file.full_path + '?height=100'}/>
				</div>
			);
		}.bind(this));
		var breadcrumbs = this.state.breadcrumbs.map(function (crumb) {
			return (
				<p className="breadcrumb" onClick={this.loadFolder.bind(this, crumb.id)}>{crumb.title}</p>
			);
		}.bind(this));

		return (
			<div id="navigator">

				<div id="leftPanel">
					<ItemList item={NavigatorItem} data={this.state.navigatorItems} pass={{click: this.loadFolder}}/>
				</div>
				<div id="window">
					<div id="windowToolbar">
						{files}
						<button onClick={this.confirmSelection}>Confirmer la sélection</button>

						<div className="button" onClick={this.createFolder}>Nouveau dossier</div>

						<form ref="filesForm" onSubmit={this.uploadHere} encType="multipart/form-data" method="post">
							<input id="uploadField" type="file" name="files[]" multiple/>
							<input id="uploadHere" className="button" type="submit" defaultValue="Uploader ici!"/>
						</form>
					</div>
					
					<div id="breadcrumbs">
						{breadcrumbs}
					</div>

					<div id="windowContent">
						<ItemList item={WindowItem}  data={this.state.windowItems} pass={{folderClick: this.loadFolder, fileClick: this.toggleSelectedFile, isSelected: this.isFileSelected}}/>
					</div>
				</div>
			</div>
		);
	}
});