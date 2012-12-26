<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://ogp.me/ns/fb#">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
      <title>
          <?php if (!include_slot('title')): ?>
            Rootless - Share your ride or find a carpool.
          <?php endif; ?>
      </title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_stylesheet(sfConfig::get('app_css_place')) ?>
    <?php use_stylesheet(sfConfig::get('app_css_main')) ?>
    
    <?php use_javascript(sfConfig::get('app_jquery_script')) ?>
    <?php use_javascript(sfConfig::get('app_jquery_ui_script')) ?>
    <?php use_javascript(sfConfig::get('app_jquery_ui_timepicker_script')) ?>
    <?php use_stylesheet(sfConfig::get('app_jquery_ui_stylesheet')) ?>
    <?php use_javascript(sfConfig::get('app_jquery_validation_script')) ?>
    <?php use_javascript(sfConfig::get('app_jquery_block_ui_script')) ?>
    <?php use_javascript(url_for('sf_routes_js')) ?>
    <?php use_javascript(sfConfig::get('app_jquery_facebook_script')) ?>
    <?php use_javascript(sfConfig::get('app_js_header_menu')) ?>
    <?php use_javascript(sfConfig::get('app_js_navigation')) ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <script type="text/javascript" src="/js/Class.js"></script>
    <script type="text/javascript" src="/js/Rootless.js"></script>
    <?php if (has_slot('gmapheader')): ?>
    	<link type="text/css" href="/css/tipsy.css" rel="stylesheet">
    	<script type="text/javascript" src="/js/ext/jquery.tipsy.js"></script>
        <script type="text/javascript" src="/js/Map.js"></script>
        <?php include_slot('gmapheader') ?>
    <?php endif; ?>
    
    <?php if (has_slot('nomapheader')): ?>
    	<?php include_slot('nomapheader') ?>
    <?php endif; ?>
    <!-- Google Analytics Javascript -->
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-27564018-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
  </head>
  <body>
        <!-- Start Facebook javascript sdk -->
        <div id="fb-root"></div>
        <script>
        window.fbAsyncInit = function() {
            FB.init({
            appId      : <?php echo sfConfig::get('app_facebook_app_id') ?>, // App ID
            channelUrl : '<?php echo public_path(sfConfig::get('app_facebook_channel_path'), true); ?>', // Channel File
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml      : true  // parse XFBML
            });

            // Additional initialization code here
            initClientFacebook();
        };

        // Load the SDK Asynchronously
        (function(d){
            var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement('script'); js.id = id; js.async = true;
            js.src = "//connect.facebook.net/en_US/all.js";
            ref.parentNode.insertBefore(js, ref);
        }(document));
        </script>
        <!-- End Facebook javascript sdk -->
<!--        <div id="backgroundContainer">backgroundImg</div>-->
      <div id="container">
          
        <!-- Header -->
        <div id="header">
            <a href="<?php if ($sf_user->isAuthenticated()) { echo url_for('dashboard');} else  {echo url_for('home');}  ?>" ><img id="headerLogo" src="/images/Logo.png" alt="Rootless" /></a>
                <form id="headerSearchForm" action="<?php echo url_for('search') ?>" method="get" >
                      <input id="searchInput" name="query" value="Search Users" onblur="if (this.value == ''){this.value = 'Search Users';}" onfocus="if(this.value == 'Search Users'){this.value='';}" />
                      <input class="headerSubmit" type="submit" value="find" />
                </form>
            <div id="headerControls">
                <ul id="headerControlsList">
                    <?php if ($sf_user->isAuthenticated()): ?>
                        <?php include_component('message', 'messageMenu') ?>
                    <li class="headerControlsListItem">
                        <a href="<?php echo url_for('profile_show_user',$sf_user->getGuardUser()->getPeople()->getProfiles()) ?>" class="headerControl">
                            <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getPictureUrlTiny(); ?>" alt="<?php echo $sf_user->getGuardUser()->getPeople(); ?>" />
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
                            dashboard
                        </a>
                    </li>
                    <?php endif ?>
                    <li id="navigationRides" class="navigationItem">
                        <a class="navigationItemLink" href="<?php echo url_for("ride") ?>">
                            rides
                        </a>
                    </li>
                    <li id="navigationTravelers" class="navigationItem">
                        <a class="navigationItemLink" href="<?php echo url_for("profile") ?>">
                            travelers
                        </a>
                    </li>
                    <li id="navigationPlaces" class="navigationItem">
                        <a class="navigationItemLink" href="<?php echo url_for("places") ?>">
                            places
                        </a>
                    </li>
                </ul>
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
            <div id="wideMiddleContent"></div>
        </div>
        <!-- Footer -->
        <div id="footer">
            <hr class="footerBar" />
            <?php echo link_to('About', 'about') ?>
            -
            <a href="http://blog.rootless.me">Blog</a>
            -
            <?php echo link_to('Terms', 'terms') ?>
            -
            <?php echo link_to('Privacy', 'privacy') ?>
            -
            <?php echo link_to('Contact', 'contact') ?>
            -
            <?php echo link_to('Safety', 'safety') ?>
            -
            <?php echo link_to('Help', 'help') ?>
            <br />
            <?php 
             $time = time () ; 
             //This line gets the current time off the server

             $year= date("Y",$time); 
             //This line formats it to display just the year

             echo "&copy; 2011-" . $year;
             //this line prints out the copyright date range, you need to edit 2002 to be your opening year
             ?>
             Rootless, Inc. All rights reserved.
        </div>
        <!-- End of footer -->

    </div>
  </body>
</html>
