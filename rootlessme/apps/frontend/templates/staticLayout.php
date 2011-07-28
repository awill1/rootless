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
    <?php use_stylesheet('static.css') ?>
    <?php use_javascript('headerMenu') ?>
    <?php use_javascript('navigation') ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php if (has_slot('gmapheader')): ?>
        <?php include_slot('gmapheader') ?>
    <?php endif; ?>

  </head>
  <body>
      <div id="containerFront">
      <img id="backgroundImage" src="/images/FrontPageBackground2.jpg" alt="RootlessMe" />   
      </div>
              <div id="bottomFeed">
           <span id="copyRight"> &copy;2011 Star Banana, LLC. All rights reserved.</span>
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
  </body>
</html>
