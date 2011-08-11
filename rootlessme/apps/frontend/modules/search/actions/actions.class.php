<?php

/**
 * search actions.
 *
 * @package    RootlessMe
 * @subpackage search
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class searchActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
     public function executeSearch(sfWebRequest $request)
     {
         //$this->forward('default', 'module');

         // The query parameter has to exist, otherwise forward to the
         // travelers page
         $this->forwardUnless($query = $request->getParameter('query'), 'profile', 'index');

         // Get the profiles of the users based on the query
         $this->profiles = Doctrine_Core::getTable('Profiles')->getForLuceneQuery($query);

         // Get the rides (later)

         // Get the locations (later)
     }
}
