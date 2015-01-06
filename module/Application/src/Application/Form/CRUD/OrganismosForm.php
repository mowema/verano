<?php
namespace Application\Form\CRUD;
use Zend\Form\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;


class OrganismosForm extends Form
{
	protected $objectManager;

	public function __construct(ObjectManager $objectManager, $name = null)
	{
		$this->setObjectManager($objectManager);
                
		parent::__construct('organismo');
		$this->setAttribute('class', 'form-horizontal');
		 
		$this->setAttribute('method', 'POST');
	
		$this->add(array(
                    'type' => 'Application\Form\CRUD\OrganismosFieldset',
                    'options' => array(
                            'use_as_base_fieldset' => true
                    )
		));
                
                
                $this->add(array(
                    'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
                    'name'    => 'parent_id',
                    'options' => array(
                        'label'          => 'Dependiente de',
                        'object_manager' => $this->getObjectManager(),
                        'target_class'   => 'Application\Entity\Organismos',
                        'property'       => 'nombre',
                        'empty_option'   => '--- Seleccione Sector ---'
                    ),
                    'attributes' => array(
                        'class' =>	'form-control',

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
                
                /*$this->setValidationGroup(array(
                     'organismos' => array(
                         'nombre','sigla'
                     )
                 ));*/
                
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
