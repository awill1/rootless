<?php

/**
 * Events form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EventsForm extends BaseEventsForm
{
  public function configure()
  {
        $this->setWidget('event_id', new sfWidgetFormInputHidden());
      // Choose the fields that will be 
        unset($this['created_at']);
        unset($this['updated_at']);
  }
}
