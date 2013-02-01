<?php

class Application_Model_Library_Acl_Backend extends Zend_View_Helper_Abstract
{
	public $acl;
	
	public function __construct()
	{
		$this->acl = new Zend_Acl();
	}
	
	public function setRoles()
	{
		$this->acl->addRole(new Zend_Acl_Role('visitor'));
		$this->acl->addRole(new Zend_Acl_Role('admin'));
	}
	
	/* new Zend_Acl_Resource(module or controller) */
	public function setResources()
	{ 
		$this->acl->add(new Zend_Acl_Resource('backend'));
		$this->acl->add(new Zend_Acl_Resource('index'),'backend');
		$this->acl->add(new Zend_Acl_Resource('signin'),'backend');
		$this->acl->add(new Zend_Acl_Resource('albums'),'backend');
	}
	
	/* allow(resource,controller,action) */
	public function setPrivilages( )
	{
		$this->acl->allow('admin');
		$this->acl->deny('admin','signin');
		$this->acl->allow('admin','signin','logout');
		$this->acl->allow('visitor','signin');
	}
	
	public function setAcl()
	{
		Zend_Registry::set('acl_Backend',$this->acl);
	}
	
}