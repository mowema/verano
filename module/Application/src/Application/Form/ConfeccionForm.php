<?php
namespace Application\Form;

use Zend\Debug\Debug;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class ConfeccionForm extends Form
{
	public function __construct(ObjectManager $objectManager, $id = null)
	{
	//	Debug::dump($objectManager);
	//	exit();
		$this->setObjectManager($objectManager);
		
		parent::__construct('confeccion');
		$this->setAttribute('class', 'form-horizontal');
		
		$this->setAttribute('method', 'post')
			->setHydrator(new ClassMethodsHydrator(false))
			->setInputFilter(new InputFilter());
	
		$this->add(array(
				'type' => 'Application\Form\ConfeccionFieldset',
				'options' => array(
						'use_as_base_fieldset' => true
				)
		));
	
	
		$this->add(array(
				'type'    => 'DoctrineModule\Form\Element\ObjectMultiCheckBox',
				'name'    => 'noticiaid',
				'options' => array(
						'label'          => 'Asignar noticia a boletin',
						'object_manager' => $this->getObjectManager(),
						'target_class'   => 'Application\Entity\Noticia',
						'property'       => 'titulo',
						'empty_option'   => '--- Seleccione noticia ---'
				),
		));
		
		$this->add(array(
				'name' => 'submit',
				'attributes' => array(
						'type' => 'submit',
						'value' => 'Guardar'
						
				)
		));
		
		if ($id){
				
			$boletin = $this->getObjectManager()->getRepository('Application\Entity\Boletin')->find($id);
			
			if ($boletin && count($boletin)) {
								
				foreach ($boletin->getNoticia() as $noticia):
								
					$noticiasId[] = $noticia->getNoticia()->getId();
						
		//		Debug::dump($noticiasId);
		//		exit();
				endforeach;
				
				
				if(isset($noticiasId)){
									
					$this->get('noticiaid')->setValue($noticiasId);
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
