<?php 
class Backend_AlbumsController extends Zend_Controller_Action
{
	
 	public function init()
    {
    	$this->view->headTitle("Albums");
        $this->view->url = $this->_request->getBaseUrl();
    }
    
	public function indexAction()
    {  
    	$mysql = new Application_Model_DbTable_Albums();
		$results = $mysql->rowset(null, 'title DESC');
		$this->view->results = $results;
    }
    
    
    public function detailsAction()
    {
    	$id = $this->_getParam('id',null);
    
    	if(!empty($id)){
    		
    		$mysql = new Application_Model_DbTable_Albums();
    		$results = $mysql->get($id);
    		
    		if($results){
    			$this->view->results = $results;
    			
    		} else { $this->_redirect('/admin/albums'); }
    		
    	} else { $this->_redirect('/admin/albums'); }
    
    }
    
	public function addAction()
	{
		
		$form = new Backend_Form_Albums();
		$this->view->form = $form;
		
		$request = $this->getRequest();
		if ( $request->isPost() ) :
			if ( $form->isValid($request->getPost()) ) {

				$title = $form->getValue('title');
				$artist = $form->getValue('artist');
				$genre = $form->getValue('genre');
				
				$mysql = new Application_Model_DbTable_Albums();
				$mysql->save( $title, $artist, $genre );

				$this->_redirect('/admin/albums');
				
			} else {
				$form->populate($request->getPost());
			}
		endif;
	}
	
	public function editAction()
	{
		$id = $this->_getParam('id',null);
		
		if( !empty($id) && !is_null($id) ) {
			
			$mysql = new Application_Model_DbTable_Albums();
			$results = $mysql->get($id);

			if($results) {
			
				$form = new Backend_Form_Albums();
				$this->view->form = $form;
				$request = $this->getRequest();
				
				if ( $request->isPost() ) :
				
					$post = $request->getPost(); 
					
					if ( $form->isValid($post) ) {
							
						$title = $form->getValue('title');
						$artist = $form->getValue('artist');
						$genre = $form->getValue('genre');
						
						$mysql->change( $id, $title, $artist, $genre );
						
						$this->_redirect('/admin/albums');
						
					} else {
						$form->populate($post);
					}
					
				else:
					$populate = $form->populate( $results );
				endif;
			
			} 
			
		} else { $this->_redirect('/admin/albums'); }
		
	}
	
	public function deleteAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		$id = $this->_getParam('id',null);
		
		if(!empty($id)){
			
			$mysql = new Application_Model_DbTable_Albums();
			$results = $mysql->remove($id);
			
		} else { $this->_redirect('/admin/albums'); }
		
	}
	
    
}