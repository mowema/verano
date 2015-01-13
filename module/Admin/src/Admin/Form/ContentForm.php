<?php

namespace Admin\Form;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\Common\Persistence\ObjectManager;

class ContentForm extends Form
{
	protected $objectManager;
	
	public function __construct(ObjectManager $objectManager, $id = null)
	{
		$this->setObjectManager($objectManager);
		
		parent::__construct('content');
		$this->setAttribute('class', 'form-horizontal');
		
		$this->setAttribute('method', 'POST')
			->setHydrator(new ClassMethodsHydrator(false))
			->setInputFilter(new InputFilter());
	
		$this->add(array(
				'type' => 'Admin\Form\ContentFieldset',
				'options' => array(
						'use_as_base_fieldset' => true
				)
		));
		
		$id ? $cat = $objectManager->find('Admin\Entity\Content', $id)->getCategory()->getId() : $cat = '';
			
		$this->add(array(
				'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
				'name'    => 'category',
				'options' => array(
						'label'          => 'Seleccione Categoría',
						'object_manager' => $this->getObjectManager(),
						'target_class'   => 'Admin\Entity\Category',
						'property'       => 'title',
						'empty_option'   => '--- Seleccione Categoría ---',
				),
				'attributes' => array(
						'class' =>	'form-control',
						'required' => 'required',
						'value'    => $cat
					
						
						
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

		//$this->get('category')->setValue($rolesId);
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
