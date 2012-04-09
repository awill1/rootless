<?php slot(
  'title',
  sprintf('Rootless Me - Share your ride.'))
?>
<div id="loginFormContainer">
        <?php echo get_partial('sfGuardAuth/signin_form', array('form' => $signinForm)) ?>
</div>

<div class="frontPageContent">
    <p>
       A ridesharing network that helps get you out from behind your computer to enjoy life.
    </p>
</div>
    
<form target

<form id="rideSearchForm"  action="<?php echo url_for('ride_search') ?>" method="get">
  <table>
    <tbody>
      <?php echo $rideSearchForm->renderHiddenFields() ?>
      <?php echo $rideSearchForm['origin']->renderRow() ?>
      <?php echo $rideSearchForm['destination']->renderRow() ?>
      <?php echo $rideSearchForm['date']->renderRow(array('class'=>'datePicker')) ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <input id="rides_find" type="submit" value="Find Ride" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
    
<div id="signUpFormContainer">
    <span class="notMemberTransparency"><img src="/images/NotaMember.png" alt="Rootless" /></span>
    <span class="signUpText"><?php echo get_partial('sfGuardRegister/form', array('form' => $registerForm)) ?></span>
</div>