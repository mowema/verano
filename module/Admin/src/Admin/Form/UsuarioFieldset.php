<?php
namespace Admin\Form;


use Application\Entity\User;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
 
 
class UsuarioFieldset extends Fieldset implements InputFilterProviderInterface
{
  public function __construct()
  {

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
          	    'attributes' => array('maxlength' => '128', 'size' => '32', 'type' => 'email','required' => 'required'),
            	'options' => array('label' => 'Email', 'appendText' => '@'), 
    ));
    
    $this->add(array(
    		'name' => 'displayName',
    		'options' => array(
    				'label' => 'Nombre'
    		),
    		'attributes' => array(
    				'type' => 'text',
    				'required' => 'required'
    		)
    ));

    	
     $this->add(array(
	            'name' => 'password',
	            'type' => 'Zend\Form\Element\Password',
	            'attributes' => array('maxlength' => '128', 'size' => '32'),
	            'options' => array('label' => 'Password'),
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
            'name' => array(
                'required' => true,
            )
        );
    }
}