<?php

/**
 * Locations form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SimpleLocationsForm extends BaseLocationsForm
{
    public function configure()
    {
        // Choose the fields that will be displayed
        unset($this['created_at']);
        unset($this['updated_at']);
        $this->useFields(array(
            'street1',
            'city',
            'state',
            'postal_code'));
    }
}
