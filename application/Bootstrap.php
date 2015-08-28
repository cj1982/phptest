<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    
    public function __construct($application)
    {
     parent::__construct($application);
    }
    
    protected function _initAutoload()
    {
    	 
    	Zend_Controller_Action_HelperBroker::addPrefix('Exozet_Controller_Action_Helper');
    
    	$autoloader = new Zend_Application_Module_Autoloader(
    			array(
    					'namespace' => '',
    					'basePath' => APPLICATION_PATH,
    					'resourceTypes' => array(
    							'form' => array(
    									'path' => 'forms',
    									'namespace' => 'Form',
    							),
    							'model' => array(
    									'path' => 'models',
    									'namespace' => 'Model',
    							),
    					)
    			)
    	);
    
    	return $autoloader;
    }
    
     
    
    protected function _initLayoutHelper()
    {
    	$this->bootstrap('frontController');
    	 
    	$layout = Zend_Controller_Action_HelperBroker::addHelper(new Exozet_Controller_Action_Helper_LayoutLoader());
    
    }
    
    protected function _initApplication()
    {
    
    	$config = new Zend_Config_Ini(APPLICATION_PATH . "/configs/application.ini", APPLICATION_ENV);
    	Zend_Registry::set("config", $config);
    
    
    	$locale = new Zend_Locale();
    	Zend_Registry::set('Zend_Locale', $locale);
    
    	
    	//init DB connection
    	try {
    
    		$this->bootstrap('multidb');
    		$multiDb = $this->getPluginResource('multidb');
    
    		$db = $multiDb->getDb('default');
    		$db->setFetchMode(Zend_Db::FETCH_OBJ);
    		$db->getConnection();
    
    
    		Zend_Registry::set('db', $db);
    
    		//Just making everything UTF8. This is a hack, need to find the proper Zend way
    		$db     = Zend_Registry::get('db');
    		$db->query('SET NAMES "utf8"')->execute();
    
    		Zend_Registry::set('db', $db);
    
    
    	} catch (Zend_Db_Adapter_Exception $e) {
    		 
    		die("Error connecting to database: " . $e->getMessage());
    
    	}
    	
   
    
    
    }
    
    public function _initErrorHandlers()
    {
    
    	 
    }
    
    public function _initRoutes()
    {
    
    }
    
    
    protected function _initLanguages()
    {
    
    
    }
    
    
    protected function _initZFDebug()
    {
    	//Enabling this method seems to break autocomplete. Use only when needed
    
    	/*
    	$autoloader = Zend_Loader_Autoloader::getInstance ();
    	$autoloader->registerNamespace('ZFDebug');
    
    	$db = Zend_Registry::get('db');
    
    	$cache = Zend_Cache::factory('Core','File');
    
    	//Zend_Controller_Front::getInstance()->getBaseUrl();
    	//APPLICATION_PATH
    	$options = array ('plugins' => array ('Variables', 'Database' => array ('adapter' => $db ), 'File' => array ('basePath' => Zend_Controller_Front::getInstance ()->getBaseUrl () ), 'Memory', 'Time', 'Registry', 'Cache' => array ('backend' => $cache->getBackend () ), 'Exception' ) );
    
    	$debug = new ZFDebug_Controller_Plugin_Debug ( $options );
    
    	$this->bootstrap ( 'frontController' );
    	$frontController = $this->getResource ( 'frontController' );
    	$frontController->registerPlugin ( $debug );
    	*/
    
    }
    
    
}

