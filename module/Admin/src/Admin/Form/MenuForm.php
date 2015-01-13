<?php

namespace Admin\Form;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class MenuForm extends Form
{
	
	public function __construct()
	{
		
		parent::__construct('menu');
		
		$this->setAttribute('class', 'form-horizontal');
		
		$this->setAttribute('method', 'POST')
			->setHydrator(new ClassMethodsHydrator(false))
			->setInputFilter(new InputFilter());
	
		$this->add(array(
				'type' => 'Admin\Form\MenuFieldset',
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
						'type' => 'submit',
						'value' => 'Guardar',
						'class' => 'btn'
				)
		));

		
	}
	
	
}
