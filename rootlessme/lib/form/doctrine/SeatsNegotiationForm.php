<?php

/**
 * Seats negotiation form. This is a slightly simplified version of the
 * seats form since some of the information cannot be changed by the user.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SeatsNegotiationForm extends SeatsForm
{
    /**
     * Configures the form, overriding the base configuration.
     */
    public function configure()
    {
        // Use the parent configuration method first
        parent::configure();

        // Hide all fields that do not apply to the negotiation process. Hiding
        // seems to work better than unsetting because the carpool and passenger
        // are created if either is blank.
        // Carpool and passernger ids are not needed because they are already
        // linked .
        $this->setWidget('carpool_id',new sfWidgetFormInputHidden());
        $this->setWidget('passenger_id',new sfWidgetFormInputHidden());
        
        $this->widgetSchema->setLabel('price', 'Price <span class="negotiate-dollar-sign">$</span>');
    }
}
