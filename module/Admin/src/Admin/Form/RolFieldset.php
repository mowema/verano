<?php
namespace Admin\Form;
 
use Application\Entity\Role;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
 
 
class RolFieldset extends Fieldset implements InputFilterProviderInterface
{
  public function __construct()
  {
  	
  	parent::__construct('rol');

       	 $this->setAttribute('method', 'post');
         $this->setHydrator(new ClassMethodsHydrator(false))
          	  ->setObject(new Role());
             
 
    $this->add(array(
	      'name' => 'id',
	      'attributes' => array(
	        'type' => 'hidden'
	      )
    		
    ));

    $this->add(array(
    		'name' => 'roleId',
    		'options' => array(
    				'label' => 'Rol'
    		),
    		'attributes' => array(
    				'type' => 'text',
    				'required' => 'required'
    		)
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