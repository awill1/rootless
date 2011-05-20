<?php

/**
 * Profiles form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfilesForm extends BaseProfilesForm
{
    public function configure()
    {
        // Set up the extra widgets
        $this->setWidget('profile_picture', new sfWidgetFormInputFile());

        // Setup the extra validators
        $this->setValidator('profile_picture', new sfValidatorFile());
    }
}
