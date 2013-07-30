<?php slot(
  'title',
  sprintf('Rootless - Administration'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_js_admin'); ?>"></script>
<?php end_slot();?>

<h1>Admin Page</h1>

This page is used for some administration tasks

<h2>Delete anyday rides to an event</h2>
<form id="deleteAnydayForm" target="<?php echo url_for('admin_delete_anyday_rides_to_events'); ?>" method="POST">
    <input id="deleteAnydayButton" type="button" value="Delete" />
</form>

<h2>Remove expired points from the database</h2>