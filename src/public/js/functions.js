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

Array.prototype.indexOfFn = function (value, fn) {
    for (var i = 0; i < this.length; i++) {
        console.log(this[i], value);
        if (fn(this[i], value))
            return i;
    }
    return false;
};

var openLibrary = function (callback, multiple) {
    if (multiple)
        multiple = '1';
    else
        multiple = '0';
	window.open(ROOT + '/library?callback='+callback+'&multiple='+multiple, 'Librairie', 'width=1200, height=600, left=500, top=300');
};