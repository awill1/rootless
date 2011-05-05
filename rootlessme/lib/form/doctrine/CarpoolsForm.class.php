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
        // Embedded route subform
        $solo_route = new Routes();
        $this->getObject()->Routes_3 = $solo_route;
        $solo_route_form = new RoutesForm($solo_route);
        $this->embedForm('route', $solo_route_form);

//        $this->embedRelation('Routes_3');

//        $this->setWidget('origin', new sfWidgetFormInputText());
//        $this->setWidget('destination', new sfWidgetFormInputText());
//        $this->setWidget('route', new sfWidgetFormInputHidden());

        unset($this['created_at']);
        unset($this['updated_at']);

        $this->useFields(array(
            'carpool_id',
            'route',
            'driver_id',
            'vehicle_id',
            'route_id',
            'seats_available',
            'start_date',
            'start_time',
            'asking_price',
            'description'));

      
//        $this->setWidgets(array(
//          'carpool_id'      => new sfWidgetFormInputHidden(),
//          'route'           => new sfWidgetFormInputHidden(),
//          'origin'          => new sfWidgetFormInputText(),
//          'destination'     => new sfWidgetFormInputText(),
//          'driver_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
//          'vehicle_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehicles'), 'add_empty' => false)),
//          'route_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'), 'add_empty' => false)),
//          'solo_route_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes_3'), 'add_empty' => false)),
//          'seats_available' => new sfWidgetFormInputText(),
//          'start_date'      => new sfWidgetFormDate(),
//          'start_time'      => new sfWidgetFormTime(),
//          'asking_price'    => new sfWidgetFormInputText(),
//          'description'     => new sfWidgetFormTextarea(),
//          'created_at'      => new sfWidgetFormDateTime(),
//          'updated_at'      => new sfWidgetFormDateTime(),
//        ));

//        $this->setValidators(array(
//          'carpool_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('carpool_id')), 'empty_value' => $this->getObject()->get('carpool_id'), 'required' => false)),
//          'route'           => new sfValidatorString(array('required' => false)),
//          'driver_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
//          'origin'          => new sfValidatorString(array('required' => false)),
//          'destination'     => new sfValidatorString(array('required' => false)),
//          'vehicle_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vehicles'))),
//          'route_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'))),
//          'solo_route_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Routes_3'))),
//          'seats_available' => new sfValidatorInteger(array('required' => false)),
//          'start_date'      => new sfValidatorDate(array('required' => false)),
//          'start_time'      => new sfValidatorTime(array('required' => false)),
//          'asking_price'    => new sfValidatorNumber(array('required' => false)),
//          'description'     => new sfValidatorString(array('required' => false)),
//          'created_at'      => new sfValidatorDateTime(array('required' => false)),
//          'updated_at'      => new sfValidatorDateTime(array('required' => false)),
//        ));

//    $this->widgetSchema->setNameFormat('carpools[%s]');
//    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

//    $this->setupInheritance();
        

        

//        // Route subform
//        $subForm = new sfForm();
//        $theRoute = new Routes();
//        $this->route = $theRoute;
//        $form = new RoutesForm($theRoute);
//        $subForm->embedForm(1, $form);
//        $this->embedForm('route', $subForm);
    }
    
    public function doSave($con = null) {
        // Overriding the default doSave to chage the order of the saved objects
        if (null === $con)
        {
          $con = $this->getConnection();
        }

        // embedded forms
        $this->saveEmbeddedForms($con);

        // Manually do what is in updateObject();
        //$this->updateObject();
        $values = $this->values;
        $values = $this->processValues($values);
        $this->doUpdateObject($values);
        // Do not update the object of the embedded forms because the pk gets
        // updated to '' which deletes the row
        // embedded forms
        //$this->updateObjectEmbeddedForms($values);
        //return $this->getObject();


        $this->getObject()->save($con);


        
    }

//    public function  save($con = null) {
//
//        // Create the route from the javascript object
////        $jRoute = json_decode($this->getRequestParameter('route'));
////        $request->getParameter('carpool_id')
////        sfContext::getInstance()->getLogger()->info(var_dump($jRoute));
////
////        $routeToSave = new Routes();
////        $routeToSave->setCopyright($jRoute->{'copyright'});
////
////        $routeToSave->save();
////        $this->routeId = $routeToSave->getRouteId();
//
//        // Call the parent's save function
//        parent::save($con);
//    }
}
