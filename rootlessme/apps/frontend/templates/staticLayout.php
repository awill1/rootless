<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://ogp.me/ns/fb#">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
      <title>
          <?php if (!include_slot('title')): ?>
            Rootless Me - Share your ride or find a carpool.
          <?php endif; ?>
      </title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_stylesheet(sfConfig::get('app_css_main')) ?>
    <?php use_javascript(sfConfig::get('app_jquery_script')) ?>
    <?php use_javascript(sfConfig::get('app_jquery_ui_script')) ?>
    <?php use_javascript(sfConfig::get('app_jquery_ui_timepicker_script')) ?>
    <?php use_stylesheet(sfConfig::get('app_jquery_ui_stylesheet')) ?>
    <?php use_javascript(sfConfig::get('app_jquery_validation_script')) ?>
    <?php use_javascript(sfConfig::get('app_jquery_block_ui_script')) ?>
    <?php use_javascript(url_for('sf_routes_js')) ?>
    <?php use_javascript(sfConfig::get('app_jquery_facebook_script')) ?>
    <?php use_stylesheet(sfConfig::get('app_css_static')) ?>
    <?php use_javascript('headerMenu') ?>
    <?php use_javascript('navigation') ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php if (has_slot('gmapheader')): ?>
        <?php include_slot('gmapheader') ?>
    <?php endif; ?>
    
    <script type="text/javascript">
        // This adds 'placeholder' to the items listed in the jQuery .support object.
        // Used to detect if a browser supports placeholders (IE does not ).
        jQuery(function() {
            jQuery.support.placeholder = false;
            test = document.createElement('input');
            if('placeholder' in test) jQuery.support.placeholder = true;
        });
    
    //make sure the background image fills the screen
    $(document).ready(function(){
        
        //listen for screen width
        var scW = screen.width;
        if (scW < 400) {
        } else {
            $('#containerFront').html('<img id="backgroundImage" src="/images/FrontPageBackground2.jpg" alt="RootlessMe" />');
        }

        //get window height
        var winH = $(window).height();
        var winW = $(window).width();
        if((winW/winH) < 1.5)
        {
            $("#backgroundImage").css({height: winH, width: ''});
        } else {

            $("#backgroundImage").css({width: winW, height: ''});
        }
       
        $(window).resize(function(){
            var winH = $(window).height();
            var winW = $(window).width();

            if((winW/winH) < 1.5) {
                $("#backgroundImage").css({height: winH, width: ''});
            } else {
                $("#backgroundImage").css({width: winW, height: ''});
            }
        });

        // change orgin and destination text 
        $('.home #rideSearchForm label[for="rides_origin"]').html('from');
        $('.home #rideSearchForm label[for="rides_destination"]').html('to');
       
        // Add the background outlines to the text boxes
        $('.home #rideSearchForm tbody tr input')
            .wrap('<div class="homeControl" />')
            .before('<div class="opaqueBg" /><span class="plusSign">+</span>');
        $('.home #loginFormContainerB tbody tr input[type="text"], .home #loginFormContainerB tbody tr input[type="password"]')
           .wrap('<div class="homeControl" />')
           .before('<div class="opaqueBg" />');
     
        // Make Login form submit value = 'Login'
        $('.home #loginFormContainer tfoot input').attr('value', 'Login');
        
        // Login textbox watermarks
        $('#signin_username').attr('placeholder','Email');
        $('#signin_password').attr('placeholder','Password');
        
        // Find ride textbox watermarks
        $('#rides_origin').attr('placeholder','Address, City, State');
        $('#rides_destination').attr('placeholder','Address, City, State');
    
        // Register textbox watermarks
        $('#sf_guard_user_first_name').attr('placeholder','First Name');
        $('#sf_guard_user_last_name').attr('placeholder','Last Name');
        $('#sf_guard_user_email_address').attr('placeholder','Email');
        $('#sf_guard_user_password').attr('placeholder','Password');
        $('#sf_guard_user_password_again').attr('placeholder','Password Again');
       
        // Correct the placeholders on unsupported browsers
        if(!$.support.placeholder) {
            var active = document.activeElement;
            $('input:text,input:password').focus(function () {
                if ($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')) {
                    $(this).val('').removeClass('hasPlaceholder');
                }
            }).blur(function () {
                if ($(this).attr('placeholder') != '' && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder'))) {
                    $(this).val($(this).attr('placeholder')).addClass('hasPlaceholder');
                }
            });
            $('input:text,input:password').blur();
            $(active).focus();
            $('form').submit(function () {
                $(this).find('input:text.hasPlaceholder,input:password.hasPlaceholder').val('');
            });
        }
       
    });
    
    
    </script>
    
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
  <body class="home">
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
        
        <div id="containerFront">
        </div>
      
      <div id="container">

        <!-- Header -->
        <div id="header">
            
            <a href="<?php echo url_for('home') ?>" ><img id="headerLogo" src="/images/LogoFront.png" alt="RootlessMe" /></a>
            <div id="headerControls">
            </div>
        </div>

        <!-- End of header -->

        <div id="content">



            <!--<div id="rightColumn"><p>This is my rightColumn</p></div> -->

            <div id="middleContentFront">
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


    </div>
      <div id="bottomFeed">   
            <div id="footerLink">
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
            </div>
            <span id="copyRight">
            <?php 
             $time = time () ; 
             //This line gets the current time off the server

             $year= date("Y",$time); 
             //This line formats it to display just the year

             echo "&copy; 2011-" . $year;
             //this line prints out the copyright date range, you need to edit 2002 to be your opening year
             ?>
             Rootless, Inc. All rights reserved.</span>
        </div>
  </body>
</html>
