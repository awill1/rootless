<?php

/**
 * recommendations actions.
 *
 * @package    RootlessMe
 * @subpackage recommendations
 * @author     aaron
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class recommendationsActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        
    }
    
    /**
     * Executes find passengers action
     *
     * @param sfRequest $request A request object
     */
    public function executeFindPassengers(sfWebRequest $request)
    {
        // Get the ride id parameter
        $rideId = $request->getParameter('rideId');
                
        // Get the driver to find passengers for
        $this->driver = Doctrine_Core::getTable('Carpools')->find($rideId);
        
        // Create recommendations
        $recommendations = $this->driver->recommendPassengers(10);
        
        $this->passengers = new Doctrine_Collection('Passengers');
        foreach ($recommendations as $recommendation) 
        {
            $this->passengers->add($recommendation->getPassengers());
        }
        
        $this->timeElapsed = 0;
    }
    
    /**
     * Executes find drivers action
     *
     * @param sfRequest $request A request object
     */
    public function executeFindDrivers(sfWebRequest $request)
    {
        // Get the ride id parameter
        $rideId = $request->getParameter('rideId');
        
        // Get the passenger to find drivers for
        $this->passenger = Doctrine_Core::getTable('Passengers')->find($rideId);

        // Create recommendations
        $recommendations = $this->passenger->recommendDrivers(10);
        
        $this->drivers = new Doctrine_Collection('Carpools');
        foreach ($recommendations as $recommendation) 
        {
            $this->drivers->add($recommendation->getCarpools());
        }
        
        $this->timeElapsed = 0;
    }
}
