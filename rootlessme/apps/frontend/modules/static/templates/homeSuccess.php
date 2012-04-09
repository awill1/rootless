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
<form id="rideSearchForm"  action="<?php echo url_for('ride_search') ?>" method="get">
  <img class="sideImages" src="/images/explore.png" />
  <table>
    <tbody>
      
      <span class="frontLabelText">I want to take a trip</span>
      <?php echo $rideSearchForm->renderHiddenFields() ?>
      <?php echo $rideSearchForm['origin']->renderRow() ?>
      <?php echo $rideSearchForm['destination']->renderRow() ?>
      <?php //echo $rideSearchForm['date']->renderRow(array('class'=>'datePicker')) ?>
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
    <img class="sideImagesL" src="/images/login.png" />
    <span class="loginText"><?php echo get_partial('sfGuardAuth/signin_form', array('form' => $signinForm)) ?></span>
</div>