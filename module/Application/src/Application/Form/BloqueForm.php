<?php
namespace Application\Form;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class BloqueForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('noticias');
		$this->setAttribute('class', 'form-horizontal');
		
		$this->setAttribute('method', 'POST')
			  ->setHydrator(new ClassMethodsHydrator(false))
			  ->setInputFilter(new InputFilter());
	
		$this->add(array(
				'type' => 'Application\Form\BloqueFieldset',
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
						'class' => 'btn btn-default'
				)
		));
	}
}
