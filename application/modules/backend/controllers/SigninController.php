<?php

class Backend_SigninController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->view->request = $this->_request;
        $this->view->url = $this->_request->getBaseUrl();
        $this->view->headTitle("Admin");
    }
    
	public function indexAction()
    { 
	    $authNamespace = new Zend_Session_Namespace('identify');

		if( isset($authNamespace->id) && isset($authNamespace->user) ) {
			$this->_helper->redirector('index', 'index');
		}
		
		$this->view->session = 'false';
        $form = new Backend_Form_Signin();   
        $this->view->form = $form;
        $request = $this->getRequest();
        
        if ( $request->isPost() )
        {
        	if ( $form->isValid($request->getPost()) )
        	{
        		if($this->_getAuthAdapter( $form->getValues() )) {
        			$this->_redirect('/admin');
        			
        		} else { $error[] = 'Invalid User or password'; }
        	} else { $error[] = 'Some fields are empty'; }
        	 
        	if($error){
        		$this->view->error = '<div class="errors">Acceso denegado</div>';
        		return  false;
        	}
        }
	    
	}
	
	public function logoutAction()
    {
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
        $authNamespace = new Zend_Session_Namespace('identify');
    	$authNamespace->unsetAll();
    	$this->_redirect('/');
    }
	
	protected function _getAuthAdapter($values)
    {
        
    	$db = Zend_Registry::get('db');
		$authAdapter = new Zend_Auth_Adapter_DbTable($db);
			$authAdapter->setTableName('admin');
			$authAdapter->setIdentityColumn('user');
			$authAdapter->setCredentialColumn('pass');
			$authAdapter->setIdentity( $values['username'] );
			$authAdapter->setCredential( $values['password'] );
			$auth = Zend_Auth::getInstance();
			$result = $auth->authenticate($authAdapter);
			
				if ($result->isValid()) {	
					$username = $authAdapter->getResultRowObject(array('id','user','role'));
					$authNamespace = new Zend_Session_Namespace('identify');
					$authNamespace->id = $username->id;
					$authNamespace->user = $username->user;
					$authNamespace->role = $username->role;
					return $username->id;
				
				} else {
					$this->view->error = 'Acceso denegado';
					return false;
				}
     }
    
}