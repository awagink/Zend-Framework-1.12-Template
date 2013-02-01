<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initConfig()
    {
    	Zend_Registry::set('config', new Zend_Config($this->getOptions()));
    }
    
	protected function _initPlugins()
    {
        $this->bootstrap("frontController");
        $this->frontController->registerPlugin(new Custom_Controller_Plugin_ErrorControllerSwitcher());
    }
    
	public function _initRouter( array $options = null ) {
		
		$frontControler = Zend_Controller_Front::getInstance();
	    $router = $frontControler->getRouter();
	    
	    $router->addRoute( 	"index", new Zend_Controller_Router_Route(
							"/buscar", array( 'module' => 'frontend', 'controller' => 'index', 'action' => 'search' ) ) );
		
		/* BACKEND MODULE */
		
		$router->addRoute("admin", new Zend_Controller_Router_Route(
				"/admin", array( 'module' => 'backend', 'controller' => 'index', 'action' => 'index' ) ));
		
		$router->addRoute("admin-signin", new Zend_Controller_Router_Route(
				"/admin/signin", array( 'module' => 'backend', 'controller' => 'signin', 'action' => 'index' ) ));
		
		$router->addRoute("admin-logout", new Zend_Controller_Router_Route(
				"/admin/logout", array( 'module' => 'backend', 'controller' => 'signin', 'action' => 'logout' ) ));
		
		$router->addRoute("admin-albums", new Zend_Controller_Router_Route(
				"/admin/albums", array( 'module' => 'backend', 'controller' => 'albums', 'action' => 'index' ) ));
		
		$router->addRoute("admin-albums-details", new Zend_Controller_Router_Route(
				"/admin/albums/details/:id", array( 'module' => 'backend', 'controller' => 'albums', 'action' => 'details' ) ));
		
		$router->addRoute("admin-albums-add", new Zend_Controller_Router_Route(
				"/admin/albums/add", array( 'module' => 'backend', 'controller' => 'albums', 'action' => 'add' ) ));
		
		$router->addRoute("admin-albums-edit", new Zend_Controller_Router_Route(
				"/admin/albums/edit/:id", array( 'module' => 'backend', 'controller' => 'albums', 'action' => 'edit' ) ));
		
		$router->addRoute("admin-albums-delete", new Zend_Controller_Router_Route(
				"/admin/albums/delete/:id", array( 'module' => 'backend', 'controller' => 'albums', 'action' => 'delete' ) ));
		
	}

	
}

