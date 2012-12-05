<?php

/**
 * Seats offer form. This is a slightly simplified version of the
 * seats form since some of the information cannot be changed by the user.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SeatsOfferForm extends SeatsForm
{
    public function configure()
    {
        // Use the parent configuration method first
        parent::configure();

        // Change the passenger id to hidden, since it is already set.
        $this->setWidget('passenger_id',new sfWidgetFormInputHidden());
        
//        $seat = $this->getObject();
//        $passenger = $seat->getPassengers();
//        $this->getEmbeddedForm('route')->setDefault('origin', $passenger->getRoutes()->getOriginAddress());
//        $this->getEmbeddedForm('route')->setDefault('destination', $passenger->getRoutes()->getDestinationAddress());
    }
}
