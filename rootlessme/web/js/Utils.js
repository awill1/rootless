/*
 * Rootless.StaticUtils Class
 */

Namespace('Rootless.Static.Utils');

Rootless.Static.Utils = Class.extend({
    init : function(params) {
        this._ = $.extend(true, {
            // Variables used to block form submitting before map api results are returned
            formBlock : {
                isOriginDecodePending      : false,
                isDestinationDecodePending : false,
                isDirectionsPending        : false,
                isFormSubmitPending        : false
            },
            
            formAjaxOptions : { 
                target : null,
                success: null
            }
            
        }, params);
    },
    
    /**
     * Verifies a form can be submitted and is not blocked
     * @returns bool True, if the form can be submitted. False, if the form is blocked.
     */
    canSubmitForm : function(){
        return !this._.formBlock.isOriginDecodePending && !this._.formBlock.isDestinationDecodePending && !this._.formBlock.isDirectionsPending;
    }
    
});

Class.addSingleton(Rootless.Static.Utils);



