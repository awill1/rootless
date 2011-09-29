<?php

/**
 * Seats form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SeatsRequestForm extends SeatsForm
{
    public function configure()
    {
        // Use the base configuration from the SeatsForm
        parent::configure();

        // Change some of the fields
        // Create the carpool and passenger choices, allowing the empty option
        $this->setWidget('carpool_id',new sfWidgetFormInputHidden());


    }

    public function doSave($con = null) {
        $seat = $this->getObject();

        // If this is a new seat request
        if ($seat->isNew())
        {
            // Set the status to pending
//            $this->values['seat_status_id'] = sfContext::getInstance()->getUser()->getGuardUser()->getPersonId();
        }


        // Call the parent function to save the message
         return parent::doSave($con);
    }
}
