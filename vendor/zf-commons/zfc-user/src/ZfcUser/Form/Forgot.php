<?php

namespace ZfcUser\Form;

use Zend\InputFilter;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Captcha;

class Forgot extends Form
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
        $email = new Element\Email('email');
        $email
            ->setLabel('Email')
            ->setAttributes(array(
                'id' => 'email',
            ));
        $captcha = new Element\Captcha('captcha');
        $captchastring = new Captcha\Dumb();
        $captchastring->setLabel(' ');
        $captchastring->setWordlen('4');
        $captchastring->setMessages(array(\Zend\Captcha\AbstractWord::BAD_CAPTCHA => "Código incorrecto."));
        
        $captcha
            ->setLabel('Escriba al revés el siguiente código')
            ->setCaptcha($captchastring)
            ->setAttributes(array(
                'id' => 'captcha',
                'col' => '2',
            ));
        // submit
        $submit = new Element\Submit('aceptar');
        $submit->setValue('Aceptar');
        $this->add($email);
        $this->add($captcha);
        $this->add($submit);
      
    }
    
    

}