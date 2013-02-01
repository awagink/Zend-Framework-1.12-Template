<?php

class Backend_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->headTitle("Index");
        $this->view->url = $this->getRequest()->getBaseUrl();
    }

    /* Controllers */
    public function indexAction()
    { 
    	
    }
    
    public function testAction()
    {

       
    }
    
}