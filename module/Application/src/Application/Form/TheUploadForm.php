<?php

namespace Application\Form;

use Zend\InputFilter;
use Zend\Form\Form;
use Zend\Form\Element;

class TheUploadForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->setAttribute('class', 'form-horizontal');
        $this->addElements();
     
    }

    public function addElements()
    {
        // File Input
        $file = new Element\File('file');
        $file
            ->setLabel('Subir imagen')
            ->setAttributes(array(
                'id' => 'file',
            ));
      
        // submit
        $submit = new Element\Submit('cargar');
        $submit->setValue('Cargar');
        $this->add($file);
        $this->add($submit);
      
    }

}