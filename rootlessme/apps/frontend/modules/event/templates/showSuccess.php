<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_place')) ?>
<?php use_stylesheet(sfConfig::get('app_css_event')) ?>
<?php slot(
  'title',
  sprintf('Rootless - Offer rides and find carpools to %s ', $event->getName()))
?>

<?php slot('gmapheader'); ?>
    <meta property="og:title" content="Rootless - Offer rides and find carpools to <?php echo $event->getName(); ?>"/>
    <meta property="og:description" content="Rootless is the carpooling solution to <?php echo $event->getName(); ?>. Find a ride or share the empty seats in your car."/>
    <script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="/js/map/<?php echo sfConfig::get('app_js_map_place'); ?>"></script>
    <script type="text/javascript" src="/js/custom-form-elements.js"></script>
    <script type="text/javascript">   
      $(document).ready(function(){

        $( ".datePicker" ).datepicker();  

        //rootless namespace that should be added to our global template
        var rootless = Rootless.getInstance({sessionId : 'showPlace'});

       //the map object
        var map = Rootless.Map.Place.getInstance({
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
    <style>
        <?php echo htmlspecialchars_decode($event->getCssStyle()); ?>
    </style>
<?php end_slot();?>
<div id="eventHead">
    <div class="eventTitleText">Share a ride to <?php echo $event->getName() ?></div>
    <div class="eventSubheading"><?php echo $event->getSubheading() ?></div>
</div>
<div id="eventContent">
    <div id="headerAndLikeBox" >
        <span class="eventContentHeader">Post a ride</span>
        <div id="facebookLikeBox" >
            <div class="fb-like" data-href="http://www.facebook.com/rootlessme" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="arial"></div>
        </div>
    </div>
    <br/>
    <div id="leftWrap" class="blackbox">
        <div id="eventRideContainer">
            <div id="eventFormBox">
                    <?php include_partial('returnTripFormAlt', array('event' => $event)) ?>
            </div>
            <div id="eventRideConfirmationContainer">
                <h2>Yay! Your ride has been posted! Now what?</h2>
    <!--            <ul id="placeCreatedRidesList">

                </ul>

                <p>Share with your friends, they might
                be heading to the mountain too!</p>
                <div id="rideShareButtonsContainer" >
                    Send Tweet
                </div>
                <p>or</p>-->
                <div id="rideOtherActionsContainer">
                    <a class="cta" href="<?php echo url_for('profile_edit_user'); ?>">Upload a photo</a>
                    <a id="confirmationPostAnotherRide" class="cta" href="#">Create another ride</a>
                </div>
            </div>
        </div>
    </div>
    <div id="rightWrap" class="blackboxSide">
        <div id="eventDetailsSection" >
            <div id="eventMapBox">
                <div id="map" >
            </div>
            <div id="mapCaption">
                <span class="strongSpan"><?php echo $event->getName() ?> |</span> <a href='<?php echo $event->getWebsiteUrl() ?>'><?php echo $event->getWebsiteUrl() ?></a>
                <br /><?php// echo $event->getLocation()->getAddressString(); ?>
            </div>
            </div>
            <div id="eventHowBox" class="helpBox">
                <h3>How it works</h3>
                <ol class="howtoList">
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
                        Head to the event together!
                    </li>
                </ol>
                <h3>Questions</h3>
                <p>
                    Feel free to email us at <a href="mailto:contact@rootless.me?Subject=Question">contact@rootless.me</a> with any questions you might have!
                </p>
            </div>
        </div>
    </div>
    <div id="loginFormDialogContainer">
        <div id="registerFormContainer">
            <?php echo get_component('sfGuardAuth', 'ajaxSigninDialog'); ?>
        </div>
    </div>
</div>
<!--
<table>
  <tbody>
    <tr>
      <th>Event:</th>
      <td><?php echo $event->getEventId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $event->getName() ?></td>
    </tr>
    <tr>
      <th>Subheading:</th>
      <td><?php echo $event->getSubheading() ?></td>
    </tr>
    <tr>
      <th>Start date:</th>
      <td><?php echo $event->getStartDate() ?></td>
    </tr>
    <tr>
      <th>End date:</th>
      <td><?php echo $event->getEndDate() ?></td>
    </tr>
    <tr>
      <th>Website url:</th>
      <td><?php echo $event->getWebsiteUrl() ?></td>
    </tr>
    <tr>
      <th>Is partner:</th>
      <td><?php echo $event->getIsPartner() ?></td>
    </tr>
    <tr>
      <th>Contact email address:</th>
      <td><?php echo $event->getContactEmailAddress() ?></td>
    </tr>
    <tr>
      <th>Contact phone number:</th>
      <td><?php echo $event->getContactPhoneNumber() ?></td>
    </tr>
    <tr>
      <th>Index image url:</th>
      <td><?php echo $event->getIndexImageUrl() ?></td>
    </tr>
    <tr>
      <th>Tags:</th>
      <td><?php echo $event->getTags() ?></td>
    </tr>
    <tr>
      <th>Css style:</th>
      <td><?php echo $event->getCssStyle() ?></td>
    </tr>
    <tr>
      <th>Is deleted:</th>
      <td><?php echo $event->getIsDeleted() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $event->getSlug() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $event->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $event->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('event/edit?event_id='.$event->getEventId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('event/index') ?>">List</a>-->
