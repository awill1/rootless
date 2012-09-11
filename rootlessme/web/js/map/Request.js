/*
 * Request Map Class
 * @constructor Rootless.Map.Request
 * @params spec <Object> Object that holds all the variables for the maps
 * This script requires the Google Map and JQuery scripts to already be loaded
 * in the browser.
 */

Namespace('Rootless.Map.Request');

Rootless.Map.Request = Rootless.Map.extend({
	MaybeSubmitForm : function() {            
       // Check to make sure nothing is blocking submitting the form
       if (this.canSubmitForm() && this._.formBlock.isFormSubmitPending) {
            $('.newRideForm').submit();
        }
     }
    
});

Class.addSingleton(Rootless.Map.Request);