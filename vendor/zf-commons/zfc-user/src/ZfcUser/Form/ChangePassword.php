<?php

namespace ZfcUser\Form;

use Zend\Form\Form;
use Zend\Form\Element\Csrf;
use ZfcBase\Form\ProvidesEventsForm;
use ZfcUser\Options\AuthenticationOptionsInterface;
use ZfcUser\Module as ZfcUser;

class ChangePassword extends ProvidesEventsForm
{
    /**
     * @var AuthenticationOptionsInterface
     */
    protected $authOptions;

    public function __construct($name = null, AuthenticationOptionsInterface $options)
    {
        $this->setAuthenticationOptions($options);
        parent::__construct($name);
        $this->setAttribute('class', 'form-horizontal');

        $this->add(array(
            'name' => 'identity',
            'options' => array(
                'label' => '',
            ),
            'attributes' => array(
                'type' => 'hidden'
            ),
        ));

        $this->add(array(
            'name' => 'credential',
            'options' => array(
                'label' => 'Actual contraseña',
                 'label_attributes' => array(
                     'class'  => 'col-md-3 control-label'
                 ),
            ),
            'attributes' => array(
                'type' => 'password',
                'class' => 'form-control'
            ),
        ));

        $this->add(array(
            'name' => 'newCredential',
            'options' => array(
                'label' => 'Nueva contraseña',
                 'label_attributes' => array(
                     'class'  => 'col-md-3 control-label'
                 ),
            ),
            'attributes' => array(
                'type' => 'password',
                'class' => 'form-control'
            ),
        ));

        $this->add(array(
            'name' => 'newCredentialVerify',
            'options' => array(
                'label' => 'Verifique nueva contraseña',
                 'label_attributes' => array(
                     'class'  => 'col-md-3 control-label'
                 ),
            ),
            'attributes' => array(
                'type' => 'password',
                'class' => 'form-control'
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Actualizar',
                'type'  => 'submit',
                'class' => 'btn btn-primary'
            ),
        ));

        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * Set Authentication-related Options
     *
     * @param AuthenticationOptionsInterface $authOptions
     * @return Login
     */
    public function setAuthenticationOptions(AuthenticationOptionsInterface $authOptions)
    {
        $this->authOptions = $authOptions;
        return $this;
    }

    /**
     * Get Authentication-related Options
     *
     * @return AuthenticationOptionsInterface
     */
    public function getAuthenticationOptions()
    {
        return $this->authOptions;
    }
}
