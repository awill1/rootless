<?php use_stylesheet('profile.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Edit Profile'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript">
        $(function() {
            $( "#middleProfileDetails" ).tabs();
	});
    </script>
<?php end_slot();?>

<h1>Edit Profile</h1>

<div id="middleProfileDetails">
    <ul class="tabList">
        <li class="tabSelectedItem"><a href="#fragment-account">Account</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-additional_info">Bio</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-notification">Notification</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-linked_accounts">Linked Accounts</a></li>
    </ul>
    <div id="fragment-account" class="middleProfileTabContent">
        <?php include_partial('form', array('form' => $form)) ?>
    </div>
    <div id="fragment-additional_info" class="middleProfileTabContent">
        <h3>More about you</h3>
        <?php include_partial('form', array('form' => $additionalInfoForm)) ?>
    </div>
    <div id="fragment-notification" class="middleProfileTabContent">
        <h3>Notification</h3>
    </div>
    <div id="fragment-linked_accounts" class="middleProfileTabContent">
        <h3>Notification</h3>
    </div>
</div>
