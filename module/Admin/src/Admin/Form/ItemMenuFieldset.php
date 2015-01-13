<?php
namespace Admin\Form;
 
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Admin\Entity\Menu;
 
 
class ItemMenuFieldset extends Fieldset implements InputFilterProviderInterface
{
	
  public function __construct()
  {
  	
  	parent::__construct('itemmenu');

       	 $this->setAttribute('method', 'post');
         $this->setHydrator(new ClassMethodsHydrator(false))
          	  ->setObject(new Menu());
             
 
    $this->add(array(
	      'name' => 'id',
	      'attributes' => array(
	        'type' => 'hidden'
	      )
    		
    ));

    $this->add(array(
    		'name' => 'title',
    		'options' => array(
    				'label' => 'Título'
    		),
    		'attributes' => array(
    				'type' => 'text',
    				'required' => 'required'
    		)
    ));
    
    $this->add(array(
    		'name' => 'alias',
    		'options' => array(
    				'label' => 'Alias'
    		),
    		'attributes' => array(
    				'type' => 'text',
    		)
    ));
    $this->add(array(
    		'name' => 'path',
    		'options' => array(
    				'label' => 'Ruta'
    		),
    		'attributes' => array(
    				'type' => 'text',
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