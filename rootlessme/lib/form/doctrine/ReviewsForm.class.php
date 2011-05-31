<?php

/**
 * Reviews form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReviewsForm extends BaseReviewsForm
{
    public function configure()
    {
        $this->widgetSchema['was_safe'] = new sfWidgetFormChoice(array(
          'choices' => array(null => '', true => 'Yes', false => 'No')
        ));
        $this->widgetSchema['was_punctual'] = new sfWidgetFormChoice(array(
          'choices' => array(null => '', true => 'Yes', false => 'No')
        ));
        $this->widgetSchema['was_friendly'] = new sfWidgetFormChoice(array(
          'choices' => array(null => '', true => 'Yes', false => 'No')
        ));
        $this->widgetSchema['was_courteous'] = new sfWidgetFormChoice(array(
          'choices' => array(null => '', true => 'Yes', false => 'No')
        ));
        $this->widgetSchema['driver_review'] = new sfWidgetFormInputCheckbox(array('value_attribute_value'=>'1' ));
        $this->widgetSchema['passenger_review'] = new sfWidgetFormInputCheckbox(array('value_attribute_value'=>'1' ));

        $this->validatorSchema['was_safe'] = new sfValidatorChoice(array(
          'choices' => array_keys(array(null => '', true => 'Yes', false => 'No'))
        ));

        $this->setWidget('ride_date',new sfWidgetFormInputText());

        // Choose the fields that will be displayed
        unset($this['created_at']);
        unset($this['updated_at']);
        $this->useFields(array(
            'reviewer_id',
            'reviewee_id',
            'driver_review',
            'passenger_review',
            'ride_date',
            //'seat_id',
            'was_safe',
            'was_friendly',
            'was_punctual',
            'was_courteous',
            'comments'));
    }
}
