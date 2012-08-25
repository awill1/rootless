/*
 * Rootless Constructor
 */

Namespace('Rootless');

Rootless = Class.extend({
    init : function(params) {
        this._ = $.extend(true, {
            
            
        }, params);
    }
    
    
});

Class.addSingleton(Rootless);
