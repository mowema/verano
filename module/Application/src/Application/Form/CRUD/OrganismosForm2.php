<?php
/*
https://github.com/doctrine/DoctrineModule/blob/master/docs/hydrator.md#a-complete-example-using-zendform

http://framework.zend.com/manual/2.0/en/modules/zend.form.collections.html

https://github.com/doctrine/DoctrineModule/blob/master/docs/form-element.md


*/



namespace Application\Form\CRUD;
use Zend\Form\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;


class OrganismosForm extends Form
{
	public function __construct(ObjectManager $objectManager)
	{
		parent::__construct('organismo');
		$this->setAttribute('class', 'form-horizontal');
		 
		$this->setAttribute('method', 'POST');
		
		// The form will hydrate an object of type "BlogPost"
        $this->setHydrator(new DoctrineHydrator($objectManager));

        // Add the user fieldset, and set it as the base fieldset
        $organismosFieldset = new OrganismosFieldset($objectManager);
        $organismosFieldset->setUseAsBaseFieldset(true);
        $this->add($organismosFieldset);
		
		
		
		
		/*
	
		$this->add(array(
                    'type' => 'Application\Form\CRUD\OrganismosFieldset',
                    'options' => array(
                            'use_as_base_fieldset' => true
                    )
		));
         */       
                

	
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

}
