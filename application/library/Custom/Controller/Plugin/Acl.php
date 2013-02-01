<?php

class Custom_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch (Zend_Controller_Request_Abstract $request)
	{
		$controller = $request->controller;
	    $action = $request->action;
	    $module = $request->module;
	    
	    if ( $module == 'backend' ){
	    
			$authNamespace = new Zend_Session_NameSpace('identify');

			switch($authNamespace->role):
				case '1':
					$role = 'admin';
				break;
				default:
					$role = 'visitor';
			endswitch;

			$acl = Zend_Registry::get('acl_Backend');
			
		    if (!$acl->isAllowed($role, $controller, $action)) {
				$request->setModuleName('frontend');
				$request->setControllerName('error');
				$request->setActionName('error');
		    }
		   
	    }
	    
	}
	
}