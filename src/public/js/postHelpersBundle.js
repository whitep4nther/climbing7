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

var count = 0;

var classNames = require('classnames');

window.PostGalleryEditor = React.createClass({
	displayName: 'PostGalleryEditor',

	getInitialState() {
		return {
			images: this.props.images,
			deleting: [],
			pending: []
		};
	},
	componentDidMount() {
		this.guid = count++;
		this.cbName = this.guid + 'postGalleryEditor' + this.props.postId + 'gallery';
	},

	cbName: null,
	openLibrary: function () {
		if (!window[this.cbName]) window[this.cbName] = this.libraryCallback;

		openLibrary(this.cbName, true);
	},
	libraryCallback: function (files) {
		this.setState({
			images: this.state.images.concat(files),
			pending: files
		});

		API.createMediasPostRelationship(this.props.postId, files, 'gallery').then(function () {
			this.setState({ pending: [] });
		}.bind(this));

		// this.setState({
		// 	image: file,
		// 	editing: true
		// });

		// API
		// .updatePostFields(this.props.postId, fields)
		// .then(function () {
		// 	this.setState({editing: false, message: 'L\'image a bien été changée'})
		// }.bind(this));
	},

	removeImage: function (image) {
		var n = this.state.deleting.slice();
		n.push(image.relationship_id);
		n.filter(function (value, index, self) {
			return self.indexOf(value) === index;
		});
		this.setState({ deleting: n });

		API.detachMediaFromPost(this.props.postId, image.relationship_id).then(function () {
			this.setState({
				images: this.state.images.filter(function (img) {
					return img.relationship_id != image.relationship_id;
				}),
				deleting: this.state.deleting.filter(function (id) {
					return id != image.relationship_id;
				})
			});
		}.bind(this));
	},

	render: function () {
		var gallery = this.state.images.map(function (image) {
			return React.createElement('img', {
				src: MEDIA_DIR + image.full_path + '?height=100',
				onClick: this.removeImage.bind(this, image),
				className: classNames({
					pending: this.state.pending.indexOf(image) != -1,
					deleting: this.state.deleting.indexOf(image.relationship_id) != -1
				})
			});
		}.bind(this));

		return React.createElement(
			'div',
			{ id: 'galleryPost' + this.props.postId, className: 'gallery-editor' },
			React.createElement(
				'div',
				{ className: 'images' },
				gallery
			),
			React.createElement(
				'button',
				{ type: 'button', onClick: this.openLibrary, disabled: this.state.pending.length > 0 },
				'Ajouter des images'
			)
		);
	}
});

},{"classnames":1}],3:[function(require,module,exports){

var count = 0;

window.PostSingleImageChanger = React.createClass({
	displayName: 'PostSingleImageChanger',

	getInitialState() {
		return {
			image: this.props.image,
			editing: false,
			message: false
		};
	},

	cbName: null,
	componentDidMount: function () {
		this.guid = count++;
		this.cbName = this.guid + 'postImageChanger' + this.props.postId + this.props.field;
	},

	openLibrary: function () {
		if (!window[this.cbName]) window[this.cbName] = this.libraryCallback;

		openLibrary(this.cbName);
	},
	libraryCallback: function (files) {
		var file = files[0];
		var fields = {};
		fields[this.props.field] = file.id;

		this.setState({
			image: file,
			editing: true
		});

		API.updatePostFields(this.props.postId, fields).then(function () {
			this.setState({ editing: false, message: 'L\'image a bien été changée' });
		}.bind(this));
	},

	render: function () {
		var image;

		if (this.state.image) {
			var style = {};

			if (this.state.editing) style.opacity = 0.6;

			image = React.createElement('img', { src: MEDIA_DIR + this.state.image.full_path + '?height=150', style: style });
		} else image = 'Pas d\'image';

		var message = this.state.message && !this.state.editing ? React.createElement(
			'p',
			{ className: 'success-message' },
			this.state.message
		) : false;

		return React.createElement(
			'div',
			{ id: 'post-' + this.props.field + '-imageChanger' },
			image,
			message,
			React.createElement(
				'button',
				{ onClick: this.openLibrary },
				'Changer'
			)
		);
	}
});

},{}]},{},[3,2]);
