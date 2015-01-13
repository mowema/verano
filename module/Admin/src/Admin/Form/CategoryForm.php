<?php

namespace Admin\Form;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryForm extends Form
{
	protected $objectManager;
	
	public function __construct(ObjectManager $objectManager, $id = null)
	{
		$this->setObjectManager($objectManager);
		
		parent::__construct('category');
		$this->setAttribute('class', 'form-horizontal');
		
		$this->setAttribute('method', 'POST')
			->setHydrator(new ClassMethodsHydrator(false))
			->setInputFilter(new InputFilter());
	
		$this->add(array(
				'type' => 'Admin\Form\CategoryFieldset',
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
	
	
	
	public function setObjectManager(ObjectManager $objectManager)
	{
		$this->objectManager = $objectManager;
	
		return $this;
	}
	
	public function getObjectManager()
	{
		return $this->objectManager;
	}
}
