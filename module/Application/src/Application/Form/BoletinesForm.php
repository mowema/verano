<?php
namespace Application\Form;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class BoletinesForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('boletines');
		$this->setAttribute('class', 'form-horizontal');
		
		$this->setAttribute('method', 'post')
			->setHydrator(new ClassMethodsHydrator(false))
			->setInputFilter(new InputFilter());
	
		$this->add(array(
				'type' => 'Application\Form\BoletinesFieldset',
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
						'class' => 'btn'
						
				)
		));
	}
}
