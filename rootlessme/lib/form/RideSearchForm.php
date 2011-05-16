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
          'gender_preference'   => new sfWidgetFormInputText(),
        ));

        $this->widgetSchema->setNameFormat('rides[%s]');
    }

}
