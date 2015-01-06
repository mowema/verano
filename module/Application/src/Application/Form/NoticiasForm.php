<?php
namespace Application\Form;
use Zend\Form\Form;


class NoticiasForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('noticias');
		$this->setAttribute('class', 'form-horizontal');
		 
		$this->setAttribute('method', 'POST');
	
		$this->add(array(
				'type' => 'Application\Form\NoticiasFieldset',
				'options' => array(
						'use_as_base_fieldset' => true
				)
		));
	
  
                
		$this->add(array(
				'type' => 'Zend\Form\Element\Csrf',
				'name' => 'csrf'
		));
       
		$this->add(array(
				'name' => 'submit',
				'type' => 'Zend\Form\Element\Submit',
				'attributes' => array(
						'value' => 'Guardar',
						'type' => 'submit',
						'class' => 'btn'
				)
		));
	}
   
}
