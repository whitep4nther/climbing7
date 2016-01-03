
var ItemList = require('./ItemList.jsx');
var NavigatorItem = require('./NavigatorItem.jsx');
var WindowItem = require('./WindowItem.jsx');

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

	getInitialState: function () {
		return {
			breadcrumbs: [],
			navigatorItems: [],
			windowItems: []
		};
	},

	componentDidMount: function () {
		fetch(ROOT + '/library/folders')
			.then(function (res) {
				return res.json();
			})
			.then(function (json) {
				this.setState({
					navigatorItems: json
				});
			}.bind(this))
			.catch('err', console.error);
	},

	currentFolder: function () {
		return this.state.breadcrumbs[this.state.breadcrumbs.length - 1];
	},
	loadFolder: function (folderId) {
		API
		.getFolderContents(folderId)
		.then(function (res) {
			return res.json()
		})
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
	fileClick: function () {
		alert('file clicked!');
	},
	render: function () {
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
						<div className="button" onClick={this.createFolder}>Nouveau dossier</div>

						<form action="/climbing7/library/upload-to/17" encType="multipart/form-data" method="post">
						<input id="uploadField" type="file" name="files[]" multiple/>
						<input id="uploadHere" className="button" onClick={this.uploadHere} type="submit" defaultValue="Uploader ici!"/>
						</form>
					</div>
					
					<div id="breadcrumbs">
						{breadcrumbs}
					</div>

					<div id="windowContent">
						<ItemList item={WindowItem}  data={this.state.windowItems} pass={{folderClick: this.loadFolder, fileClick: this.fileClick}}/>
					</div>
				</div>
			</div>
		);
	}
});