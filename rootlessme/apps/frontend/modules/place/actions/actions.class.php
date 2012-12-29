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
    public function executeIndex(sfWebRequest $request)
    {
        $this->places = Doctrine_Core::getTable('Places')
          ->createQuery('a')
          ->execute();
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->place = Doctrine_Core::getTable('Places')->find(array($request->getParameter('place_id')));
        $this->forward404Unless($this->place);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new PlacesForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new PlacesForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($place = Doctrine_Core::getTable('Places')->find(array($request->getParameter('place_id'))), sprintf('Object place does not exist (%s).', $request->getParameter('place_id')));
        $this->form = new PlacesForm($place);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($place = Doctrine_Core::getTable('Places')->find(array($request->getParameter('place_id'))), sprintf('Object place does not exist (%s).', $request->getParameter('place_id')));
        $this->form = new PlacesForm($place);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($place = Doctrine_Core::getTable('Places')->find(array($request->getParameter('place_id'))), sprintf('Object place does not exist (%s).', $request->getParameter('place_id')));
        $place->delete();

        $this->redirect('place/index');
    }
  
    /**
     * Executes the CreateRideToPlace action
     * @param sfWebRequest $request The web request
     */
    public function executeCreateRideToPlace(sfWebRequest $request)
    {
        //Success variable and message
        $success = 'false';
        
        try
        {
            // Load the AWS SDK
            require_once sfConfig::get('app_amazon_sdk_file');
        
            // Make sure the user is authenticated

            // Get the input parameters
            $placeId = $request->getParameter('place_id');
            $rideType = $request->getParameter('ride_type');
            $origin = $request->getParameter('origin');
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
            
            // Create the user's rides
            $departurePassenger = NULL;
            $departureCarpool = NULL;
            $returnPassenger = NULL;
            $returnCarpool = NULL;

            // Create a ride to the place
            if (!is_null($startDate) || $startDateAny)
            {
                if (CommonHelpers::IsNullOrEmptyString($startDate) && $startDateAny)
                {
                    $startDate = null;
                }
                elseif (!CommonHelpers::IsNullOrEmptyString($startDate)) 
                {
                    $startDate = date('Y-m-d H:i:s', strtotime($startDate));
                }
                
                // If the user is a passenger or either, create the passenger post
                if ($rideType == 'ride' || $rideType == 'either')
                {
                    $departurePassenger = PassengerFactory::createRide($startDate, $startTime, $person, $passengerSeats, $passengerPrice, $departureRouteData, $originData, $destinationData, $otherDetails);
                }
                // If the user will drive, create the driver post
                if ($rideType == 'drive' || $rideType == 'either')
                {
                    $departureCarpool = CarpoolFactory::createRide($startDate, $startTime, $person, $driverSeats, $driverPrice, $departureRouteData, $originData, $destinationData, $otherDetails);
                }
            }

            // Create a ride back from the place
            if (!is_null($returnDate) || $returnDateAny)
            {
                if (CommonHelpers::IsNullOrEmptyString($returnDate) && $returnDateAny)
                {
                    $returnDate = null;
                }
                elseif (!CommonHelpers::IsNullOrEmptyString($returnDate)) 
                {
                    $returnDate = date('Y-m-d H:i:s', strtotime($returnDate));
                }
                
                // If the user is a passenger or either, create the passenger post
                if ($rideType == 'ride' || $rideType == 'either')
                {
                    $returnPassenger = PassengerFactory::createRide($startDate, $startTime, $person, $passengerSeats, $passengerPrice, $returnRouteData, $destinationData, $originData, $otherDetails);
                }
                // If the user will drive, create the driver post
                if ($rideType == 'drive' || $rideType == 'either')
                {
                    $returnCarpool = CarpoolFactory::createRide($startDate, $startTime, $person, $driverSeats, $driverPrice, $returnRouteData, $destinationData, $originData, $otherDetails);
                }
            }

            // Run recommendations on the rides
            // Do recommendations
            $searchRadius = sfConfig::get('app_default_search_distance');
            $recommendedDeparturePassengers = NULL;
            $recommendedDepartureDrivers = NULL;
            $recommendedReturnPassengers = NULL;
            $recommendedReturnDrivers = NULL;
            if (!is_null($departureCarpool))
            {
                $recommendedDeparturePassengers = $departureCarpool->recommendPassengers($searchRadius);
            }
            if (!is_null($departurePassenger))
            {
                $recommendedDepartureDrivers = $departurePassenger->recommendDrivers($searchRadius);
            }
            if (!is_null($returnCarpool))
            {
                $recommendedReturnPassengers = $returnCarpool->recommendPassengers($searchRadius);
            }
            if (!is_null($returnPassenger))
            {
                $recommendedReturnDrivers = $returnPassenger->recommendDrivers($searchRadius);
            }

            // If this was an ajax request
            if ($request->isXmlHttpRequest())
            {
                // Return success json with no layout
                $this->setLayout(sfView::NONE);
                return $this->renderText("{ success: true }");
            }
            else
            {
                // This is not an ajax request

            }
            
        }
        catch (Exception $e)
        {
            // Log the error
            $this->logMessage($e->getMessage()."; ".$e->getTraceAsString(), 'err');
            // Return the error json
            return $this->renderText('{ success: false, message: "'.$e->getMessage().'" }');
        }
        
        
    }

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
