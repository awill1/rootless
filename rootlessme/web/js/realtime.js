/*
 * Constructor for radio form styling
 * jQuery is a dependency.
 * @param <jQuery Object> formElem Form being styled
 */

$(document).ready(function()
{
            
    $('#formConfirmations').hide();
    
    //Change the placeholder text in the seats field to match the user context
    $('#driveButton').click(function() {
        $('#seatsField').attr('placeholder', 'How many spare seats?');
    });
    
    $('#rideButton').click(function() {
        $('#seatsField').attr('placeholder', 'How many passengers?');
    });
    
    // Form field change event handler
    $('.formFields').change(function(){
        // Send an event to google analytics for the type of form field changed
        _gaq.push(['_trackEvent', 'specialEvent', 'changeFormField', $(this).attr('name')]);
    });
    
    //Ajax form success
    $('#specialForm').validate({
//        errorLabelContainer: $(".formError"),
        invalidHandler: function() {
            // Send an event to google analytics for the form validation error
            _gaq.push(['_trackEvent', 'specialEvent', 'validationError']);
        },
        messages: {
            name: "Enter your name. ",
            email: {
                required: "Enter your email. ",
                email: "Email must be a valid format. "
            },
            location: "Enter your location. ",
            seats: {
                required: "Enter the number of seats. ",
                digits: "The seat count must be a valid number. "
            }
        }
    });
    $('#specialForm').ajaxForm( 
        {
            beforeSubmit: function() {
                //blocking
                $("#specialForm").block({ 
                    message: '<img src="/images/ajax-loader.gif" alt="Saving..." />'
                }); 
                // Send an event to google analytics for the form submission
                _gaq.push(['_trackEvent', 'specialEvent', 'registerSubmitted']);
            },
            error: function() {
                $("#specialForm").unblock();
                // Send an event to google analytics for the form submission
                _gaq.push(['_trackEvent', 'specialEvent', 'registerError']);
            },
            // The callback function when the form was successfully submitted
            success: function() {
                $('#formConfirmations').show('blind');
                $("#specialForm").unblock();
                
                // Send an event to google analytics to show the form was submitted properly
                _gaq.push(['_trackEvent', 'specialEvent', 'registerSuccess']);
            }
        });
        
    // Change the start date and time to be pickers.
    $( ".datePicker" ).datepicker();
    $( ".timePicker" ).timepicker({ampm: true});
});