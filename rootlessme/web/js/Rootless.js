/*
 * Rootless Constructor
 */

Namespace('Rootless');

Rootless = Class.extend({
    init : function(params) {
        this._ = $.extend(true, {
            
            
        }, params);
        
        var utils = Rootless.Static.Utils.getInstance();
    }
    
    
});

Class.addSingleton(Rootless);
