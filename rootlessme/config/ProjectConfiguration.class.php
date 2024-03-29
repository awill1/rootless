<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/symfony_1_4_18/lib/autoload/sfCoreAutoload.class.php';

sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
    static protected $zendLoaded = false;
    static public function registerZend()
    {
        if (self::$zendLoaded)
        {
            return;
        }

        set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
        require_once sfConfig::get('sf_lib_dir').'/vendor/Zend/Loader/Autoloader.php';
        Zend_Loader_Autoloader::getInstance();
        self::$zendLoaded = true;
    }
    
    public function setup()
    {
        $this->enablePlugins(array(
              'sfDoctrinePlugin',
              'sfDoctrineGuardPlugin',
              'sfImageTransformPlugin',
              'sfAmazonS3Plugin'
            ));
    }
}
