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
    <?php use_javascript(sfConfig::get('app_jquery_ui_timepicker_script')) ?>
    <?php use_stylesheet(sfConfig::get('app_jquery_ui_stylesheet')) ?>
    <?php use_javascript(sfConfig::get('app_jquery_validation_script')) ?>
    <?php use_stylesheet('static.css') ?>
    <?php use_javascript('headerMenu') ?>
    <?php use_javascript('navigation') ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php if (has_slot('gmapheader')): ?>
        <?php include_slot('gmapheader') ?>
    <?php endif; ?>
    
    <script type="text/javascript">
    
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
            
       if((winW/winH) < 1.5)
           {
      $("#backgroundImage").css({height: winH, width: ''});
           } else {
               
               $("#backgroundImage").css({width: winW, height: ''});
           }
           
           
           
       });
       
            

       // change orgin and destination text 
         $('.home #rideSearchForm label[for="rides_origin"]').html('from');
         $('.home #rideSearchForm label[for="rides_destination"]').html('to');
         
         
       $('.home #rideSearchForm input[type="text"]').val('Address, City, State');
       $('.home #loginFormContainerB input[type="text"]').val('Email');
       $('.home #loginFormContainerB input[type="password"]').val('Password');
       
       $('.home #loginFormContainerB input[type="text"], .home #loginFormContainerB input[type="password"]').focus(function(){
           if ($(this).val() == 'Email') {
             $(this).val('');
           }
       });
       
       $('.home #loginFormContainerB input[type="password"]').focus(function(){
           if ($(this).val() == 'Password') {
             $(this).val('');
           }
       });
       
       $('.home #loginFormContainerB input[type="text"], .home #loginFormContainerB input[type="password"]').blur(function(){
           if ($(this).val() == '') {
             $(this).val('Email');
           }
       });
       
       $('.home #loginFormContainerB input[type="password"]').blur(function(){
           if ($(this).val() == '') {
             $(this).val('Password');
           }
       });
       
       
       
       $('.home #rideSearchForm input[type="text"]').focus(function(){
           if ($(this).val() == 'Address, City, State') {
             $(this).val('');
           }
       });
       
       $('.home #rideSearchForm input[type="text"]').blur(function(){
           if ($(this).val() == '') {
             $(this).val('Address, City, State');
           }
       });
       
       $('.home #rideSearchForm tbody tr input')
            .wrap('<div class="homeControl" />')
            .before('<div class="opaqueBg" /><span class="plusSign">+</span>');
       //$('.home #rideSearchForm tbody tr input').after('<span class="plusSign">+</span><div class="opaqueBg"></div>');
       $('.home #loginFormContainerB tbody tr input[type="text"], .home #loginFormContainerB tbody tr input[type="password"]')
           .wrap('<div class="homeControl" />')
           .before('<div class="opaqueBg" />');
     
       //make Login form submit value = 'Login'
       
            $('.home #loginFormContainer tfoot input').attr('value', 'Login');
       
       
       // sign in - hint value
       $('.home #loginFormContainer #signin_username').after('<span class="signin_username">Email</span>').parent().css({'position': 'relative'});
       $('.home #loginFormContainerB #signin_username').parent().css({'position': 'relative'});
       // password - hint value
       $('.home #loginFormContainer #signin_password').after('<span class="signin_password">Password</span>').parent().css({'position': 'relative'});
       $('.home #loginFormContainerB #signin_password').parent().css({'position': 'relative'});
       // Function for login form on focus 
       $('.home #loginFormContainer input[type="text"], .home #loginFormContainer input[type="password"]').click(function(){
            var id = $(this).attr('id');
            $('.' + id).fadeOut();
           
           
       });
       
       $('.home #loginFormContainer span.signin_password, .home #loginFormContainer span.signin_username').click(function(){
            var cl = $(this).attr('class');
            $(this).fadeOut();
            $('#' + cl).focus();
           
           
       });
       
       
       $('.home #loginFormContainer input[type="text"], .home #loginFormContainer input[type="password"]').blur(function(){
            if($(this).attr('value') == '')
           {
              
               var id = $(this).attr('id');
               $('.' + id).fadeIn();
           }
           
       });
       
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
            <?php echo link_to('Terms of Service', 'terms') ?>-
            
            <?php echo link_to('Privacy Policy', 'privacy') ?>-
            
            <?php echo link_to('About Us', 'about') ?>-
            
            <?php echo link_to('Contact Us', 'contact') ?>-
            
            <?php echo link_to('Safety Tips', 'safety') ?>-
            
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
             Star Banana, LLC. All rights reserved.</span>
        </div>
  </body>
</html>
