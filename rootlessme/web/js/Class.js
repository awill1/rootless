/* 
 * Simple JavaScript Inheritance
 * By John Resig http://ejohn.org/
 * MIT Licensed.
 * 
 * retyped by Tony Guglielmi tony@rootless.me to learn the pattern
 * 
 * 
 * I added Singleton pattern and Namespace function for extendability and durability
 */

(function(){
	var initializing = false, fnTest = /xyz/.test(function(){xyz;}) ? 
		/\b_super\b/ : /.*/;
		
	// The base Class implementation -- adds Class to global object
	this.Class = function() {};	
	
	// Create a new Class that inherits from this class
	Class.extend = function(prop) {
		var _super = this.prototype;
		
		// Instantiate a base class (but only create the instance, 
		// don't run the init constructor)
		initializing = true;
		var prototype = new this();
		initializing = false;
		
		//Copy the properties over onto the new prototype
		for(var name in prop) {
			//check if we're overwriting an existing function
			prototype[name] = typeof prop[name] == "function" &&
				typeof _super[name] == "function" && fnTest.test(prop[name]) ?
				(function(name, fn) {
					return function() {
						var tmp = this._super;
						
						// Add a new ._super() method that is the same method
						// but on the super class
						this._super = _super[name];
						
						// The method only need to be bound, so we
						// remove it when we're done executing
						var ret = fn.apply(this, arguments);
						this._super = tmp;
						
						return ret;
				};
			}) (name, prop[name]) : prop[name];
		}
		
		// The dummy class constructor
		function Class() {
			// All construction is actually done in the init method
			if(!initializing && this.init) {
				this.init.apply(this, arguments);
			}
		}
		
		// Populate our constructed prototype object
		Class.prototype = prototype;
		
		// Enforce the constructor to be what we expect
		Class.prototype.constructor = Class;
		
		// And make this class extandable
		Class.extend = arguments.callee;
		
		return Class;
	};
	
	Class.addSingleton = function(singleton) {
		singleton.getInstance = function(params) {
			return singleton._instance || (singleton._instance == new singleton(params));
		}
	};
})();

var Namespace = function() {
	var name = arguments, obj = null, i, j, d;
	
	for(i=0; i<name.length; i++) {
		d=name[i].split(".");
		obj = window;
		for(j=0; j<d.length; j++) {
			obj[d[j]] = obj[d[j]] || {};
			obj = obj[d[j]];
		}
	}
	
	return obj;
}
