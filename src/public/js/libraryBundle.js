(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
/*!
  Copyright (c) 2016 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
/* global define */

(function () {
	'use strict';

	var hasOwn = {}.hasOwnProperty;

	function classNames () {
		var classes = [];

		for (var i = 0; i < arguments.length; i++) {
			var arg = arguments[i];
			if (!arg) continue;

			var argType = typeof arg;

			if (argType === 'string' || argType === 'number') {
				classes.push(arg);
			} else if (Array.isArray(arg)) {
				classes.push(classNames.apply(null, arg));
			} else if (argType === 'object') {
				for (var key in arg) {
					if (hasOwn.call(arg, key) && arg[key]) {
						classes.push(key);
					}
				}
			}
		}

		return classes.join(' ');
	}

	if (typeof module !== 'undefined' && module.exports) {
		module.exports = classNames;
	} else if (typeof define === 'function' && typeof define.amd === 'object' && define.amd) {
		// register as 'classnames', consistent with npm package name
		define('classnames', [], function () {
			return classNames;
		});
	} else {
		window.classNames = classNames;
	}
}());

},{}],2:[function(require,module,exports){
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

},{}],3:[function(require,module,exports){

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
			break;
		}
	}
	var r = breadcrumbs.slice(0, end);
	r.push(folder);
	return r;
};

window.Navigator = React.createClass({
	displayName: 'Navigator',

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

		if (queryParams['callback']) this._callbackSelectionDone = queryParams['callback'];

		API.getFolders().then(function (json) {
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

	isFileSelected: function (file) {
		for (var i = 0; i < this.state.selectedFiles.length; i++) {
			if (this.state.selectedFiles[i].id == file.id) return true;
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
		} else alert('Selection confirmed, but no callback has been specified (contact Ilyes hehe)');
	},
	render: function () {
		var files = this.state.selectedFiles.map(function (file) {
			return React.createElement(
				'div',
				{ className: 'selected-file', onClick: this.toggleSelectedFile.bind(this, file) },
				React.createElement('img', { src: MEDIA_DIR + file.full_path + '?height=100' })
			);
		}.bind(this));
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
					files,
					React.createElement(
						'button',
						{ onClick: this.confirmSelection },
						'Confirmer la sélection'
					),
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
					React.createElement(ItemList, { item: WindowItem, data: this.state.windowItems, pass: { folderClick: this.loadFolder, fileClick: this.toggleSelectedFile, isSelected: this.isFileSelected } })
				)
			)
		);
	}
});

},{"./ItemList.jsx":2,"./NavigatorItem.jsx":4,"./WindowItem.jsx":5}],4:[function(require,module,exports){

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

},{}],5:[function(require,module,exports){

var classNames = require('classnames');

var WindowItem = React.createClass({
	displayName: 'WindowItem',

	click() {
		if (this.props.data.type == 'folder') this.props.folderClick(this.props.data.id);else this.props.fileClick(this.props.data);
	},

	render() {
		return React.createElement(
			'div',
			{ className: classNames('windowItem', { 'selected': this.props.isSelected(this.props.data) }) },
			React.createElement('div', { className: 'icon', onClick: this.click }),
			React.createElement(
				'p',
				{ className: 'title' },
				this.props.data.title
			)
		);
	}
});

module.exports = WindowItem;

},{"classnames":1}]},{},[3]);
