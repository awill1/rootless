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
    }
}
