<?php

/**
 * Places form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PlacesWithLocationForm extends PlacesForm
{
    public function configure()
    {
        
        // Embedd a location form
        $location = new Locations();
        $locationForm = new LocationsForm($location);
        $this->embedForm('location2',$locationForm);
        
        parent::configure();
    }
}
