<?php

class Custom_Controller_Plugin_Session extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    { 
    	if($request->module == 'backend'){
    		
			$authNamespace = new Zend_Session_Namespace('identify');
		    $exceptions = array('signin');
		    
		    if( empty($authNamespace->id) || empty($authNamespace->user) ) {
		    	
		    	if(!in_array($request->controller,$exceptions)) { 

					$request->setModuleName('frontend');
					$request->setControllerName('index');
					$request->setActionName('index');
		    	}
		    } 
		    return true;
    	} 
    	
    }
}