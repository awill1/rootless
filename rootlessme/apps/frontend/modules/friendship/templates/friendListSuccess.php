<!--[{"key": "1", "value": "Aaron Williams"}, {"key": "2", "value": "Christy Williams"}, {"key": "3", "value": "Lauren Prestifillipo"}, {"key": "snowbord", "value": "snowbord"}, {"key": "computer", "value": "computer"}, {"key": "apple", "value": "apple"}, {"key": "pc", "value": "pc"}, {"key": "ipod", "value": "ipod"}, {"key": "ipad", "value": "ipad"}, {"key": "iphone", "value": "iphone"}, {"key": "iphon4", "value": "iphone4"}, {"key": "iphone5", "value": "iphone5"}, {"key": "samsung", "value": "samsung"}, {"key": "blackberry", "value": "blackberry"}]-->
[
<?php $nb = count($friends);
      $i = 0;
      foreach ($friends as $friend): ++$i ?>
{
  "key": "<?php echo $friend->getPersonId() ?>",
  "value": <?php echo $friend->getFullName() ?>
}<?php echo $nb == $i ? '' : ',' ?>

<?php endforeach ?>
]