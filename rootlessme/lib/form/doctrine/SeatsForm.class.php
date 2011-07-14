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
        // Embedded route subform
        $route = new Routes();
        //$this->getObject()->Routes = $route;
        $route_form = new RoutesForm($route);
        // Override the labe for a few select fields
        $route_form->widgetSchema->setLabel('origin', 'Pickup Location');
        $route_form->widgetSchema->setLabel('destination', 'Dropoff Location');
        $this->embedForm('route', $route_form);

        // Change the pickup date and time widgets to be textboxs for the
        // date and time picker. The default date and time validators will
        // still work
        $this->setWidget('pickup_date',new sfWidgetFormInputText());
        $this->setWidget('pickup_time',new sfWidgetFormInputText());

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
            'price',
            'seat_count',
            'description'));

    }
}
