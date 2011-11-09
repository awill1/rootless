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
        $this->widgetSchema['was_safe'] = new sfWidgetFormChoice(array( 'expanded' => true,
          'choices' => array(true => 'Yes', false => 'No')
        ));
        $this->widgetSchema['was_safe']->setLabel('was_safe', 'Safe Driver');
     
        $this->widgetSchema['was_punctual'] = new sfWidgetFormChoice(array( 'expanded' => true,
          'choices' => array(true => 'Yes', false => 'No')
        ));
        $this->widgetSchema['was_punctual']->setLabel('was_puctual', 'Punctuality');
        
        $this->widgetSchema['was_friendly'] = new sfWidgetFormChoice(array( 'expanded' => true,
          'choices' => array(true => 'Yes', false => 'No')
        ));
        $this->widgetSchema['was_friendly']->setLabel('was_friendly', 'Friendly');
        
        $this->widgetSchema['was_courteous'] = new sfWidgetFormChoice(array( 'expanded' => true,
          'choices' => array(true => 'Yes', false => 'No')
        ));
        $this->widgetSchema['was_courteous']->setLabel('was_courteous', 'Courteous');
        
        $this->widgetSchema['review_type'] = new sfWidgetFormChoice(array(
          'choices' => array(null => '','driver' => 'Driver Review', 'passenger' => 'Passenger Review')
        ));
        $this->validatorSchema['was_safe'] = new sfValidatorChoice(array(
          'choices' => array_keys(array(null => '', true => 'Yes', false => 'No'))
        ));

        $this->setWidget('ride_date',new sfWidgetFormInputText());

        // Hidden fields
        $this->setWidget('reviewer_id', new sfWidgetFormInputHidden());
        $this->setWidget('reviewee_id', new sfWidgetFormInputHidden());

        // Choose the fields that will be displayed
        unset($this['created_at']);
        unset($this['updated_at']);
        $this->useFields(array(
            'reviewer_id',
            'reviewee_id',
            'review_type',
            'ride_date',
            //'seat_id',
            'was_safe',
            'was_friendly',
            'was_punctual',
            'was_courteous',
            'comments'));
    }
}
