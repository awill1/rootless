<?php

/**
 * Seats form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SeatsForm extends BaseSeatsForm
{
    public function configure()
    {
        $seat = $this->getObject();

        // The database does not have a relationship between seat and route
        // yet so use a blank route for now
        //$this->getObject()->Routes = $route;
        $route = new Routes();
        $route_form = new RoutesForm($route);
        // Override the label for a few select fields
        $route_form->widgetSchema->setLabel('origin', 'Pickup Location');
        $route_form->widgetSchema->setLabel('destination', 'Dropoff Location');
        $this->embedForm('route', $route_form);

        // Change the pickup date and time widgets to be textboxs for the
        // date and time picker. The default date and time validators will
        // still work
        $this->setWidget('pickup_date',new sfWidgetFormInputText());
        $this->setWidget('pickup_time',new sfWidgetFormInputText());

        // Hide the seat type field
        $this->setWidget('seat_request_type_id',new sfWidgetFormInputHidden());

        // Create the carpool and passenger choices, allowing the empty option
        $this->setWidget('carpool_id',new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'), 'add_empty' => true)));
        $this->setWidget('passenger_id',new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Passengers'), 'add_empty' => true)));

        // Choose the fields that will be displayed
        unset($this['created_at']);
        unset($this['updated_at']);
        $this->useFields(array(
            'seat_id',
            'route',
            'carpool_id',
            'passenger_id',
            'seat_status_id',
            'seat_request_type_id',
            'pickup_date',
            'pickup_time',
            'price',
            'seat_count',
            'description'));

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
