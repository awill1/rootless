<?php use_stylesheets_for_form($seatForm) ?>
<?php use_javascripts_for_form($seatForm) ?>

<form class="userInputForm" action="<?php echo url_for('ride_search') ?>" method="post">
  <table>
    <tbody>
      <?php echo $seatForm ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <input id="rides_find" type="button" value="Submit" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
