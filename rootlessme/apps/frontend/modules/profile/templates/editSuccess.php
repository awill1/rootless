<?php use_stylesheet('profile.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Edit Profile'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/jquery.form.js"></script>
    <script type="text/javascript" src="/js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="/js/profileEdit.js"></script>
<?php end_slot();?>

<h1>Edit Profile</h1>

<div id="middleProfileDetails">
    <ul class="tabList">
        <li class="tabSelectedItem"><a href="#fragment-account">Account</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-additional_info">Bio</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-vehicles">Vehicle</a></li>
    </ul>
    <div id="fragment-account" class="middleProfileTabContent">
        <?php include_partial('form', array('form' => $accountInfoForm , 'section' => 'account')) ?>
    </div>
    <div id="fragment-additional_info" class="middleProfileTabContent">
        <?php include_partial('form', array('form' => $additionalInfoForm , 'section' => 'additional')) ?>
    </div>
    <div id="fragment-vehicles" class="middleProfileTabContent">
        <?php include_partial('vehicle/form', array('form' => $vehicleInfoForm )) ?>
    </div>
</div>
