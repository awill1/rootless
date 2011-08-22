[
<?php $nb = count($friends);
      $i = 0;
      foreach ($friends as $friend): ++$i ?>
{
  "key": "<?php echo $friend->getPersonId() ?>",
  "value": "<?php echo $friend->getFullName() ?>"
}<?php echo $nb == $i ? '' : ',' ?>

<?php endforeach ?>
]