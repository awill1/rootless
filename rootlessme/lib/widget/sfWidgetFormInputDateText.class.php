<?php


/**
 * sfWidgetFormInput represents an HTML text input tag used for showing dates.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormInputText.class.php 30762 2010-08-25 12:33:33Z fabien $
 */
class sfWidgetFormInputDateText extends sfWidgetFormInputText
{  
    /**
     * Renders the widget.
     *
     * @param  string $name        The element name
     * @param  string $value       The value displayed in this widget
     * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
     * @param  array  $errors      An array of errors for the field
     *
     * @return string An HTML tag string
     *
     * @see sfWidgetForm
     */
    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        // Change the value to be mm/dd/yyyy format. This is only for american style
        if (!is_null($value))
        {
            $value = date("m/d/Y", strtotime($value));
        }
        return parent::render($name, $value, $attributes, $errors);
    }
}