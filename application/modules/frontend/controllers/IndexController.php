<?php

class IndexController extends Zend_Controller_Action
{
	public function init()
    {
        $this->view->url = $this->getRequest()->getBaseUrl();
    }

    public function indexAction()
    {
    	$this->view->headTitle("ZF Template");
		
    	$word = $this->_getParam('q',null);

 		$mysql = new Application_Model_DbTable_Albums();
		$results = $mysql->search($word);
		$this->view->results = $results;


    }


}

