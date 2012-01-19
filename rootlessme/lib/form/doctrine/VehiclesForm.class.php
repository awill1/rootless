<?php

/**
 * Vehicles form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VehiclesForm extends BaseVehiclesForm
{
    /**
     * Configures the vehicles form
     */
    public function configure()
    {   
        // Choose the order of the fields in the form, all others are unset
        unset($this['person_id']);
        unset($this['image_url_large']);
        unset($this['image_url_small']);
        unset($this['created_at']);
        unset($this['updated_at']);
    }
    
    /**
     * Overrides the parent saving behavior for the form
     * @param Doctrine_Connection $con The connection to the database
     * @return Vehicles The saved vehicle 
     */
    public function doSave($con = null) 
    {
        // The driver should be the user who is logged in
        $this->values['person_id'] = sfContext::getInstance()->getUser()->getGuardUser()->getPersonId();

        return parent::doSave($con);
    }
}
