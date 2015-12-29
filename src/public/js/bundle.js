(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){

var ItemList = React.createClass({displayName: "ItemList",
	getDefaultProps: function() {
	    return {
	    	click: function () {}
	    };
	},
	render: function () {
		var itemNodes = this.props.data.map(function (data) {
			var ClassItem = this.props.item;
			return (
				React.createElement(ClassItem, React.__spread({key: data.id, data: data},  this.props.pass))
			);
		}.bind(this));

		return (
			React.createElement("div", {className: "navigatorList"}, 
				itemNodes
			)
		);
	}
});

module.exports = ItemList;

},{}],2:[function(require,module,exports){

var ItemList = require('./ItemList.jsx');
var NavigatorItem = require('./NavigatorItem.jsx');
var WindowItem = require('./WindowItem.jsx');

window.Navigator = React.createClass({displayName: "Navigator",

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
			React.createElement("div", {id: "navigator"}, 

				React.createElement("div", {id: "leftPanel"}, 
					React.createElement(ItemList, {item: NavigatorItem, data: this.state.navigatorItems, pass: {click: this.loadFolder}})
				), 
				React.createElement("div", {id: "window"}, 
					React.createElement("div", {id: "windowToolbar"}, 
						React.createElement("div", {className: "button", onClick: this.createFolder}, "Nouveau dossier"), 

						React.createElement("form", {action: "/climbing7/library/upload-to/17", encType: "multipart/form-data", method: "post"}, 
						React.createElement("input", {id: "uploadField", type: "file", name: "files[]", multiple: true}), 
						React.createElement("input", {id: "uploadHere", className: "button", onClick: this.uploadHere, type: "submit", defaultValue: "Uploader ici!"})
						)
					), 
					React.createElement("div", {id: "windowContent"}, 
						React.createElement(ItemList, {item: WindowItem, data: this.state.windowItems, pass: {folderClick: this.loadFolder, fileClick: this.fileClick}})
					)
				)
			)
		);
	}
});

},{"./ItemList.jsx":1,"./NavigatorItem.jsx":3,"./WindowItem.jsx":4}],3:[function(require,module,exports){

var NavigatorItem = React.createClass({displayName: "NavigatorItem",
	render: function () {
		return (
			React.createElement("div", {className: "navigatorItem", onClick: withArgs(this.props.click, [this.props.data.id])}, this.props.data.title)
		);
	}
});

module.exports = NavigatorItem;

},{}],4:[function(require,module,exports){

var WindowItem = React.createClass({displayName: "WindowItem",

	click() {
		if (this.props.data.type == 'folder')
			this.props.folderClick(this.props.data.id);
		else
			this.props.fileClick();
	},

	render() {
		return (
			React.createElement("div", {className: "navigatorItem", onClick: this.click}, this.props.data.title)
		);
	}
});

module.exports = WindowItem;

},{}]},{},[1,2,3]);
