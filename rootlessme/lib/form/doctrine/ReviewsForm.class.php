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
    /**
     * The supported ride types
     * @var string The ride type
     */
    protected static $rideTypes = array(null => '',
                                        'driver' => 'Driver Review',
                                        'passenger' => 'Passenger Review');

    /**
     * Overrides the base configuration of the form
     */
    public function configure()
    {
        // Set the boolean widgets to be radio buttons
        $this->widgetSchema['was_safe'] = new sfWidgetFormChoice(array( 'expanded' => true,
          'choices' => array(true => 'Yes', false => 'No')
        ));
        $this->widgetSchema['was_punctual'] = new sfWidgetFormChoice(array( 'expanded' => true,
          'choices' => array(true => 'Yes', false => 'No')
        ));
        $this->widgetSchema['was_friendly'] = new sfWidgetFormChoice(array( 'expanded' => true,
          'choices' => array(true => 'Yes', false => 'No')
        ));
        $this->widgetSchema['was_courteous'] = new sfWidgetFormChoice(array( 'expanded' => true,
          'choices' => array(true => 'Yes', false => 'No')
        ));
        
        // Create the ride type dropdown instead of using the driver_review
        // and passenger_review checkboxes
        $this->widgetSchema['review_type'] = new sfWidgetFormChoice(array(
          'choices' => self::$rideTypes
        ));
        $this->setWidget('driver_review', new sfWidgetFormInputHidden());
        $this->setWidget('passenger_review', new sfWidgetFormInputHidden());

        // Change the ride date widget to be a textbox
        $this->setWidget('ride_date',new sfWidgetFormInputText());
        
        // Set labels on some widgets
        $this->widgetSchema->setLabel('was_safe', 'Safe Driver');
        $this->widgetSchema->setLabel('was_punctual', 'Punctuality');
        $this->widgetSchema->setLabel('was_friendly', 'Friendly');
        $this->widgetSchema->setLabel('was_courteous', 'Courteous');

        // Hide hidden fields
        $this->setWidget('reviewer_id', new sfWidgetFormInputHidden());
        $this->setWidget('reviewee_id', new sfWidgetFormInputHidden());

        // Set validators for the new widgets
        $this->setValidator('review_type', new sfValidatorChoice(array(
                  'choices' => array_keys(self::$rideTypes),
                  'required' => false
        )));

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

    /**
     * Saves the review form, creating or updating the review
     * @param Doctrine_Connection $con The connection to the datastore
     * @return Reviews The saved review
     */
    public function doSave($con = null) 
    {
        // Convert the review_type into the booleans in the database
        $reviewType = $this->values['review_type'];
        switch ($reviewType) {
            case 'both':
                $this->values['driver_review'] = true;
                $this->values['passenger_review'] = true;
                break;
            case 'driver':
                $this->values['driver_review'] = true;
                $this->values['passenger_review'] = false;
                break;
            case 'passenger':
                $this->values['driver_review'] = false;
                $this->values['passenger_review'] = true;
                break;
            case '':
                $this->values['driver_review'] = false;
                $this->values['passenger_review'] = false;
                break;
            default:
                // Invalid review_type so ignore
                break;
        }

        // Call the parent save function
        return parent::doSave($con);
    }
}
