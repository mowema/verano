<?php
namespace Application\Form;


use Application\Entity\User;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\Common\Persistence\ObjectManager;
 
 
class UsuarioFieldset extends Fieldset implements InputFilterProviderInterface
{
    
  protected $objectManager;
  public function __construct(ObjectManager $objectManager)
  {

    $this->setObjectManager($objectManager);
    parent::__construct('usuario');

    $this->setAttribute('method', 'post');
    $this->setHydrator(new ClassMethodsHydrator(false))
          	  ->setObject(new User());
             
    $this->add(array(
        'name' => 'id',
        'attributes' => array(
          'type' => 'hidden'
        )
    ));
    
    $this->add(array(
        'name' => 'displayName',
        'options' => array(
                        'label' => 'Nombre y Apellido'
        ),
        'attributes' => array(
                        'type' => 'text',
                        'required' => 'required'
        )
    ));

    $this->add(array(
        'name' => 'username',
        'options' => array(
            'label' => 'Usuario'
        ),
        'attributes' => array(
            'type' => 'text',
            'required' => 'required'
        )
    ));
    
    $this->add(array(
            'name' => 'email',
                'type' => 'Zend\Form\Element\Email',
                'attributes' => array(
                    'maxlength' => '128',
                    'size' => '32',
                    'type' => 'email',
                    'required' => 'required'),
                'options' => array(
                    'label' => 'Email',
                    'appendText' => '@'), 
    ));
    
     $this->add(array(
            'name' => 'password',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'maxlength' => '128',
                'size' => '32',
                'required' => 'required'),
            'options' => array('label' => 'Password'),
     ));
  
     $this->add(array(
            'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
            'name'    => 'organismo',
            'options' => array(
                'label'          => 'Organismo dependiente',
                'object_manager' => $objectManager,
                'target_class'   => 'Sip\Entity\Organismos',
                'property'       => 'nombre',
                'empty_option'   => '--- Seleccionar ---',
                'is_method'      => true,
            ),
            'attributes' => array(
                'class' =>'form-control chzn',
                'id' => 'organismo',
                'required' => 'required'
            ),
      ));
    
  }
   
  /**
   * Define InputFilterSpecifications
   *
   * @access public
   * @return array
   */
  
    public function getInputFilterSpecification()
    {
        return array(
            'displayName' => array(
                'required' => true,
            ),
            'organismo' => array(
                'required' => true,
            ),
            'password' => array(
                'required' => true,
            ),
            array(
                'name' => 'username',
                'required' => true,
                'filters' => array(
                     array('name' => 'Zend\Filter\StripTags'),
                     array('name' => 'Zend\Filter\StringTrim'),
                 ),
                'validators' => array(
                    array(
                        'name' => 'DoctrineModule\Validator\UniqueObject',
                        'options' => array(
                            'object_repository' => $this->objectManager->getRepository('Application\Entity\User'),
                            'object_manager' => $this->objectManager,
                            'fields' => 'username',
                            'messages' => array( \DoctrineModule\Validator\UniqueObject::ERROR_OBJECT_NOT_UNIQUE => "No se puede usar, ya está tomado." )
                        )
                    )
                )
            ),
            'email' => array(
                'required' => true,
                'filters' => array(
                     array('name' => 'Zend\Filter\StripTags'),
                     array('name' => 'Zend\Filter\StringTrim'),
                 ),
                'validators' => array(
                    array(
                        'name' => 'DoctrineModule\Validator\UniqueObject',
                        'options' => array(
                            'object_repository' => $this->objectManager->getRepository('Application\Entity\User'),
                            'object_manager' => $this->objectManager,
                            'fields' => 'username',
                            'messages' => array( \DoctrineModule\Validator\UniqueObject::ERROR_OBJECT_NOT_UNIQUE => "No se puede usar, ya está tomado." )
                        )
                    )
                )
            )
        );
    }
    
    public function setObjectManager(ObjectManager $objectManager) {
        $this->objectManager = $objectManager;

        return $this;
    }

    public function getObjectManager() {
        return $this->objectManager;
    }
}