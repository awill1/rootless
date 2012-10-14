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
<div class="subHead">
    Featured Events!
    <div class="featuredEvents">
        <a href="<?php echo url_for('halifaxpop') ?>" class="featureLink">
            <div id="hpxBox">
                Halifax Pop Explosion Music Festival
            </div>
        </a>
        <a href="<?php echo url_for('voodoo') ?>" class="featureLink">
            <div id="voodooBox">
                Voodoo Music + Art Experience
            </div>
        </a>
        <a href="<?php echo url_for('harvestfestival') ?>" class="featureLink">
            <div id="harvestBox">
                Harvest Music Festival
            </div>
        </a>
        <a href="<?php echo url_for('novascotiamusicweek') ?>" class="featureLink">
            <div id="nsmusicweekBox">
                Nova Scotia Music Week
            </div>
        </a>
    </div>
</div>
