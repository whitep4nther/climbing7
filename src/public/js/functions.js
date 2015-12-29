var withArgs = function(fn, args) {
    var partial = function() {
            return fn.apply(this, args);
        };
    partial.prototype = Object.create(Function.prototype);
    return partial;
};