<?php slot(
  'title',
  sprintf('Rootless Me - Share your ride or find a carpool.'))
?>
<div id="loginFormContainer">
       <?php echo get_partial('sfGuardAuth/signin_form', array('form' => $signinForm, 'showForgotPassword' => false)); ?>
</div>

<div class="frontPageContent">
    <p>
       A ridesharing network that helps get you out from behind your computer to enjoy life.
    </p>
</div>
<form id="rideSearchForm"  action="<?php echo url_for('ride') ?>" method="get">
  <img class="sideImages" src="/images/explore.png" alt="Explore" />
  <span class="frontLabelText">I want to go...</span>
  <table>
    <tbody>
      <?php echo $rideSearchForm->renderHiddenFields() ?>
      <?php echo $rideSearchForm['origin']->renderRow() ?>
      <?php echo $rideSearchForm['destination']->renderRow() ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="2">
          <input id="rides_find" type="submit" value="Find Ride" />
        </th>
      </tr>
    </tfoot>
  </table>
</form>
    
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
            <?php echo get_partial('sfGuardRegister/form', array('form' => $registerForm)) ?>
        </div>
    </div>
</div>