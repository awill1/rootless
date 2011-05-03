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
//      $this->setWidget('origin', new sfWidgetFormInputText());
//      $this->setWidget('destination', new sfWidgetFormInputText());
      
        $this->setWidgets(array(
          'carpool_id'      => new sfWidgetFormInputHidden(),
          'route'           => new sfWidgetFormInputHidden(),
          'origin'          => new sfWidgetFormInputText(),
          'destination'     => new sfWidgetFormInputText(),
          'driver_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
          'vehicle_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehicles'), 'add_empty' => false)),
          'route_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'), 'add_empty' => false)),
          'solo_route_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes_3'), 'add_empty' => false)),
          'seats_available' => new sfWidgetFormInputText(),
          'start_date'      => new sfWidgetFormDate(),
          'start_time'      => new sfWidgetFormTime(),
          'asking_price'    => new sfWidgetFormInputText(),
          'description'     => new sfWidgetFormTextarea(),
          'created_at'      => new sfWidgetFormDateTime(),
          'updated_at'      => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
          'carpool_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('carpool_id')), 'empty_value' => $this->getObject()->get('carpool_id'), 'required' => false)),
          'route'           => new sfValidatorString(array('required' => false)),
          'driver_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
          'origin'          => new sfValidatorString(array('required' => false)),
          'destination'     => new sfValidatorString(array('required' => false)),
          'vehicle_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vehicles'))),
          'route_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'))),
          'solo_route_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Routes_3'))),
          'seats_available' => new sfValidatorInteger(array('required' => false)),
          'start_date'      => new sfValidatorDate(array('required' => false)),
          'start_time'      => new sfValidatorTime(array('required' => false)),
          'asking_price'    => new sfValidatorNumber(array('required' => false)),
          'description'     => new sfValidatorString(array('required' => false)),
          'created_at'      => new sfValidatorDateTime(array('required' => false)),
          'updated_at'      => new sfValidatorDateTime(array('required' => false)),
        ));

    $this->widgetSchema->setNameFormat('carpools[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

//        // Route subform
//        $subForm = new sfForm();
//        $theRoute = new Routes();
//        $this->route = $theRoute;
//        $form = new RoutesForm($theRoute);
//        $subForm->embedForm(1, $form);
//        $this->embedForm('route', $subForm);
    }

    public function  save($con = null) {

        // Create the route from the javascript object
//        $jRoute = json_decode($this->getRequestParameter('route'));
//        $request->getParameter('carpool_id')
//        sfContext::getInstance()->getLogger()->info(var_dump($jRoute));
//
//        $routeToSave = new Routes();
//        $routeToSave->setCopyright($jRoute->{'copyright'});
//
//        $routeToSave->save();
//        $this->routeId = $routeToSave->getRouteId();
        

        // Call the parent's save function
        parent::save($con);
    }
}
