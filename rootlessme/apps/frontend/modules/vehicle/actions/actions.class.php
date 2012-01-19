<?php

/**
 * vehicle actions.
 *
 * @package    RootlessMe
 * @subpackage vehicle
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vehicleActions extends sfActions
{
    /**
     * Executes the show action
     * @param sfWebRequest $request The web request
     */
    public function executeShow(sfWebRequest $request)
    {
        $this->vehicle = Doctrine_Core::getTable('Vehicles')->find(array($request->getParameter('vehicle_id')));
        $this->forward404Unless($this->vehicle);
    }

    /**
     *
     * @param sfWebRequest $request The web request
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new VehiclesForm();
    }

    /**
     * Executes the create action
     * @param sfWebRequest $request The web request
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new VehiclesForm();
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
    }

    /**
     * Executes the edit action
     * @param sfWebRequest $request The web request
     */
    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($vehicle = Doctrine_Core::getTable('Vehicles')->find(array($request->getParameter('vehicle_id'))), sprintf('Object vehicle does not exist (%s).', $request->getParameter('vehicle_id')));
        $this->form = new VehiclesForm($vehicle);
    }

    /**
     * Executes the update action
     * @param sfWebRequest $request The web request
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($vehicle = Doctrine_Core::getTable('Vehicles')->find(array($request->getParameter('vehicle_id'))), sprintf('Object vehicle does not exist (%s).', $request->getParameter('vehicle_id')));
        $this->form = new VehiclesForm($vehicle);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    /**
     * Binds and saves a form to the database
     * @param sfWebRequest $request The web request
     * @param sfForm $form The form to process
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $vehicle = $form->save();

            $this->redirect('vehicle/edit?vehicle_id='.$vehicle->getVehicleId());
        }
    }
}
