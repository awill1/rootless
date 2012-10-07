<?php
/**
 * FIXME: This class can be removed if the sfWidgetFormInputCheckbox bug
 * has been resolved in symfony.
 * 
 * Checkboxes do not show up as unchecked if the value in the database is 0.
 * 
 * Source http://www.devexp.eu/2009/04/23/sfwidgetforminputcheckbox-unchecked-bug/
 */
class myOwnWidgetFormInputCheckbox extends sfWidgetFormInputCheckbox
{
    /**
    * Override render method due to symfony bug (http://trac.symfony-project.org/ticket/3917)
    */
    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        if (!is_null($value) && $value !== false && $value != 0)
        {
            $attributes['checked'] = 'checked';
        }

        if (!isset($attributes['value']) && !is_null($this->getOption('value_attribute_value'))) {
            $attributes['value'] = $this->getOption('value_attribute_value');
        }

        return parent::render($name, null, $attributes, $errors);
    }
}