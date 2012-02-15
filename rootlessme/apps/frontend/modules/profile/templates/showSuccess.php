<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet('profile.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - %s', $profile->getFullName()))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/googleMapHelpers.js"></script>
    <script type="text/javascript">
        var map = null;

        // Function when the page is ready
        $(document).ready(function(){
            // Make the tabs
            $( "#middleProfileDetails" ).tabs();
            
            // Create the Google Map
            map = initializeGoogleMap("travelMap");
            
            // Add the past ride polylines
            $('.pastRidePolyline').each(function(index) {
                var encodedPolyline = $(this).text();
                // Load the polylines into the google map
                displayEncodedPolyline(map, encodedPolyline, true);
            });

            // Bind to the tabsshow event to resize the google map
            // This necessary work around is a side effect of the jquery ui
            // tabs. See
            // http://stackoverflow.com/questions/1428178/problems-with-google-maps-api-v3-jquery-ui-tabs
            $('#middleProfileDetails').bind('tabsshow', function(event, ui) {
                if (ui.panel.id == "fragment-travel_log") {
                    // Resize the map to fit the div size
                    google.maps.event.trigger(map, 'resize');
                    // Center the map
                    var mapCenter = new google.maps.LatLng(MAP_DEFAULT_LATITUDE, MAP_DEFAULT_LONGITUDE);
                    map.setCenter(mapCenter);
                }
            });
        });
    </script>
<?php end_slot();?>
    
<div id="ProfileTopInfo">
        <h1 id="mainProfileTitle">
            <?php echo $profile->getFullName() ?>
            <?php if ($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getPersonId() == $profile->getPersonId()): ?>
                <a id="mainProfileTitleEditLink" href="<?php echo url_for('profile_edit_user') ?>">Edit&nbsp;Profile</a>
            <?php endif ?>     
        </h1>
        <a id="mainProfileSubtitle" href="<?php echo $profile->getWebsiteUrl() ?>"><?php echo $profile->getWebsiteUrl() ?></a>
    <h2><?php echo $profile->getAge() ?> year old <?php echo $profile->getGender() ?> from
             <a id="mainProfileLocationLink" href="#" class="locationLink">+<?php echo $profile->getCity() ?></a></h2>
    <p>
        <?php echo $profile->getAboutMe() ?>
    </p>
    <h3 id="middleTop5">Top 5</h3>
    <p><?php  echo $profile->getTop5() ?></p>
    <span id="whereYouWannaGo"><?php echo $profile->getFirstName() ?> wants to go to <a href="#" class="locationLink"><?php echo $profile->getWantsToTravelTo()?></a></span>
</div>
<div id="middleProfileBadge">
    <?php if(preg_match('/.*\.edu$/',$profile->getPeople()->getSfGuardUser()->getEmailAddress())) : ?>
        <div id="studentVer">
            <img src="/images/check.png" alt="Verified Student" />
            Verified Student
        </div>
    <?php endif ?>
    <a href id="messageButtonLink">+ Message</a><br />
    <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $profile->getPictureUrlLarge() ?>" alt="<?php echo $profile->getFullName() ?> profile picture"/>
    <div class="middleProfileBadgeInfo">
        Rides Given <strong><?php echo $travelSummary['ridesGiven'] ?></strong>
        Rides Received <strong><?php echo $travelSummary['ridesReceived'] ?></strong>
        </div>
</div>
   
<div id="profileDivider"><hr /></div>    
    

<div id="middleProfileDetails" class='profilePage'>
    <ul class="tabList">
        <li class="tabSelectedItem"><a href="#fragment-feedback">Feedback</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-travel_log">Travel Log</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-interests">Interests</a></li>
       
    </ul>
    <div id="fragment-feedback" class="middleProfileTabContent">

        <div id="testimonialsArea">
            <h3>Testimonials</h3>
            <hr />
            <?php include_component('review', 'reviews', array('profile_name' => $profile->getProfileName())) ?>  
        </div>
        <div id="reviewsArea">
            <?php include_partial('review/ratingGraphs', array('ratings' => $ratings)) ?>
        </div>
    </div>
    <div id="fragment-travel_log" class="middleProfileTabContent">
        <div id="travelMapArea" >
            <div id="travelMap" ></div>
            <div id="travelMapAreaTextCont">
                 <span class="travelmapCaption">
                     <?php echo number_format($milesTraveled) ?> miles traveled
                 </span>
            </div>
            <ul class="hidden">
                <?php foreach ($travelHistories as $pastRide) : ?>
                <li class="pastRidePolyline"><?php echo $pastRide->getRoutes()->getEncodedPolyline(); ?></li>
                <?php endforeach ; ?>
            </ul>
        </div>
        <div id="carInfoArea">
            <h3>Car Info</h3>
            <p>
                <img src="/images/caricon.png" alt="car" />
                <?php echo $profile->getFirstName() ?>
                drives a <?php echo $vehicle ?>.
            </p>
        </div>
    </div>
    <div id="fragment-interests" class="middleProfileTabContent">
        <div id="interestsArea">
            <div class="middleProfileTabContentLeftColumn">
                <h3>Places you want to go</h3>
                <p>
                    <?php echo $profile->getWantsToTravelTo()?>
                </p>
                <h3>Music</h3>
                <p>
                    <?php echo $profile->getMusic() ?>
                </p>
                <h3>Movies</h3>
                <p>
                    <?php echo $profile->getMovies() ?>
                </p>
            </div>
            <div class="middleProfileTabContentRightColumn">
                <h3>Books</h3>
                <p>
                    <?php echo $profile->getBooks() ?>
                </p>
                <h3>Interests</h3>
                <p>
                    <?php echo $profile->getInterests() ?>
                </p>
                <h3>Favorite Websites</h3>
                <p>
                    <?php echo $profile->getFavoriteWebsites() ?>
                </p>
            </div>
        </div>
    </div>
</div>
