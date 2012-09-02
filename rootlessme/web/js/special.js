/*
 * Constructor for radio form styling
 * jQuery is a dependency.
 * @param <jQuery Object> formElem Form being styled
 */

$(document).ready(function()
{
    $("#backgroundImage").attr("src", "/images/patFansBackground.jpg" );
    $('#formFields').hide();
    $('#formConfirmations').hide();

    // Add the click handler for the drive and ride buttons
    $('.driveOrRide').click(function() {
        if($(this).siblings("label").hasClass('selectedLabel')) {
           $(this).siblings("label").removeClass('selectedLabel');
           $(this).siblings("label").addClass('unselectedLabel');
        }
        $(this).addClass('selectedLabel');
        $(this).siblings("label").removeClass('unselectedLabel');
        
        $('#formFields').show('blind');
        
        // Send an event to google analytics for the type of action taken
        _gaq.push(['_trackEvent', 'specialEvent', 'chooseRideType', $(this).attr('for')]);
        
    });
    
    // Form field change event handler
    $('.formFields').change(function(){
        // Send an event to google analytics for the type of form field changed
        _gaq.push(['_trackEvent', 'specialEvent', 'changeFormField', $(this).attr('name')]);
    });
    
    //Ajax form success
    $('#specialForm').validate({
        errorLabelContainer: $(".formError"),
        invalidHandler: function() {
            // Send an event to google analytics for the form validation error
            _gaq.push(['_trackEvent', 'specialEvent', 'validationError']);
        }
    });
    $('#specialForm').ajaxForm( 
        {
            beforeSubmit: function() {
                // Send an event to google analytics for the form submission
                _gaq.push(['_trackEvent', 'specialEvent', 'registerSubmitted']);
            },
            error: function() {
                // Send an event to google analytics for the form submission
                _gaq.push(['_trackEvent', 'specialEvent', 'registerError']);
            },
            // The callback function when the form was successfully submitted
            success: function() {
                $('#formConfirmations').show('blind');
                
                // Send an event to google analytics to show the form was submitted properly
                _gaq.push(['_trackEvent', 'specialEvent', 'registerSuccess']);
            }
        });
    
});