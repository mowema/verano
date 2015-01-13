<?php

namespace Admin\Form;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\Common\Persistence\ObjectManager;

class ItemMenuForm extends Form
{
	protected $objectManager;
	
	public function __construct(ObjectManager $objectManager, $id = null)
	{
		$this->setObjectManager($objectManager);
		
		parent::__construct('itemmenu');
		
		$this->setAttribute('class', 'form-horizontal');
		
		$this->setAttribute('method', 'POST')
			->setHydrator(new ClassMethodsHydrator(false))
			->setInputFilter(new InputFilter());
	
		$this->add(array(
				'type' => 'Admin\Form\ItemMenuFieldset',
				'options' => array(
						'use_as_base_fieldset' => true
				)
		));
		
	//	$id ? $menu = $objectManager->find('Admin\Entity\Menu', $id)->getParent()->getId() : $menu = '';
		
		$this->add(array(
				'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
				'name'    => 'menuitem',
				'options' => array(
						'label'          => 'Seleccione Menú',
						'object_manager' => $this->getObjectManager(),
						'target_class'   => 'Admin\Entity\Menu',
						'property'       => 'title',
						'empty_option'   => '--- Seleccione Menu ---',
				),
				'attributes' => array(
						'class' =>	'form-control',
				//		'value'    => $menu
							
		
		
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
