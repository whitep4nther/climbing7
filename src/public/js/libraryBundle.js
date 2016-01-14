(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
// Copyright Joyent, Inc. and other Node contributors.
//
// Permission is hereby granted, free of charge, to any person obtaining a
// copy of this software and associated documentation files (the
// "Software"), to deal in the Software without restriction, including
// without limitation the rights to use, copy, modify, merge, publish,
// distribute, sublicense, and/or sell copies of the Software, and to permit
// persons to whom the Software is furnished to do so, subject to the
// following conditions:
//
// The above copyright notice and this permission notice shall be included
// in all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
// OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
// NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
// DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
// OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
// USE OR OTHER DEALINGS IN THE SOFTWARE.

function EventEmitter() {
  this._events = this._events || {};
  this._maxListeners = this._maxListeners || undefined;
}
module.exports = EventEmitter;

// Backwards-compat with node 0.10.x
EventEmitter.EventEmitter = EventEmitter;

EventEmitter.prototype._events = undefined;
EventEmitter.prototype._maxListeners = undefined;

// By default EventEmitters will print a warning if more than 10 listeners are
// added to it. This is a useful default which helps finding memory leaks.
EventEmitter.defaultMaxListeners = 10;

// Obviously not all Emitters should be limited to 10. This function allows
// that to be increased. Set to zero for unlimited.
EventEmitter.prototype.setMaxListeners = function(n) {
  if (!isNumber(n) || n < 0 || isNaN(n))
    throw TypeError('n must be a positive number');
  this._maxListeners = n;
  return this;
};

EventEmitter.prototype.emit = function(type) {
  var er, handler, len, args, i, listeners;

  if (!this._events)
    this._events = {};

  // If there is no 'error' event listener then throw.
  if (type === 'error') {
    if (!this._events.error ||
        (isObject(this._events.error) && !this._events.error.length)) {
      er = arguments[1];
      if (er instanceof Error) {
        throw er; // Unhandled 'error' event
      }
      throw TypeError('Uncaught, unspecified "error" event.');
    }
  }

  handler = this._events[type];

  if (isUndefined(handler))
    return false;

  if (isFunction(handler)) {
    switch (arguments.length) {
      // fast cases
      case 1:
        handler.call(this);
        break;
      case 2:
        handler.call(this, arguments[1]);
        break;
      case 3:
        handler.call(this, arguments[1], arguments[2]);
        break;
      // slower
      default:
        args = Array.prototype.slice.call(arguments, 1);
        handler.apply(this, args);
    }
  } else if (isObject(handler)) {
    args = Array.prototype.slice.call(arguments, 1);
    listeners = handler.slice();
    len = listeners.length;
    for (i = 0; i < len; i++)
      listeners[i].apply(this, args);
  }

  return true;
};

EventEmitter.prototype.addListener = function(type, listener) {
  var m;

  if (!isFunction(listener))
    throw TypeError('listener must be a function');

  if (!this._events)
    this._events = {};

  // To avoid recursion in the case that type === "newListener"! Before
  // adding it to the listeners, first emit "newListener".
  if (this._events.newListener)
    this.emit('newListener', type,
              isFunction(listener.listener) ?
              listener.listener : listener);

  if (!this._events[type])
    // Optimize the case of one listener. Don't need the extra array object.
    this._events[type] = listener;
  else if (isObject(this._events[type]))
    // If we've already got an array, just append.
    this._events[type].push(listener);
  else
    // Adding the second element, need to change to array.
    this._events[type] = [this._events[type], listener];

  // Check for listener leak
  if (isObject(this._events[type]) && !this._events[type].warned) {
    if (!isUndefined(this._maxListeners)) {
      m = this._maxListeners;
    } else {
      m = EventEmitter.defaultMaxListeners;
    }

    if (m && m > 0 && this._events[type].length > m) {
      this._events[type].warned = true;
      console.error('(node) warning: possible EventEmitter memory ' +
                    'leak detected. %d listeners added. ' +
                    'Use emitter.setMaxListeners() to increase limit.',
                    this._events[type].length);
      if (typeof console.trace === 'function') {
        // not supported in IE 10
        console.trace();
      }
    }
  }

  return this;
};

EventEmitter.prototype.on = EventEmitter.prototype.addListener;

EventEmitter.prototype.once = function(type, listener) {
  if (!isFunction(listener))
    throw TypeError('listener must be a function');

  var fired = false;

  function g() {
    this.removeListener(type, g);

    if (!fired) {
      fired = true;
      listener.apply(this, arguments);
    }
  }

  g.listener = listener;
  this.on(type, g);

  return this;
};

// emits a 'removeListener' event iff the listener was removed
EventEmitter.prototype.removeListener = function(type, listener) {
  var list, position, length, i;

  if (!isFunction(listener))
    throw TypeError('listener must be a function');

  if (!this._events || !this._events[type])
    return this;

  list = this._events[type];
  length = list.length;
  position = -1;

  if (list === listener ||
      (isFunction(list.listener) && list.listener === listener)) {
    delete this._events[type];
    if (this._events.removeListener)
      this.emit('removeListener', type, listener);

  } else if (isObject(list)) {
    for (i = length; i-- > 0;) {
      if (list[i] === listener ||
          (list[i].listener && list[i].listener === listener)) {
        position = i;
        break;
      }
    }

    if (position < 0)
      return this;

    if (list.length === 1) {
      list.length = 0;
      delete this._events[type];
    } else {
      list.splice(position, 1);
    }

    if (this._events.removeListener)
      this.emit('removeListener', type, listener);
  }

  return this;
};

EventEmitter.prototype.removeAllListeners = function(type) {
  var key, listeners;

  if (!this._events)
    return this;

  // not listening for removeListener, no need to emit
  if (!this._events.removeListener) {
    if (arguments.length === 0)
      this._events = {};
    else if (this._events[type])
      delete this._events[type];
    return this;
  }

  // emit removeListener for all listeners on all events
  if (arguments.length === 0) {
    for (key in this._events) {
      if (key === 'removeListener') continue;
      this.removeAllListeners(key);
    }
    this.removeAllListeners('removeListener');
    this._events = {};
    return this;
  }

  listeners = this._events[type];

  if (isFunction(listeners)) {
    this.removeListener(type, listeners);
  } else if (listeners) {
    // LIFO order
    while (listeners.length)
      this.removeListener(type, listeners[listeners.length - 1]);
  }
  delete this._events[type];

  return this;
};

EventEmitter.prototype.listeners = function(type) {
  var ret;
  if (!this._events || !this._events[type])
    ret = [];
  else if (isFunction(this._events[type]))
    ret = [this._events[type]];
  else
    ret = this._events[type].slice();
  return ret;
};

EventEmitter.prototype.listenerCount = function(type) {
  if (this._events) {
    var evlistener = this._events[type];

    if (isFunction(evlistener))
      return 1;
    else if (evlistener)
      return evlistener.length;
  }
  return 0;
};

EventEmitter.listenerCount = function(emitter, type) {
  return emitter.listenerCount(type);
};

function isFunction(arg) {
  return typeof arg === 'function';
}

function isNumber(arg) {
  return typeof arg === 'number';
}

function isObject(arg) {
  return typeof arg === 'object' && arg !== null;
}

function isUndefined(arg) {
  return arg === void 0;
}

},{}],2:[function(require,module,exports){
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

},{}],3:[function(require,module,exports){

module.exports = new (require('events'))();

},{"events":1}],4:[function(require,module,exports){

var Dispatcher = require('../Dispatcher'),
    ActionsTypes = require('./');

module.exports = {

	navigateToFolder: function (folderId) {
		API.getFolderContents(folderId).then(function (folder) {
			Dispatcher.emit(ActionsTypes.NAVIGATE_TO_FOLDER, folder);
		}.bind(this));
	},

	clickedFile: function (file) {
		Dispatcher.emit(ActionsTypes.CLICKED_FILE, file);
	}

};

},{"../Dispatcher":3,"./":5}],5:[function(require,module,exports){

module.exports = {
	NAVIGATE_TO_FOLDER: 'NAVIGATE_TO_FOLDER',
	CLICKED_FILE: 'CLICKED_FILE'
};

},{}],6:[function(require,module,exports){
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

},{}],7:[function(require,module,exports){

var Dispatcher = require('../Dispatcher'),
    DispatcherSubscriberMixin = require('../mixins/EventsSubscriberMixin')(Dispatcher),
    ActionsTypes = require('../actions'),
    ActionsCreator = require('../actions/ActionsCreator');

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

	mixins: [DispatcherSubscriberMixin],

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
		this.subscribeToEvent(ActionsTypes.NAVIGATE_TO_FOLDER, function (folder) {
			this.setState({
				breadcrumbs: _updateBreadcrumbs(this.state.breadcrumbs, folder.folder),
				windowItems: folder.content
			});
		}.bind(this));

		this.subscribeToEvent(ActionsTypes.CLICKED_FILE, this.toggleSelectedFile);

		var queryParams = getQueryParams();

		if (queryParams['callback']) this._callbackSelectionDone = queryParams['callback'];

		API.getFolders().then(function (json) {
			this.setState({
				navigatorItems: json
			});
		}.bind(this));

		ActionsCreator.navigateToFolder(27);
		// this.loadFolder({id: 27});
	},

	currentFolder: function () {
		return this.state.breadcrumbs[this.state.breadcrumbs.length - 1];
	},
	currentFolderId: function () {
		var folder = this.currentFolder();
		return folder ? folder.id : 0;
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
				{ className: 'breadcrumb', onClick: ActionsCreator.navigateToFolder.bind(ActionsCreator, crumb.id) },
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
					React.createElement(ItemList, { item: WindowItem, data: this.state.windowItems, pass: { isSelected: this.isFileSelected } })
				)
			)
		);
	}
});

},{"../Dispatcher":3,"../actions":5,"../actions/ActionsCreator":4,"../mixins/EventsSubscriberMixin":10,"./ItemList.jsx":6,"./NavigatorItem.jsx":8,"./WindowItem.jsx":9}],8:[function(require,module,exports){

var ActionsCreator = require('../actions/ActionsCreator');

var NavigatorItem = React.createClass({
	displayName: "NavigatorItem",

	render: function () {
		return React.createElement(
			"div",
			{ className: "navigatorItem", onClick: ActionsCreator.navigateToFolder.bind(ActionsCreator, this.props.data.id) },
			this.props.data.title
		);
	}
});

module.exports = NavigatorItem;

},{"../actions/ActionsCreator":4}],9:[function(require,module,exports){

var ActionsCreator = require('../actions/ActionsCreator');

var classNames = require('classnames');

var WindowItem = React.createClass({
	displayName: 'WindowItem',

	click() {
		if (this.props.data.type == 'folder') ActionsCreator.navigateToFolder(this.props.data.id);else ActionsCreator.clickedFile(this.props.data);
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

},{"../actions/ActionsCreator":4,"classnames":2}],10:[function(require,module,exports){

function EventsSubscriberMixin(eventEmitter) {

	return {
		componentWillMount: function () {
			this.subscribedEvents = [];
		},

		subscribeToEvent: function (event, listener) {
			this.subscribedEvents.push({ event: event, listener: listener });
			eventEmitter.on(event, listener);
		},

		componentWillUnmount: function () {
			for (var i = 0; i < this.subscribedEvents.length; i++) {
				eventEmitter.removeListener(this.subscribedEvents[i].event, this.subscribedEvents[i].listener);
			}
		}
	};
};

module.exports = EventsSubscriberMixin;

},{}]},{},[7]);
