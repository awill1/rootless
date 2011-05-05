<?php

/**
 * Routes form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RoutesForm extends BaseRoutesForm
{
    public function configure()
    {
        // Create the custom inputs for the form
        $this->setWidget('origin', new sfWidgetFormInputText());
        $this->setWidget('destination', new sfWidgetFormInputText());
        $this->setWidget('route_data', new sfWidgetFormInputHidden());

        // Create the custom input validators
        $this->setValidator('origin', new sfValidatorString(array('required' => true)));
        $this->setValidator('destination', new sfValidatorString(array('required' => true)));
        $this->setValidator('route_data', new sfValidatorString(array('required' => false)));

        unset($this['created_at']);
        unset($this['updated_at']);

        // Choose the order of the fields in the form, all others are unset
        $this->useFields(array(
            'route_data',
            'origin',
            'destination',
            'copyright'));


    }

    public function save($con = null)
    {
     

        parent::save();
    }

    public function doSave($con = null)
    {
        $this['copyright'] = '&copy;Testing copyright';


        // Overriding the default doSave to chage the order of the saved objects
        if (null === $con)
        {
          $con = $this->getConnection();
        }


        $this->updateObject();

        $this->getObject()->save($con);


        // embedded forms
        $this->saveEmbeddedForms($con);

    }
}
