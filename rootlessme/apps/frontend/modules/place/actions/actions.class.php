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

            // Validate the input parameters

            // Create a ride to the place
            if (!is_null($startDate) || $startDateAny)
            {

            }

            // Create a ride back from the place
            if (!is_null($startDate) || $startDateAny)
            {

            }

            // Run recommendations on the rides

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
