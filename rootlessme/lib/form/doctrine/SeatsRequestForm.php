<?php

/**
 * Seats request form. This is a slightly simplified version of the
 * seats form since some of the information cannot be changed by the user.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SeatsRequestForm extends SeatsForm
{
    public function configure()
    {
        // Use the base configuration from the SeatsForm
        parent::configure();

        // Change the carpool id to hidden, since it is already set.
        $this->setWidget('carpool_id',new sfWidgetFormInputHidden());
    }
}
