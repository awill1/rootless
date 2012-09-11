/*
 * Rootless.StaticUtils Class
 */

Namespace('Rootless.Static.Utils');

Rootless.Static.Utils = Class.extend({
    init : function(params) {
        this._ = $.extend(true, {
            
            formAjaxOptions : { 
                target : null,
                success: null
            }
            
        }, params);
    }
    
    
});

Class.addSingleton(Rootless.Static.Utils);



