<?php use_stylesheets_for_form($rideSearchForm) ?>
<?php use_javascripts_for_form($rideSearchForm) ?>

<form id="rideSearchForm" class="userInputForm" action="<?php echo url_for('ride_search') ?>" method="post">
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
