<?php

/**
 * Carpools form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CarpoolsForm extends BaseCarpoolsForm
{
  public function configure()
  {
      $this->setWidget('origin', new sfWidgetFormInputText());
      $this->setWidget('destination', new sfWidgetFormInputText());
  }
}
