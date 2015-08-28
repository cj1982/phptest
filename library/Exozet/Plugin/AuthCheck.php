<?php

class Exozet_Plugin_AuthCheck extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {

        $function =  $request->getModuleName().'AuthCheck';

        if( method_exists($this, $function) ) $this->$function($request);
    }





}
?>
