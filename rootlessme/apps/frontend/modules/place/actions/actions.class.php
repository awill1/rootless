<?php

/**
 * place actions.
 *
 * @package    RootlessMe
 * @subpackage place
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class placeActions extends sfActions
{
    /**
     * Executes the index action
     * @param sfWebRequest $request The web request
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->places = Doctrine_Core::getTable('Places')
          ->createQuery('a')
          ->leftJoin('a.Location l')
          ->where('a.is_deleted = false')
          ->execute();
    }

    /**
     * Executes the show action
     * @param sfWebRequest $request The web request
     */
    public function executeShow(sfWebRequest $request)
    {        
        $this->place = Doctrine_Core::getTable('Places')->find(array($request->getParameter('place_id')));
        $this->forward404Unless($this->place);
    }

    /**
     * Executes the new action
     * @param sfWebRequest $request The web request
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new PlacesWithLocationForm();
    }

    /**
     * Executes the create action
     * @param sfWebRequest $request The web request
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new PlacesWithLocationForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * Executes the edit action
     * @param sfWebRequest $request The web request
     */
    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($place = Doctrine_Core::getTable('Places')->find(array($request->getParameter('place_id'))), sprintf('Object place does not exist (%s).', $request->getParameter('place_id')));
        $this->form = new PlacesWithLocationForm($place);
    }

    /**
     * Executes the update action
     * @param sfWebRequest $request The web request
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($place = Doctrine_Core::getTable('Places')->find(array($request->getParameter('place_id'))), sprintf('Object place does not exist (%s).', $request->getParameter('place_id')));
        $this->form = new PlacesWithLocationForm($place);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    /**
     * Executes the delete action
     * @param sfWebRequest $request The web request
     */
    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($place = Doctrine_Core::getTable('Places')->find(array($request->getParameter('place_id'))), sprintf('Object place does not exist (%s).', $request->getParameter('place_id')));
        $place->setIsDeleted(true);
        $place->save();

        $this->redirect('places');
    }
  
    /**
     * Executes the CreateRideToPlace action
     * @param sfWebRequest $request The web request
     */
    public function executeCreateRideToPlace(sfWebRequest $request)
    {
        try
        {
            if (!$request->isMethod('post'))
            {      
                // GET is not supported
                throw new Exception('GET is not supported.');
            }
            
            // This method is only valid for ajax calls
            if (!$request->isXmlHttpRequest())
            {
                throw new Exception('Request must be XHR.');
            }
            
            // Load the AWS SDK
            require_once sfConfig::get('app_amazon_sdk_file');
            
            // This action always returns json
            $this->getResponse()->setContentType('application/json');
        
            // Make sure the user is authenticated
            $personId = null;
            $person = null;
            if ($this->getUser()->isAuthenticated())
            {
                $personId = $this->getUser()->getGuardUser()->getPersonId();
                $person = $this->getUser()->getGuardUser()->getPeople();
            }

            // Get the input parameters
            $placeId = $request->getParameter('place_id');
            $rideType = $request->getParameter('ride_type');
            $origin = $request->getParameter('origin');
            $destination = $request->getParameter('destination');
            $startDate = $request->getParameter('start_date');
            $startTime = $request->getParameter('start_time');
            $startDateAny = $request->getParameter('start_date_any');
            $returnDate = $request->getParameter('return_date');
            $returnTime = $request->getParameter('return_time');
            $returnDateAny = $request->getParameter('return_date_any');
            $driverSeats = $request->getParameter('driver_seats');
            $driverPrice = $request->getParameter('driver_price');
            $passengerSeats = $request->getParameter('passenger_seats');
            $passengerPrice = $request->getParameter('passenger_price');
            $otherDetails = $request->getParameter('other_details');
            $originData = $request->getParameter('origin_data');
            $destinationData = $request->getParameter('destination_data');
            $departureRouteData = $request->getParameter('departure_route_data');
            $returnRouteData = $request->getParameter('return_route_data');
            
            // Validate the input parameters
            if(CommonHelpers::IsNullOrEmptyString($placeId))
            {
                throw new Exception('Place id was not specified.');
            }
            if(CommonHelpers::IsNullOrEmptyString($rideType))
            {
                throw new Exception('Ride type was not specified.');
            }
            if(CommonHelpers::IsNullOrEmptyString($origin))
            {
                throw new Exception('Origin was not specified.');
            }
            if(CommonHelpers::IsNullOrEmptyString($destination))
            {
                throw new Exception('Destination was not specified.');
            }
            if(CommonHelpers::IsNullOrEmptyString($driverSeats))
            {
                throw new Exception('Driver seat count was not specified.');
            }
            if(CommonHelpers::IsNullOrEmptyString($passengerSeats))
            {
                throw new Exception('Passenger seat count was not specified.');
            }
            if(CommonHelpers::IsNullOrEmptyString($originData))
            {
                throw new Exception('Origin data was not specified.');
            }
            if(CommonHelpers::IsNullOrEmptyString($destinationData))
            {
                throw new Exception('Destination data was not specified.');
            }
            if(CommonHelpers::IsNullOrEmptyString($departureRouteData))
            {
                throw new Exception('Departure route data was not specified.');
            }
            if(CommonHelpers::IsNullOrEmptyString($returnRouteData))
            {
                throw new Exception('Return route data was not specified.');
            }
            
            // Create the user's rides
            $departurePassenger = NULL;
            $departureCarpool = NULL;
            $returnPassenger = NULL;
            $returnCarpool = NULL;

            // Create a ride to the place
            if (!CommonHelpers::IsNullOrEmptyString($startDate) || $startDateAny)
            {
                if ($startDateAny)
                {
                    $startDate = null;
                }
                elseif (!CommonHelpers::IsNullOrEmptyString($startDate)) 
                {
                    $startDate = date('Y-m-d H:i:s', strtotime($startDate));
                }
                
                // Set the time to null if it was anytime
                if (CommonHelpers::IsNullOrEmptyString($startTime))
                {
                    $startTime = null;
                }
                
                // If the user is a passenger or either, create the passenger post
                if ($rideType == 'passenger' || $rideType == 'either')
                {
                    $departurePassenger = PassengerFactory::createRide($startDate, $startTime, $person, $passengerSeats, $passengerPrice, $departureRouteData, $originData, $destinationData, $otherDetails);
                }
                // If the user will drive, create the driver post
                if ($rideType == 'driver' || $rideType == 'either')
                {
                    $departureCarpool = CarpoolFactory::createRide($startDate, $startTime, $person, $driverSeats, $driverPrice, $departureRouteData, $originData, $destinationData, $otherDetails);
                }
            }

            // Create a ride back from the place
            if (!CommonHelpers::IsNullOrEmptyString($returnDate) || $returnDateAny)
            {
                if ($returnDateAny)
                {
                    $returnDate = null;
                }
                elseif (!CommonHelpers::IsNullOrEmptyString($returnDate)) 
                {
                    $returnDate = date('Y-m-d H:i:s', strtotime($returnDate));
                }
                
                // Set the time to null if it was anytime
                if (CommonHelpers::IsNullOrEmptyString($returnTime))
                {
                    $returnTime = null;
                }
                
                // If the user is a passenger or either, create the passenger post
                if ($rideType == 'passenger' || $rideType == 'either')
                {
                    $returnPassenger = PassengerFactory::createRide($returnDate, $returnTime, $person, $passengerSeats, $passengerPrice, $returnRouteData, $destinationData, $originData, $otherDetails);
                }
                // If the user will drive, create the driver post
                if ($rideType == 'driver' || $rideType == 'either')
                {
                    $returnCarpool = CarpoolFactory::createRide($returnDate, $returnTime, $person, $driverSeats, $driverPrice, $returnRouteData, $destinationData, $originData, $otherDetails);
                }
            }

            // Run code on the created rides after they have already been created.
            //  - Tagging the rides with the place id for querying purposes
            //  - Do recommendations
            $searchRadius = sfConfig::get('app_default_search_distance');
            $recommendedDeparturePassengers = NULL;
            $recommendedDepartureDrivers = NULL;
            $recommendedReturnPassengers = NULL;
            $recommendedReturnDrivers = NULL;
            if (!is_null($departureCarpool))
            {
                $recommendedDeparturePassengers = $departureCarpool->recommendPassengers($searchRadius);
                $departureCarpool->getRoutes()->setDestinationPlaceId($placeId)->save();
            }
            if (!is_null($departurePassenger))
            {
                $recommendedDepartureDrivers = $departurePassenger->recommendDrivers($searchRadius);
                $departurePassenger->getRoutes()->setDestinationPlaceId($placeId)->save();
            }
            if (!is_null($returnCarpool))
            {
                $recommendedReturnPassengers = $returnCarpool->recommendPassengers($searchRadius);
                $returnCarpool->getRoutes()->setOriginPlaceId($placeId)->save();
            }
            if (!is_null($returnPassenger))
            {
                $recommendedReturnDrivers = $returnPassenger->recommendDrivers($searchRadius);
                $returnPassenger->getRoutes()->setOriginPlaceId($placeId)->save();
            }

            // Return success json with no layout
            $this->setLayout(sfView::NONE);
            return $this->renderText('{ "success": true }');            
        }
        catch (Exception $e)
        {
            // Log the error
            $this->logMessage($e->getMessage()."; ".$e->getTraceAsString(), 'err');
            // Set the error code
            $this->getResponse()->setStatusCode('500');
            // Return the error json
            return $this->renderText('{ "success": false, "message": "'.$e->getMessage().'" }');
        }
        
        
    }

    /**
     * Processes the form for saving.
     * @param sfWebRequest $request The web request
     * @param sfForm $form The form to process
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $place = $form->save();

            $this->redirect('place/edit?place_id='.$place->getPlaceId());
        }
    }
}
