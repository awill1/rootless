<?php use_stylesheet('ride.css') ?>
<div id="rides">
  <?php include_partial('ridesList', array('carpools' => $carpools, 'passengers' => $passengers)) ?>
</div>
