<?php

namespace Admin\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UsuarioForm extends Form implements ObjectManagerAwareInterface
{	
	protected $objectManager;
	
	public function __construct(ObjectManager $objectManager, $id = null)
	{
		$this->setObjectManager($objectManager);
		
		parent::__construct('usuario');
		$this->setAttribute('class', 'form-horizontal');
		
		$this->setAttribute('method', 'POST')
			->setHydrator(new ClassMethodsHydrator(false))
			->setInputFilter(new InputFilter());
	
		$this->add(array(
				'type' => 'Admin\Form\UsuarioFieldset',
				'options' => array(
						'use_as_base_fieldset' => true
				)
		));
		
		$this->add(array(
				'type'    => 'DoctrineModule\Form\Element\ObjectMultiCheckBox',
				'name'    => 'roleid',
				'options' => array(
						'label'          => 'Seleccione rol',
						'object_manager' => $this->getObjectManager(),
						'target_class'   => 'Application\Entity\Role',
						'property'       => 'roleId',
						'empty_option'   => '--- Seleccione rol ---'
				),
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
		
		if ($id){
				
			$usuario = $this->getObjectManager()->getRepository('Application\Entity\User')->find($id);
		    
			if ($usuario){
				// PARA OBTENER EL VALUE DE CHECKBOX ROLES
				foreach ($usuario->getRoles() as $roles):
							
					$rolesId[] = $roles->getId();

				endforeach;
				
				
				
				if(isset($rolesId)){
									
					$this->get('roleid')->setValue($rolesId);
				}
								
			}
		}
		
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
