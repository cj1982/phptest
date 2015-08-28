<?php
class Exozet_Controller_Plugin_Utilities extends Zend_Controller_Plugin_Abstract
{
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        $front = Zend_Controller_Front::getInstance();
        if (! ($front->getPlugin('Zend_Controller_Plugin_ErrorHandler') instanceof Zend_Controller_Plugin_ErrorHandler))
            return;
        $error = $front->getPlugin('Zend_Controller_Plugin_ErrorHandler');
        $testRequest = new Zend_Controller_Request_HTTP();
        
        

        $testRequest->setModuleName($request->getModuleName())
            ->setControllerName('index')
            ->setActionName('index');
        if ($front->getDispatcher()->isDispatchable($testRequest)) {
            $error->setErrorHandlerModule($request->getModuleName());
        }
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request) {      
        $this->stagingAuth($request);
    }



}