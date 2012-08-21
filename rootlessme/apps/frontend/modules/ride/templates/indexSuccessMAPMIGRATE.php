<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_ride')) ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Rideboard'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_block_ui_script') ?>"></script>
    <script type="text/javascript" src="/js/RootlessMap.js"></script>

    <script type="text/javascript">   
      $(document).ready(function(){
          
        // Form submit options used for the ajax form
        var formAjaxOptions = 
        {
            target: '#results',
            success: function()
            {
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
                    function()
                    {
                        HighlightRow($(this))
                    }
                    ,function()
                    {
                        UnHighlightRow($(this))
                    }
                )
                .find('td:not(:has(:checkbox, a))')
                    .click(function () {
                    window.location = $(this).parent().find("a").attr("href");
                });
            }
        };
          
        $( ".datePicker" ).datepicker();  
        
        var rootlessMapObj = rootlessmap({mapId : 'map' });
        
        // Handler for the find button
        $('#rides_find').click(function() {
            $('#loader').show();
            $('#results').toggle('blind');
            ClearPolylinesFromMap();
        });
              
        $('#rideSearchForm').submit(function(){
            // Set the form submit flag
            isFormSubmitPending = true;
                
            // Disable the default submission. We will let AJAX do it
            MaybeSubmitForm();
            return false;
        });
        
        
        /**
         * Tries to submit the form. It will only be submitted if none of the
         * blocking flags are set.
         */
        function MaybeSubmitForm()
        {            
            // Check to make sure nothing is blocking submitting the form
            if (canSubmitForm() && isFormSubmitPending)
            {
                $('#rideSearchForm').ajaxSubmit(formAjaxOptions);
            }
        }
        
      });
    </script>
    

<?php end_slot();?>

<h1>Find a Ride</h1>
<div id="searchForm" class="middleRidesFormArea">
    <?php include_partial('rideSearchForm', array('rideSearchForm' => $searchForm)) ?>
</div>
<div id="map"></div>
<img id="loader" alt="Loading spinner" src="/images/ajax-loader.gif" style="left: 10%; position: relative; top: 75px;" />
<div id="results">
</div>