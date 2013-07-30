/*
 * Rootless Admin Constructor
 */

Namespace('Rootless.Admin');

Rootless.Admin = Class.extend({
    init : function(params) {
        this._ = $.extend(true, {
        }, params);
        alert("JS is hooked up!");
    }
    
    
});

Class.addSingleton(Rootless);
