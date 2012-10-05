<?php

/**
 * User Notification Settings form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserNotificationSettingsForm extends BaseForm
{
    // Class variables
    protected
        $personId    = null;
  
    /**
     * Constructor.
     *
     * @param Integer $peopleId The people id of the user to show the settings
     * @see sfForm
     */
    public function __construct($personId, $defaults = array(), $options = array(), $CSRFSecret = null)
    {
        $this->personId = $personId;
        
        // Call the parent constructor
        parent::__construct($defaults, $options, $CSRFSecret);
    }
  
    public function configure()
    {
        // Get the user's list of notification settings
        $userNotificationSettings = Doctrine_Core::getTable('NotificationSettings')
                ->getNotificationSettingsForPerson($this->personId);
        
        // For each notification setting
        foreach ($userNotificationSettings as $userNotificationSetting) {
            // Get the notification info
            $notification = $userNotificationSetting->getNotifications();
            $notificationSlug = $notification->getSlug();
            
            // Create a widget
            $this->setWidget($notificationSlug, new sfWidgetFormInputCheckbox());
            // Set the label
            $this->widgetSchema->setLabel($notificationSlug, $notification->getDisplayText());
            // Create a validator
            $this->setValidator($notificationSlug, new sfValidatorInteger(array('required' => false)));
        }
        
        
//        // Setup the form widgets
//        $this->setWidgets(array(
//          'origin'    => new sfWidgetFormInputText(),
//          'destination'   => new sfWidgetFormInputText(),
//          'date'   => new sfWidgetFormInputText(),
//          'trip_type'   => new sfWidgetFormInputCheckbox(),
//          'origin_latitude' => new sfWidgetFormInputHidden(),
//          'origin_longitude' => new sfWidgetFormInputHidden(),
//          'destination_latitude' => new sfWidgetFormInputHidden(),
//          'destination_longitude' => new sfWidgetFormInputHidden()
//        ));
//        
//        // Set labels on some widgets
//        // Correct a misspelling
//        $this->widgetSchema->setLabel('origin', 'From');
//        $this->widgetSchema->setLabel('destination', 'To');

        // Setup the name format
        $this->widgetSchema->setNameFormat('notificationSettings[%s]');
    }

}
