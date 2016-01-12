(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){

window.PostGalleryEditor = React.createClass({
	displayName: 'PostGalleryEditor',

	render: function () {
		var gallery = this.props.images.map(function (image) {
			return React.createElement('img', { src: MEDIA_DIR + image.full_path + '?height=100', height: '100' });
		});

		return React.createElement(
			'div',
			{ id: 'galleryPost' + this.props.postId },
			gallery
		);
	}
});

},{}],2:[function(require,module,exports){

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
	libraryCallback: function (file) {
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

			image = React.createElement('img', { src: LIBRARY_DIR + this.state.image.full_path, style: style });
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

},{}]},{},[2,1]);
