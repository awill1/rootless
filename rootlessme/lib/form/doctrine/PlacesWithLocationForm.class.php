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
        $this->embedRelation('Location', 'SimpleLocationsForm');
        
        parent::configure();
    }
}
