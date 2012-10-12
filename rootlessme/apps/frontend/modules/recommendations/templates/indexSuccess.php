
<script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
<script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_block_ui_script') ?>"></script>
<script type="text/javascript" >
// Function when the page is ready
$(document).ready(function(){
    // Make the forms ajax forms
    $('#findPassengersForm').ajaxForm( 
    {
        target: '#findPassengersResults',
        beforeSubmit: function() {
            // Block the form
            $('#findPassengersContainer').block();
        },
        error: function() {
            // Unblock the form
            $('#findPassengersContainer').unblock();
        },
        // The callback function when the form was successfully submitted
        success: function() {
            // Unblock the form
            $('#findPassengersContainer').unblock();
        }
    });
    $('#findDriversForm').ajaxForm( 
    {
        target: '#findDriversResults',
        beforeSubmit: function() {
            // Block the form
            $('#findDriversContainer').block();
        },
        error: function() {
            // Unblock the form
            $('#findDriversContainer').unblock();
        },
        // The callback function when the form was successfully submitted
        success: function() {
            // Unblock the form
            $('#findDriversContainer').unblock();
        }
    });
});
</script>

<h1>Recommendations test page</h1>
<div id="findPassengersContainer">
    <h2>Find Passengers</h2>
    <form id="findPassengersForm" class="searchForm" action="<?php echo url_for('recommendations_find_passengers'); ?>" method="GET" >
        <table>
            <tr>
                <td>
                    <label for="rideId">Driver Id</label>
                </td>
                <td>
                    <input type="text" name="rideId" name="rideId">
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="Submit" value="Find" /></td>
            </tr>
        </table>
    </form>
    <div id="findPassengersResults"></div>
</div>


<div id="findDriversContainer">
    <h2>Find Drivers For</h2>
    <form id="findDriversForm" class="searchForm" action="<?php echo url_for('recommendations_find_drivers'); ?>" method="GET" >
        <table>
            <tr>
                <td>
                    <label for="rideId">Passenger Id</label>
                </td>
                <td>
                    <input type="text" name="rideId" name="rideId">
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="Submit" value="Find" /></td>
            </tr>
        </table>
    </form>
    <div id="findDriversResults"></div>
</div>