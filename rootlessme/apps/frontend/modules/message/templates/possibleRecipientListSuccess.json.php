[
<?php foreach ($profiles as $i => $profile) : ?>
<?php 
if ($i > 0)
{
       echo ',';
}
?>
{
"key" : "<?php echo $profile->getPersonId(); ?>",
"value" : "<?php echo $profile->getFullName(); ?>"
}
<?php endforeach; ?>
]