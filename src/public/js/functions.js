Function.prototype.arg = function() {
    if (typeof this !== "function")
        throw new TypeError("Function.prototype.arg needs to be called on a function");
    var slice = Array.prototype.slice,
        args = slice.call(arguments), 
        fn = this, 
        partial = function() {
            return fn.apply(this, args.concat(slice.call(arguments)));
//                          ^^^^
        };
    partial.prototype = Object.create(Function.prototype);
    return partial;
};