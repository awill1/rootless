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
    public function configure()
    {
        // Use the parent configuration method first
        parent::configure();

        // Unset all fields that do not apply to the negotiation process
        // Carpool and passernger ids are not needed because they are already
        // linked .
        unset($this['carpool_id']);
        unset($this['passenger_id']);
        // The seat status will be set by the action, not the user
        unset($this['seat_status_id']);
        // I do not think I need seat_request_type_id anymore. I may delete it
        // from the database
        unset($this['seat_request_type_id']);
        // Created and updated at will be handled by the timestampable feature
        // within doctrine
        unset($this['created_at']);
        unset($this['updated_at']);
    }
}
