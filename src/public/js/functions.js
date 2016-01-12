var withArgs = function(fn, args) {
    var partial = function() {
            return fn.apply(this, args);
        };
    partial.prototype = Object.create(Function.prototype);
    return partial;
};

var getQueryParams = function () {
    var match,
        pl     = /\+/g,  // Regex for replacing addition symbol with a space
        search = /([^&=]+)=?([^&]*)/g,
        decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
        query  = window.location.search.substring(1);

    urlParams = {};
    while (match = search.exec(query))
       urlParams[decode(match[1])] = decode(match[2]);
   return urlParams;
};

var openLibrary = function (callback, multiple) {
	window.open(ROOT + '/library?callback='+callback, 'Librairie', 'width=1200, height=600, left=500, top=300');
};