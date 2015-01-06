<?php

namespace Application\Form\CRUD;

use Application\Entity\Organismos;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Persistence\ObjectManager;
//use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;



class OrganismosFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct(ObjectManager $objectManager) {

        parent::__construct('organismos');

        $this->setHydrator(new DoctrineHydrator($objectManager))
                ->setObject(new Organismos());

		$this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));
		
        $this->add(array(
            'name' => 'nombre',
            'options' => array(
                'label' => 'Nombre de Organismo o Sector'
            ),
            'attributes' => array(
                'type' => 'text',
                'required' => 'required',
                
            )
        ));
        
        $this->add(array(
            'name' => 'sigla',
            'options' => array(
                'label' => 'sigla'
            ),
            'attributes' => array(
                'type' => 'text',
                'col' => '2'
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
        
      
    }

    public function getInputFilterSpecification() {
        return array(
             'nombre' => array(
                'required' => true,
                'filters' => array(
                     array('name' => 'Zend\Filter\StripTags'),
                     array('name' => 'Zend\Filter\StringTrim'),
                 ),
                'validators' => array(
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                        'min' => 3,
                        'max' => 50,
                        ),
                    ),
                ),
            ),
            array('name' => 'sigla',
                'required' => true,
               
            ),
            array('name' => 'parent_id',
                'required' => false,
               
            )
        );
    }

}