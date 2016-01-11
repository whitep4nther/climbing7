(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var ItemList = React.createClass({
	displayName: "ItemList",

	getDefaultProps: function () {
		return {
			click: function () {}
		};
	},
	render: function () {
		var itemNodes = this.props.data.map(function (data) {
			var ClassItem = this.props.item;
			return React.createElement(ClassItem, _extends({ key: data.id, data: data }, this.props.pass));
		}.bind(this));

		return React.createElement(
			"div",
			{ className: "itemList" },
			itemNodes
		);
	}
});

module.exports = ItemList;

},{}],2:[function(require,module,exports){

var ItemList = require('./ItemList.jsx');
var NavigatorItem = require('./NavigatorItem.jsx');
var WindowItem = require('./WindowItem.jsx');

var _updateBreadcrumbs = function (breadcrumbs, folder) {
	var end = 0;
	for (var i = 0; i < breadcrumbs.length; i++) {
		if (breadcrumbs[i].id === folder.parent_id) {
			end = i + 1;
			break;
		}
	}
	var r = breadcrumbs.slice(0, end);
	r.push(folder);
	return r;
};

window.Navigator = React.createClass({
	displayName: 'Navigator',

	getInitialState: function () {
		return {
			breadcrumbs: [],
			navigatorItems: [],
			windowItems: []
		};
	},

	componentDidMount: function () {
		API.getFolders().then(function (json) {
			this.setState({
				navigatorItems: json
			});
		}.bind(this));
	},

	currentFolder: function () {
		return this.state.breadcrumbs[this.state.breadcrumbs.length - 1];
	},
	currentFolderId: function () {
		var folder = this.currentFolder();
		return folder ? folder.id : 0;
	},

	loadFolder: function (folderId) {
		API.getFolderContents(folderId).then(function (json) {
			this.setState({
				breadcrumbs: _updateBreadcrumbs(this.state.breadcrumbs, json.folder),
				windowItems: json.content
			});
		}.bind(this));
	},
	createFolder: function () {
		var id = this.state.breadcrumbs.length > 0 ? this.currentFolder().id : 0;

		API.createFolder(id).then(function (res) {
			this.loadFolder(id);
		}.bind(this));
	},

	uploadHere: function (e) {
		e.preventDefault();
		API.uploadFiles(this.currentFolderId(), this.refs.filesForm);
	},

	fileClick: function () {
		alert('file clicked!');
	},
	render: function () {
		var breadcrumbs = this.state.breadcrumbs.map(function (crumb) {
			return React.createElement(
				'p',
				{ className: 'breadcrumb', onClick: this.loadFolder.bind(this, crumb.id) },
				crumb.title
			);
		}.bind(this));

		return React.createElement(
			'div',
			{ id: 'navigator' },
			React.createElement(
				'div',
				{ id: 'leftPanel' },
				React.createElement(ItemList, { item: NavigatorItem, data: this.state.navigatorItems, pass: { click: this.loadFolder } })
			),
			React.createElement(
				'div',
				{ id: 'window' },
				React.createElement(
					'div',
					{ id: 'windowToolbar' },
					React.createElement(
						'div',
						{ className: 'button', onClick: this.createFolder },
						'Nouveau dossier'
					),
					React.createElement(
						'form',
						{ ref: 'filesForm', onSubmit: this.uploadHere, encType: 'multipart/form-data', method: 'post' },
						React.createElement('input', { id: 'uploadField', type: 'file', name: 'files[]', multiple: true }),
						React.createElement('input', { id: 'uploadHere', className: 'button', type: 'submit', defaultValue: 'Uploader ici!' })
					)
				),
				React.createElement(
					'div',
					{ id: 'breadcrumbs' },
					breadcrumbs
				),
				React.createElement(
					'div',
					{ id: 'windowContent' },
					React.createElement(ItemList, { item: WindowItem, data: this.state.windowItems, pass: { folderClick: this.loadFolder, fileClick: this.fileClick } })
				)
			)
		);
	}
});

},{"./ItemList.jsx":1,"./NavigatorItem.jsx":3,"./WindowItem.jsx":4}],3:[function(require,module,exports){

var NavigatorItem = React.createClass({
	displayName: "NavigatorItem",

	render: function () {
		return React.createElement(
			"div",
			{ className: "navigatorItem", onClick: withArgs(this.props.click, [this.props.data.id]) },
			this.props.data.title
		);
	}
});

module.exports = NavigatorItem;

},{}],4:[function(require,module,exports){

var WindowItem = React.createClass({
	displayName: "WindowItem",

	getInitialState() {
		return {
			editing: false
		};
	},

	editTitle() {
		this.setState({
			editing: true
		});
	},
	onKeyDown(e) {
		if (e.keyCode == 13) this.setState({
			editing: false
		});
	},

	click() {
		if (this.props.data.type == 'folder') this.props.folderClick(this.props.data.id);else this.props.fileClick();
	},

	render() {
		var title = this.state.editing ? React.createElement("input", { type: "text", autoFocus: true, onKeyDown: this.onKeyDown, ref: function (input) {
				if (input) {
					input.setSelectionRange(input.value.length, input.value.length);
				}
			}, value: this.props.data.title }) : React.createElement(
			"p",
			{ className: "title", onClick: this.editTitle },
			this.props.data.title
		);

		return React.createElement(
			"div",
			{ className: "windowItem" },
			React.createElement("div", { className: "icon", onClick: this.click }),
			title
		);
	}
});

module.exports = WindowItem;

},{}]},{},[2]);
