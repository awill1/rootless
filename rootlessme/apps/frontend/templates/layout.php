<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
      <title>
          <?php if (!include_slot('title')): ?>
            Rootless Me - Share your ride.
          <?php endif; ?>
      </title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_javascript(sfConfig::get('app_jquery_script')) ?>
    <?php use_javascript(sfConfig::get('app_jquery_ui_script')) ?>
    <?php use_javascript('jquery-ui-timepicker-addon.js') ?>
    <?php use_stylesheet(sfConfig::get('app_jquery_ui_stylesheet')) ?>
    <?php use_javascript('headerMenu') ?>
    <?php use_javascript('navigation') ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php if (has_slot('gmapheader')): ?>
        <?php include_slot('gmapheader') ?>
    <?php endif; ?>

  </head>
  <body>
      <div id="container">

        <!-- Header -->
        <div id="header">
            <a href="<?php echo url_for('home') ?>" ><img id="headerLogo" src="/images/logo.PNG" alt="RootlessMe" /></a>
            <div id="headerControls">

                <ul id="headerControlsList">
                    <li class="headerControlsListItem">
                        <form action="search.php" >
                            <input id="searchInput" />
                        </form>
                    </li>
                    <li class="headerControlsListItem"><a href="#" class="headerControl">Donate</a></li>
                    <?php if ($sf_user->isAuthenticated()): ?>
                        <?php include_component('message', 'messageMenu') ?>
                    <li class="headerControlsListItem">
                        <a href="<?php echo url_for('profile_show_user',$sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()) ?>" class="headerControl">
                            <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlTiny(); ?>" alt="Tiny profile picture" />
                            <?php echo $sf_user->getGuardUser()->getPeople(); ?>
                            <img src="/images/menuDownArrow.JPG" alt="Profile Menu" />
                        </a>
                        <ul class="headerControlsListSublist">
                            <li class="headerControlsListSublistItem">
                                <a class="headerSublistControl" href="<?php echo url_for('profile_edit_user') ?>">
                                    Settings
                                </a>
                            </li>
                            <li class="headerControlsListSublistItem">
                                <a class="headerSublistControl" href="<?php echo url_for('sf_guard_signout') ?>">
                                    Sign out
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="headerControlsListItem">
                        <a class="headerControl" href="<?php echo url_for('sf_guard_signin') ?>">
                            Log in
                        </a>
                    </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>

        <!-- End of header -->

        <div id="content">

            <div id="leftColumn">
                <ul id="navigation">
                    <?php if ($sf_user->isAuthenticated()): ?>
                    <li id="navigationDashboard" class="navigationItem">
                        <a href="#">
                            Dashboard
                        </a>
                    </li>
                    <?php endif ?>
                    <li id="navigationRides" class="navigationItem">
                        <a href="<?php echo url_for("ride") ?>">
                            Rides
                        </a>
                    </li>
                    <li id="navigationTravelers" class="navigationItem">
                        <a href="<?php echo url_for("profile") ?>">
                            Travelers
                        </a>
                    </li>
                    <?php if ($sf_user->isAuthenticated()): ?>
                    <li  id="navigationMessages" class="navigationItem">
                        <a href="<?php echo url_for("conversations") ?>">
                            Messages
                        </a>
                    </li>
                    <?php endif ?>
                </ul>
                <?php if ($sf_user->isAuthenticated()): ?>
                <div id="leftContent" >
                    <div id="leftProfile" class="leftWidget" >
                        <a href="<?php echo url_for("profile_show_user", $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst())  ?>">
                            <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>" alt="<?php echo $sf_user->getGuardUser()->getPeople(); ?>" />
                        </a>
                        <h3 id="leftProfileName" class="leftWidgetTitle"><?php echo $sf_user->getGuardUser()->getPeople(); ?></h3>
                        
                        
                        <a href="#" id="leftProfileLocation" >+<?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getCity(); ?></a> <br />
                        <a href="<?php echo url_for("profile_show_user", $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst())  ?>" id="leftProfileViewLink" >View Profile</a>
                    </div>
                    <div id="leftActions" class="leftWidget">
                        <ul id="leftActionsList">
                            <li class="leftActionItem"><button class="leftActionButton" >+ Create an Event</button></li>
                            <li class="leftActionItem"><button class="leftActionButton" onClick="window.location='<?php echo url_for('ride_offer_new') ?>'" >+ Offer a Ride</button></li>
                            <li class="leftActionItem"><button class="leftActionButton" >+ Request a Ride</button></li>
                        </ul>
                    </div>
                    <div id="leftActivity" class="leftWidget">
                        <h3 class="leftWidgetTitle">Recent Activity</h3>
                        <ul id="leftActivityList">
                            <li class="leftActivityItem">You and <a href="#" class="leftActivityLink">Colin Hoell</a> are attending <a href="#" class="leftActivityLink">Bonnaroo</a>.</li>
                            <li class="leftActivityItem"><a href="#" class="leftActivityLink">Janet Dickenson</a> left a testimonial on your <a href="#" class="leftActivityLink">profile.</a></li>
                            <li class="leftActivityItem">You and <a href="#" class="leftActivityLink">Colin Hoell</a> are attending <a href="#" class="leftActivityLink">Bonnaroo</a>.</li>
                            <li class="leftActivityItem"><a href="#" class="leftActivityLink">Janet Dickenson</a> left a testimonial on your <a href="#" class="leftActivityLink">profile.</a></li>
                            <li class="leftActivityItem">You and <a href="#" class="leftActivityLink">Colin Hoell</a> are attending <a href="#" class="leftActivityLink">Bonnaroo</a>.</li>
                            <li class="leftActivityItem"><a href="#" class="leftActivityLink">Janet Dickenson</a> left a testimonial on your <a href="#" class="leftActivityLink">profile.</a></li>
                        </ul>
                    </div>
                    <div id="leftRides" class="leftWidget">
                        <h3 class="leftWidgetTitle">Upcoming Rides</h3>
                        <ul id="leftRideList">
                            <li class="leftRideItem">
                                <img class="leftRideDateImage" src="dateImage.JPG" alt="April 02, 2011" />
                                <div class="leftRideName">Bonnaroo</div>
                                <div class="leftRideLocation">Chicago</div>
                            </li>
                            <li class="leftRideItem">
                                <img class="leftRideDateImage" src="dateImage.JPG" alt="April 02, 2011" />
                                <div class="leftRideName">Bonnaroo</div>
                                <div class="leftRideLocation">Chicago</div>
                            </li>
                            <li class="leftRideItem">
                                <img class="leftRideDateImage" src="dateImage.JPG" alt="April 02, 2011" />
                                <div class="leftRideName">Bonnaroo</div>
                                <div class="leftRideLocation">Chicago</div>
                            </li>
                            <li class="leftRideItem">
                                <img class="leftRideDateImage" src="dateImage.JPG" alt="April 02, 2011" />
                                <div class="leftRideName">Bonnaroo</div>
                                <div class="leftRideLocation">Chicago</div>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php endif ?>
            </div>

            <!--<div id="rightColumn"><p>This is my rightColumn</p></div> -->

            <div id="middleContent">
                    <?php echo $sf_content ?>
            </div>
        </div>
        <!-- Footer -->
        <div id="footer">
            <hr class="footerBar" />
            &copy;2011 Star Banana, LLC. All rights reserved.
        </div>
        <!-- End of footer -->

    </div>
  </body>
</html>
