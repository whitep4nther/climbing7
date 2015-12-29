
var ItemList = require('./ItemList.jsx');
var NavigatorItem = require('./NavigatorItem.jsx');
var WindowItem = require('./WindowItem.jsx');

window.Navigator = React.createClass({

	getInitialState: function () {
		return {
			currentFolder: null,
			navigatorItems: [],
			windowItems: []
		};
	},

	componentDidMount: function () {
		$.getJSON(ROOT + '/library/folders')
		.done(function (json) {
			this.setState({
				navigatorItems: json
			});
		}.bind(this));
	},
	loadFolder: function (folderId) {
		API
		.getFolderContents(folderId)
		.done(function (json) {
			this.setState({
				currentFolder: json.folder,
				windowItems: json.content
			});
		}.bind(this));
	},
	createFolder: function () {
		var id = this.state.currentFolder ? this.state.currentFolder.id : 0;

		API
		.createFolder(id)
		.done(function () {
			this.loadFolder(id);
		}.bind(this));
	},
	fileClick: function () {
		alert('file clicked!');
	},
	render: function () {
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
					<div id="windowContent">
						<ItemList item={WindowItem}  data={this.state.windowItems} pass={{folderClick: this.loadFolder, fileClick: this.fileClick}}/>
					</div>
				</div>
			</div>
		);
	}
});