<?php

class Form_Article extends Zend_Form
{
    
    public $buttonDecorators = array(
    		'ViewHelper',
    		'Errors',
    		array(array('data' => 'HtmlTag'), array('align' => 'right'))
    );
    
    

    public function init()
    {
        // Set the method for the display form to POST
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setMethod('post');


        // Add name element
        $this->addElement('text', 'name', array(
        		'label' => 'Article Name:',
        		'required' => true,
        		'size' => 250,
        		'class' => 'txt-input medium validate(required, rangelength(1,250))',
        		'filters'    => array('StringTrim'),
        		'validators' =>  array(        
                     array('StringLength', false, array(1, 250))
        		)
        ));

       // Add email element
       $this->addElement('text', 'email', array(
    		  'label' => 'Email:',
    		  'required' => true,
    		  'size' => 250,
    		  'class' => 'txt-input medium validate(required, rangelength(1,250))',
    		   'filters'    => array('StringTrim'),
               'validators' => array('EmailAddress',
            )
       ));
       
       // Add a text element
       $this->addElement('textarea', 'text', array(
       		'id' => 'wysiwyg',
       		'label' => 'Article Text :',
       		'required' => true,
       		'rows' => 5,
       		'filters' => array('StringTrim'),
       		'class' => 'textarea-input medium wysiwyg'
       ));
       
       $this->addElement('hidden', 'id');
       

    // Add the submit button
    $this->addElement('submit', 'submit', array(
      'ignore' => true,
      'label' => ':: Add ::',
      'decorators' => $this->buttonDecorators,
      'class' => 'submit button'
    ));
    }
}
