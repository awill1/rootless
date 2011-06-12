<?php

require_once '/Library/WebServer/Documents/symfony-1.4.11/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins(array(
              'sfDoctrinePlugin',
              'sfDoctrineGuardPlugin'));
    $this->enablePlugins('sfImageTransformPlugin');
  }
}
