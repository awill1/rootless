/*
 * Rootless.StaticUtils Class
 */

Namespace('Rootless.StaticUtils');

Rootless.StaticUtils = Class.extend({
    init : function(params) {
        this._ = $.extend(true, {
            // Variables used to block form submitting before map api results are returned
            formBlock : {
                isOriginDecodePending      : false,
                isDestinationDecodePending : false,
                isDirectionsPending        : false,
                isFormSubmitPending        : false
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
   /* 
    formAjaxOptions : function() { 
        target: '#results',
        success: function() {
            // Clear the form submit pending flag
            isFormSubmitPending = false;

            // This handler function will run when the form is complete
            $('#loader').hide();
            $('#results').show('blind');

            // Add the results to the google map
            LoadItemsIntoGoogleMap();

            // Change the hover style
            $("#rideTable tbody tr")
                .hover(
                    function() {
                        HighlightRow($(this))
                    }, function(){
                        UnHighlightRow($(this))
                    }
                )
                .find('td:not(:has(:checkbox, a))')
                    .click(function () {
                    window.location = $(this).parent().find("a").attr("href");
                });
            }
        }*/

    
});

Class.addSingleton(Rootless.StaticUtils);



