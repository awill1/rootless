<?php use_stylesheet(sfConfig::get('app_css_ride')) ?>
<div id="rides">
  <?php include_partial('ridesList', array('carpools' => $carpools, 'passengers' => $passengers)) ?>
</div>
