<?php

class Backend_Bootstrap extends Zend_Application_Module_Bootstrap
{
	protected function _initSession()
    {
        $this->bootstrap("frontController");
        $this->frontController->registerPlugin(new Custom_Controller_Plugin_Session()); 
    }
    
    protected function _initAcl()
    {

    	$helper = new Application_Model_Library_Acl_Backend();
		$helper->setRoles();
		$helper->setResources();
		$helper->setPrivilages();
		$helper->setAcl();

		$this->bootstrap("frontController");
		$this->frontController->registerPlugin(new Custom_Controller_Plugin_Acl());
		
    }
   
	
}