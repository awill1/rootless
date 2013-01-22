<?php

/**
 * Ride Search form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RideSearchForm extends BaseForm
{
    public function configure()
    {
        // Setup the form widgets
        $this->setWidgets(array(
          'origin'    => new sfWidgetFormInputText(),
          'destination'   => new sfWidgetFormInputText(),
          'date'   => new sfWidgetFormInputText(),
          'trip_type'   => new sfWidgetFormInputCheckbox(),
          'polyline' => new sfWidgetFormInputHidden(),
          'origin_latitude' => new sfWidgetFormInputHidden(),
          'origin_longitude' => new sfWidgetFormInputHidden(),
          'destination_latitude' => new sfWidgetFormInputHidden(),
          'destination_longitude' => new sfWidgetFormInputHidden()
        ));
        
        //set title
        $this->widgetSchema['origin']->setAttribute('placeholder', 'Where are you leaving from?');
        $this->widgetSchema['destination']->setAttribute('placeholder', 'Where do you want to go?');
		$this->widgetSchema['date']->setAttribute('placeholder', 'Date');

        $this->widgetSchema['origin']->setAttribute('class', 'title-n');
        $this->widgetSchema['destination']->setAttribute('class', 'title-n');

        // Setup the name format
        $this->widgetSchema->setNameFormat('rides[%s]');
    }

}
