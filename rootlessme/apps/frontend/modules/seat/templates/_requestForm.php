<?php use_stylesheets_for_form($seatForm) ?>
<?php use_javascripts_for_form($seatForm) ?>
<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_block_ui_script') ?>"></script>
    <script type="text/javascript" src="/js/newSeatForm.js"></script>
<?php end_slot();?>

<div id="seatDetailsBlock">
    <form id="seatRequestForm" class="userInputForm" action="<?php echo url_for('seats_requests_create') ?>" method="post">
        <h3>Request a Seat</h3>
        <table>
            <tbody>
                <tr>
                    <td colspan="2" >
                        If you have already requested a ride please select it:
                    </td>
                </tr>
                <?php echo $seatForm->renderHiddenFields() ?>
                <?php echo $seatForm['passenger_id']->renderRow() ?>
                <tr>
                    <td colspan="2" >
                        Fill in the details for this specific seat request:
                    </td>
                </tr>
                <?php echo $seatForm['route']['origin']->renderRow() ?>
                <?php echo $seatForm['route']['destination']->renderRow() ?>
                <?php echo $seatForm['pickup_date']->renderRow(array('class'=>'datePicker')) ?>
                <?php echo $seatForm['pickup_time']->renderRow(array('class'=>'timePicker')) ?>
                <?php echo $seatForm['price']->renderRow() ?>
                <?php echo $seatForm['seat_count']->renderRow() ?>
                <?php echo $seatForm['description']->renderRow() ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input id="submit_seat" type="submit" value="Submit" />
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>
<div id="temporaryNewSeatHolder">
</div>