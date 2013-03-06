<?php slot(
  'title',
  sprintf('Rootless - Share your ride or find a carpool.'))
?>


<style>
    .home {
        background-image: url("../images/frontpagebackground3.jpg");
        background-size: cover;
        background-attachment: fixed;
    }
</style>

<div id="loginFormContainer">
       <?php echo get_partial('sfGuardAuth/signin_form', array('form' => $signinForm, 'showForgotPassword' => false)); ?>
</div>

<div class="frontPageContent">
    <div class="frontHeadline">Share your ride. Ride together.</div>
</div>

<div id="horzRideSearchBox">
    <form id="horzRideSearchForm"  action="<?php echo url_for('ride') ?>" method="get">
        <input class="homePageFormFields" type="text" name="rides[origin]" placeholder="Where are you leaving from?"/>
        <input id="seatsField" class="homePageFormFields" type="text" name="rides[destination]" placeholder="Where do you want to go?"/>
        <input id="formSubmit" class="homePageSubmitButton" type="submit" value="Find Ride" />
    <form />
</div>
<div id="videoBox">
    <iframe src="http://player.vimeo.com/video/43364584?title=0&amp;byline=0&amp;portrait=0&amp;color=40b355" width="550" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
</div>

<br />

<div class="subHead">
    Featured events and places
    <div class="featuredEvents">
        <?php foreach ($partnerEvents as $event): ?>
            <?php if ($event->getSlug()!=null): ?>
                <a href="<?php echo url_for('event_show_slug', array('event_id'=>$event->getEventId(), 'slug'=>$event->getSlug()))?>" class="featureLink">
            <?php else: ?>
                <a href="<?php echo url_for('event_show', array('event_id'=>$event->getEventId())) ?>">
            <?php endif; ?>        
                <div id="placeBox">
                    <?php echo $event->getName() ?>
                </div>
            </a>
        <?php endforeach; ?>
        
        <?php foreach ($partnerPlaces as $place): ?>
            <?php if ($place->getSlug()!=null): ?>
                <a href="<?php echo url_for('place_show_slug', array('place_id'=>$place->getPlaceId(), 'slug'=>$place->getSlug()))?>" class="featureLink">
            <?php else: ?>
                <a href="<?php echo url_for('place_show', array('place_id'=>$place->getPlaceId())) ?>">
            <?php endif; ?>        
                <div id="placeBox">
                    <?php echo $place->getName() ?>
                </div>
            </a>
        <?php endforeach; ?>
        <a href="<?php echo url_for('nyc') ?>" class="featureLink">
            <div id="nycBox">
                Carpool NYC
            </div>
        </a>
        <a href="<?php echo url_for('events') ?>" class="featureLink">
            <div id="placeBox">
                See more events
            </div>
        </a>
    </div>
</div>
<div class="subHead">
    Join Rootless!
    <div class="joinRootless">
        <div class="facebookButton">
            <div class="facebookButton">
            <table class="facebookButtonTable" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <i class="facebookButtonLogo"> </i>
                    </td>
                    <td>
                        <span class="facebookButtonBorder">
                            <span class="facebookButtonText">Register with Facebook</span>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        </div>
        <a href="<?php echo url_for('sf_guard_register') ?>" class="featureLink">
            <div id="rootlessBox">
                Sign up with your email
            </div>
        </a>
    </div>
</div>
