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
            <a href="<?php echo url_for('dashboard') ?>" ><img id="headerLogo" src="/images/Logo.png" alt="RootlessMe" /></a>
                <form id="headerSearchForm" action="<?php echo url_for('search') ?>" method="get" >
                      <input id="searchInput" name="query" value="Search" onblur="if (this.value == ''){this.value = 'Search';}" onfocus="if(this.value == 'Search'){this.value='';}" />
                      <input class="headerSubmit" type="submit" value="find" />
                </form>
            <div id="headerControls">
                <ul id="headerControlsList">
                    <?php if ($sf_user->isAuthenticated()): ?>
                        <?php include_component('message', 'messageMenu') ?>
                    <li class="headerControlsListItem">
                        <a href="<?php echo url_for('profile_show_user',$sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()) ?>" class="headerControl">
                            <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlTiny(); ?>" alt="Tiny profile picture" />
                            <?php echo $sf_user->getGuardUser()->getPeople(); ?>
                            <img src="/images/downArrow.png" alt="Profile Menu" />
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
                        <a class="navigationItemLink" href="<?php echo url_for("dashboard") ?>">
                            Dashboard
                        </a>
                    </li>
                    <?php endif ?>
                    <li id="navigationRides" class="navigationItem">
                        <a class="navigationItemLink" href="<?php echo url_for("ride") ?>">
                            Rides
                        </a>
                    </li>
                    <li id="navigationTravelers" class="navigationItem">
                        <a class="navigationItemLink" href="<?php echo url_for("profile") ?>">
                            Travelers
                        </a>
                    </li>
                    <?php if ($sf_user->isAuthenticated()): ?>
                    <li  id="navigationMessages" class="navigationItem">
                        <a class="navigationItemLink" href="<?php echo url_for("messages") ?>">
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
                        <br/>
                        <a href="<?php echo url_for("profile_show_user", $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst())  ?>" id="leftProfileViewLink" >View Profile</a>
                   
                    </div>
                    <div id="leftActions" class="leftWidget">
                        
                        <ul id="leftActionsList">
                            <li class="leftActionItem"><button class="leftActionButton" onClick="window.location='<?php echo url_for('ride_new', array('ride_type'=>'offer')) ?>'" >+ Offer a Ride</button></li>
                            <li class="leftActionItem"><button class="leftActionButton" onClick="window.location='<?php echo url_for('ride_new', array('ride_type'=>'request')) ?>'" >+ Request a Ride</button></li>
                        </ul>
               
                    </div>
                    <div id="leftActivity" class="leftWidget">
                        <h3 class="leftWidgetTitle">Traveling With</h3>
                        <ul id="leftActivityList">
                            <li class="leftActivityItem"><img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>" alt="<?php echo $sf_user->getGuardUser()->getPeople(); ?>" /><span class="travelingWith">Colin Hoell</span></a> <br/><a href="<?php echo url_for("profile_show_user", $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst())  ?>" id="leftProfileViewLink" >View Ride</a></li><br/>
                            <li class="leftActivityItem"><img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>" alt="<?php echo $sf_user->getGuardUser()->getPeople(); ?>" /><span class="travelingWith">Colin Hoell</span></a> <br/><a href="<?php echo url_for("profile_show_user", $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst())  ?>" id="leftProfileViewLink" >View Ride</a></li><br/>
                            <li class="leftActivityItem"><img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>" alt="<?php echo $sf_user->getGuardUser()->getPeople(); ?>" /><span class="travelingWith">Colin Hoell</span></a> <br/><a href="<?php echo url_for("profile_show_user", $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst())  ?>" id="leftProfileViewLink" >View Ride</a></li><br/>
                            <li class="leftActivityItem"><img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>" alt="<?php echo $sf_user->getGuardUser()->getPeople(); ?>" /><span class="travelingWith">Colin Hoell</span></a> <br/><a href="<?php echo url_for("profile_show_user", $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst())  ?>" id="leftProfileViewLink" >View Ride</a></li><br/>
                        </ul>
                    </div>
                </div>
                <?php endif ?>
            </div>

            <!--<div id="rightColumn"><p>This is my rightColumn</p></div> -->

            <div id="middleContent">
                <?php if ($sf_user->hasFlash('notice')): ?>
                    <div class="flash_notice">
                        <?php echo $sf_user->getFlash('notice') ?>
                    </div>
                <?php endif; ?>

                <?php if ($sf_user->hasFlash('error')): ?>
                    <div class="flash_error">
                        <?php echo $sf_user->getFlash('error') ?>
                    </div>
                <?php endif; ?>

                <?php echo $sf_content ?>
            </div>
        </div>
        <!-- Footer -->
        <div id="footer">
            <hr class="footerBar" />
            <?php echo link_to('Terms of Service', 'terms') ?>
            -
            <?php echo link_to('Privacy Policy', 'privacy') ?>
            -
            <?php echo link_to('About Us', 'about') ?>
            -
            <?php echo link_to('Contact Us', 'contact') ?>
            -
            <?php echo link_to('Safety Tips', 'safety') ?>
            -
            <?php echo link_to('Help', 'help') ?>
            <br />
            &copy;2011 Star Banana, LLC. All rights reserved.
        </div>
        <!-- End of footer -->

    </div>
  </body>
</html>
