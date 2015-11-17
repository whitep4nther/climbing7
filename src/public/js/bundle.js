(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){

var NavigatorItemList = require('./NavigatorItemList.jsx');

window.Navigator = React.createClass({displayName: "Navigator",
	getInitialState: function () {
		return {
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

	loadFolder: function (id) {
		$.getJSON(ROOT + '/library/folder/'+ id)
		.done(function (json) {
			this.setState({
				windowItems: json
			});
		}.bind(this));
	},
	render: function () {

		return (
			React.createElement("div", {id: "navigator"}, 
				React.createElement("div", {id: "leftPanel"}, 
					React.createElement(NavigatorItemList, {data: this.state.navigatorItems, click: this.loadFolder})
				), 
				React.createElement("div", {id: "window"}, 
					React.createElement(NavigatorItemList, {data: this.state.windowItems})
				)
			)
		);
	}
});

},{"./NavigatorItemList.jsx":3}],2:[function(require,module,exports){
var NavigatorItem = React.createClass({displayName: "NavigatorItem",
	render: function () {
		return (
			React.createElement("li", {onClick: this.props.onClick}, this.props.item.title)
		);
	}
});

module.exports = NavigatorItem;

},{}],3:[function(require,module,exports){

var NavigatorItem = require('./NavigatorItem.jsx');

var NavigatorItemList = React.createClass({displayName: "NavigatorItemList",
	getDefaultProps: function() {
	    return {
	    	click: function () {}
	    };
	},
	render: function () {
		var itemNodes = this.props.data.map(function (item) {
			return (
				React.createElement(NavigatorItem, {key: item.id, item: item, onClick: this.props.click.arg(item.id)})
			);
		}.bind(this));

		return (
			React.createElement("ul", {class: "navigatorList"}, 
				itemNodes
			)
		);
	}
});

module.exports = NavigatorItemList;

},{"./NavigatorItem.jsx":2}]},{},[1]);
