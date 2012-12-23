<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_place')) ?>


<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/map/Request.js"></script>
    <script type="text/javascript">   
      $(document).ready(function(){

        $( ".datePicker" ).datepicker();  

        //rootless namespace that should be added to our global template
        var rootless = Rootless.getInstance({sessionId : 'showPlace'});

       //the map object
        var map = Rootless.Map.Request.getInstance({
            mapId : 'map',
            el: {
                $originLatitude       : $("#rides_origin_latitude"),
                $originLongitude      : $("#rides_origin_longitude"),
                $destinationLatitude  : $("#rides_destination_latitude"),
                $destinationLongitude : $("#rides_destination_longitude")
            }
        });
        map.mapInit();
      });
    </script>

<?php end_slot();?>
<div id="placeHead">
    <h1>Share a ride to <?php echo $place->getName() ?></h1>
</div>
<div id="placeContent">
    <div id="headerAndLikeBox" >
        <span class="placeContentHeader">Post a ride</span>
        <div id="facebookLikeBox" >
            <div class="fb-like" data-href="http://rootless.me/ski" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
        </div>
    </div>
    <br/>
    
    <div id="placeFormBox">
<!--        <div id="placeRideFormContainer">-->
            <?php include_partial('returnTripForm', array('place' => $place)) ?>
<!--        </div>-->
        <div id="placeRideConfirmationContainer">

        </div>
    </div>
    <div id="placeDetailsSection" >
        <div id="placeMapBox">
            <div id="map" >
        </div>
        <div id="mapCaption">
            <?php echo $place->getName() ?> | <?php echo $place->getWebsiteUrl() ?> <br />
        </div>
        </div>
        

        <div id="placeHowBox" class="helpBox">
            <h3>How it works</h3>
            <ol>
                <li>
                    Fill out the form to the left with your ride details and post ride.
                </li>
                <li>
                    You will receive email updates when we find drivers and passengers along your route.
                </li>
                <li>
                    Once you find a driver or passenger, you will be able to negotiate on ride details until you come to an agreement.
                </li>
                <li>
                    Head to the mountain together!
                </li>
            </ol>
            <h3>Questions</h3>
            <p>
                Feel free to email us at contact@rootless.me with any questions you might have!
            </p>
        </div>
    </div>
</div>
