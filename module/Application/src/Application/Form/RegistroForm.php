<?php

namespace Application\Form;

use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class RegistroForm extends Form {

    public function __construct(ObjectManager $objectManager) {
        $this->setObjectManager($objectManager);
        parent::__construct('registro');
        $this->setAttribute('class', 'form-horizontal');
        //$this->setAttribute('onsubmit', 'return copyContent()');
        $this->setAttribute('method', 'POST');


        $this->setHydrator(new DoctrineHydrator($objectManager));

        // Add the user fieldset, and set it as the base fieldset
        $fieldset = new RegistroFieldset($objectManager);
        $fieldset->setUseAsBaseFieldset(true);
        $this->add($fieldset);


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
                'class' => 'btn btn-primary btn-lg pull-right'
            )
        ));
    }

    public function setObjectManager(ObjectManager $objectManager) {
        $this->objectManager = $objectManager;

        return $this;
    }

    public function getObjectManager() {
        return $this->objectManager;
    }

}
