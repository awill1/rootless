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
    
    $('.driveOrRide').click(function() {
        //alert("click");
        if($(this).siblings("label").hasClass('selectedLabel')) {
           $(this).siblings("label").removeClass('selectedLabel');
           $(this).siblings("label").addClass('unselectedLabel');
        }
        $(this).addClass('selectedLabel');
        $(this).siblings("label").removeClass('unselectedLabel');
        
        $('#formFields').show('blind');
        
    });
    
//    $("#formSubmit").click(function() {
//        //return false;
//    });
//    
    //Ajax form success
    $('#specialForm').validate({
                errorLabelContainer: $(".formError")
    });
    $('#specialForm').ajaxForm( 
        {
            // The resulting html should be sent to the test div
            //target: '#formConirmations',
            // The callback function when the form was successfully submitted
            success: function() {
                $('#formConfirmations').show('blind');  
            }
        });
    
});
    