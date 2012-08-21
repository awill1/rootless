<?php

/**
 * sfRoutesJs actions. Based on an article from
 * http://www.thewebshop.ca/blog/2010/10/a-javascript-implementation-of-symfonys-url_for/
 *
 * @package    RootlessMe
 * @subpackage sfRoutesJs
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfRoutesJsActions extends sfActions
{
    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        $this->setLayout(false);
        $this->getResponse()->setContentType('text/javascript');
        $this->routes = $this->makeRoutes();
    }
 
    protected function makeRoutes()
    {
        $routes = $this->getContext()->getRouting()->getRoutes();
        
        $parsed_routes = array();

        foreach ($routes as $name => $route)
        {
            $requirements = $route->getRequirements();

            $method = 'ANY';

            if (isset($requirements['sf_method']))
            {
                if (is_array($requirements['sf_method']))
                    $method = implode(', ', $requirements['sf_method']);
                else
                    $method = $requirements['sf_method'];
            }

            $method = strtoupper($method);

            $parsed_routes[$name] = array(
            'pattern' => $route->getPattern(),
            'method' => $method
            );
        }

        return $parsed_routes;
    }
}
