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
            <a href="." ><img id="headerLogo" src="/images/logo.PNG" alt="RootlessMe" /></a>
            <div id="headerControls">

                <ul id="headerControlsList">
                    <li class="headerControlsListItem">
                        <form action="search.php" >
                            <input id="searchInput" />
                        </form>
                    </li>
                    <li class="headerControlsListItem"><a href="#" class="headerControl">Donate</a></li>
                    <li class="headerControlsListItem">|</li>
                    <li class="headerControlsListItem"><a href="#" class="headerControl">Inbox <img src="/images/messageSmall.JPG" alt="1 message" /></a></li>
                    <li class="headerControlsListItem">|</li>
                    <li class="headerControlsListItem">
                        <?php if ($sf_user->isAuthenticated()): ?>
                            <a href="#" class="headerControl">
                                <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlTiny(); ?>" alt="Tiny profile picture" />
                                <?php echo $sf_user->getGuardUser()->getPeople(); ?>
                                <img src="/images/menuDownArrow.JPG" alt="Profile Menu" />
                            </a>
                            <?php echo link_to('Logout', 'sf_guard_signout') ?>
                        <?php else: ?>
                            <?php echo link_to('Login', 'sf_guard_signin') ?>
                        <?php endif ?>
                    </li>
                </ul>
            </div>
        </div>

        <!-- End of header -->

        <div id="content">

            <div id="leftColumn">
                <ul id="navigation">
                    <li class="navigationItem">
                        <a href="#">
                            Dashboard
                        </a>
                    </li>
                    <li class="navigationItem">
                        <a href="<?php echo url_for("ride") ?>">
                            Rides
                        </a>
                    </li>
                    <li class="navigationItem">
                        <a href="#">
                            Events
                        </a>
                    </li>
                    <li class="navigationItemSelected">
                        <a href="<?php echo url_for("profile") ?>">
                            Travelers
                        </a>
                    </li>
                    <li class="navigationItem">
                        <a href="#">
                            Collective
                        </a>
                    </li>
                    <li class="navigationItem">
                        <a href="<?php echo url_for("conversations") ?>">
                            Messages
                        </a>
                    </li>
                </ul>
                <div id="leftContent" >
                    <?php if ($sf_user->isAuthenticated()): ?>
                    <div id="leftProfile" class="leftWidget" >
                        <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>" alt="<?php echo $sf_user->getGuardUser()->getPeople(); ?>" />
                        <h3 id="leftProfileName" class="leftWidgetTitle"><?php echo $sf_user->getGuardUser()->getPeople(); ?></h3>
                        
                        
                        <a href="#" id="leftProfileLocation" >+<?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getCity(); ?></a> <br />
                        <a href="#" id="leftProfileViewLink" >View Profile</a>
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
                    <div id="leftEvents" class="leftWidget">
                        <h3 class="leftWidgetTitle">Upcoming Events</h3>
                        <ul id="leftEventList">
                            <li class="leftEventItem">
                                <img class="leftEventDateImage" src="dateImage.JPG" alt="April 02, 2011" />
                                <div class="leftEventName">Bonnaroo</div>
                                <div class="leftEventLocation">Chicago</div>
                            </li>
                            <li class="leftEventItem">
                                <img class="leftEventDateImage" src="dateImage.JPG" alt="April 02, 2011" />
                                <div class="leftEventName">Bonnaroo</div>
                                <div class="leftEventLocation">Chicago</div>
                            </li>
                            <li class="leftEventItem">
                                <img class="leftEventDateImage" src="dateImage.JPG" alt="April 02, 2011" />
                                <div class="leftEventName">Bonnaroo</div>
                                <div class="leftEventLocation">Chicago</div>
                            </li>
                            <li class="leftEventItem">
                                <img class="leftEventDateImage" src="dateImage.JPG" alt="April 02, 2011" />
                                <div class="leftEventName">Bonnaroo</div>
                                <div class="leftEventLocation">Chicago</div>
                            </li>
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
                    <?php endif ?>
                </div>
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
