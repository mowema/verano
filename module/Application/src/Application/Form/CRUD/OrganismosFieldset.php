<?php

namespace Application\Form\CRUD;

use Application\Entity\Organismos;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;



class OrganismosFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct() {

        parent::__construct('organismos');

        //$this->setAttribute('method', 'get');
        $this->setHydrator(new ClassMethodsHydrator(false))
                ->setObject(new Organismos());

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