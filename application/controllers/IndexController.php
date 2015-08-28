<?php

class Default_IndexController extends Zend_Controller_Action
{
    
    protected $_flashMessenger;

    public function preDispatch() {
        
    	if (!Zend_Auth::getInstance()->hasIdentity()) {
    	    
    	    $actions = array('index', 'login');
    		if(!in_array($this->_request->getActionName(), $actions)) {
    			$requestUri = Zend_Controller_Front::getInstance()->getRequest()->getRequestUri();
    			$session = new Zend_Session_Namespace('lastRequest');
    			$session->lastRequestUri = $requestUri;
    			$session->lock();
    			
    			if($this->_request->getActionName() != "login")
    				$this->_redirect('/index/login');
    			
    		}
    	}
    	
    }
    
    public function init()
    {
        /* Initialize action controller here */
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->view->flashMessenger = $this->_flashMessenger;
    }

    public function indexAction()
    {
        $article = new Model_ArticleMapper();

        $pagination = Zend_Paginator::factory($article->fetchAll());
        if (count($pagination) == 0) {
        	$this->view->is_article_empty = true;
        }
        
        $pagination->setCurrentPageNumber($this->_request->getParam('page', 1));
        $pagination->setItemCountPerPage(4);
        $this->view->articles = $pagination;
        unset($pagination);
  
        
    }
    
    public function addAction()
    {
    	$form = new Form_Article();
    	$form->setAction($this->getFrontController()->getBaseUrl() . '/index/add');
    	$request = $this->getRequest();
    	
    	if($request->isPost()) {
    	    if(!$form->isValid($request->getPost())) {
    	        // handle the error
    	    } else {
    	        $article = new Model_Article($this->_request->getParams());
    	        $articleMapperModel = new Model_ArticleMapper();
    	        $articleMapperModel->save($article);
    	        $this->_flashMessenger->addMessage('Added Successfully!', 'success');
    	        $this->_redirect('/index/index');

    	    }
    	}
    	
    	$this->view->form = $form;
    
    }
    
    public function editAction()
    {
    	$form = new Form_Article();
    	$articleMapper = new Model_ArticleMapper();
    	$article = new Model_Article();
        $articleMapper->find($this->_request->id, $article);

    	$form->populate(array(
    	        'name' => $article->getName(),
    	        'email' =>  $article->getEmail(),
    	        'text' => $article->getText(),
    	        'id' => $article->getId()
    	         ));
    	
    	$form->setAction($this->getFrontController()->getBaseUrl() . '/index/edit');
    	$form->getElement('submit')->setLabel('::Update::');
    	
    	$request = $this->getRequest();
    	 
    	if($request->isPost()) {
    		if(!$form->isValid($request->getPost())) {
    			// handle this error time is up.. 
    		} else {
    			$article = new Model_Article($this->_request->getParams());
    			$ArticleMapperModel = new Model_ArticleMapper();
    			$ArticleMapperModel->save($article);
    			$this->_flashMessenger->addMessage('Updated Successfully!', 'success');
    			$this->_redirect('/index/index');
    		}
    	}

    	$this->view->form = $form;

    }
    
    
    public function deleteAction()
    {
    	$articleMapper = new Model_ArticleMapper();
    	$articleMapper->delete($this->_request->id);
    
        $this->_flashMessenger->addMessage('Deleted!', 'success');
        $this->_redirect('/index/index');
    }
    
    
    
public function loginAction() {
    
    $this->_helper->layout->setLayout('admin_login');

    if ($this->_request->isPost()) {
    
    	$db = Zend_Registry::get("db");
    
    	$username = $this->_request->getParam('username');
    	$password = $this->_request->getParam('password');
    
    	$db = Zend_Registry::get('db');
    	$authDbAdapter = new Zend_Auth_Adapter_DbTable($db, 'users', 'username', 'password', "MD5(?) and status=1");
    	$authDbAdapter->setIdentity($username);
    	$authDbAdapter->setCredential($password);

    	try {
    	    
    		$result = Zend_Auth::getInstance()->authenticate($authDbAdapter);
    		if ($result->isValid()) { //auth sucess
    
    			Zend_Auth::getInstance()->getStorage()->write($result->getIdentity());

    			//redirect to the last requested page (if applicable)
    			$session = new Zend_Session_Namespace('lastRequest');
    			if (isset($session->lastRequestUri)) {
    				$newpage = $session->lastRequestUri;
    				$session->lastRequestUri = NULL;
    				$this->_redirect($newpage);
    				return;
    			}
    			$this->_redirect('/index');
    		} else {
    			$this->view->error = "The username/password combination you supplied is not valid.";
    		}
    
    
    	} catch (Exception $e) {
    	    //log this but no time 
    	    $e->getMessage();
    	}
    
    
    }
    
    
    }

    public function logoutAction() {
    	$this->_helper->viewRenderer->setNoRender(true);
    
    	Zend_Auth::getInstance()->clearIdentity();
    	$this->_redirect('/index/index');
    }

}

