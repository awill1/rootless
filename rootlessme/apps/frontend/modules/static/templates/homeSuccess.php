<?php slot(
  'title',
  sprintf('Rootless - Share your ride or find a carpool.'))
?>
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
        <a href="<?php echo url_for('patriots') ?>" class="featureLink">
            <div id="patriotsBox">
                New England Patriots Games
            </div>
        </a>
        <a href="<?php echo url_for('buckeyes') ?>" class="featureLink">
            <div id="ohioStateBox">
                The Ohio State Buckeyes Game
            </div>
        </a>
    </div>
</div>


<!--    
<div id="loginFormContainerB">
    <img class="sideImagesL" src="/images/login.png" alt="Login" />
    
    <div class="blockableLoginContainer">
        <div>
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
        <span class="frontLabelText">or, use your email address</span>
        <div class="registerText">
            <?php// echo get_partial('sfGuardRegister/form', array('form' => $registerForm)) ?>
        </div>
    </div>
</div>
-->
