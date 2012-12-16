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
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta property="og:image" content="https://rootlessme.s3.amazonaws.com/images/rootless_logo_square.jpg"/>
    <meta property="og:site_name" content="Rootless"/>
    <meta property="og:type" content="website"/>
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
    <?php use_javascript(sfConfig::get('app_js_header_menu')) ?>
    <?php use_javascript(sfConfig::get('app_js_navigation')) ?>
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
        
    $(document).ready(function(){
     
        // Make Login form submit value = 'Login'
        $('.home #loginFormContainer tfoot input').attr('value', 'Login');
        
        // Login textbox watermarks
        $('#signin_username').attr('placeholder','Email');
        $('#signin_password').attr('placeholder','Password');
        
        // Find ride textbox watermarks
        $('#rides_origin').attr('placeholder','Address, City, State');
        $('#rides_destination').attr('placeholder','Address, City, State');

       
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
      <div id="container">

        <!-- Header -->
        <div id="header">
            
            <a href="<?php echo url_for('home') ?>" ><img id="headerLogo" src="/images/LogoFront.png" alt="Rootless" /></a>
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
      <div id="footer">   
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
