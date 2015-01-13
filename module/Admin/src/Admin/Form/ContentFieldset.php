<?php
namespace Admin\Form;
 
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Admin\Entity\Content;
 
 
class ContentFieldset extends Fieldset implements InputFilterProviderInterface
{
	
	protected $objectManager;
	
  public function __construct()
  {
  	
  	parent::__construct('content');

       	 $this->setAttribute('method', 'post');
         $this->setHydrator(new ClassMethodsHydrator(false))
          	  ->setObject(new Content());
             
 
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
    		'name' => 'mintit',
    		'options' => array(
    				'label' => '2 palabras'
    		),
    		'attributes' => array(
    				'type' => 'text',
    		)
    ));
    
    $this->add(array(
    		'name' => 'copy',
    		'options' => array(
    				'label' => 'Copete'
    		),
    		'attributes' => array(
    				'type' => 'textarea',

    		)
    ));
    
    $this->add(array(
    		'name' => 'body',
    		'options' => array(
    				'label' => 'Cuerpo'
    		),
    		'attributes' => array(
    				'type' => 'textarea',
    		)
    ));
    
    $this->add(array(
    		'name' => 'address',
    		'options' => array(
    				'label' => 'Dirección'
    		),
    		'attributes' => array(
    				'type' => 'text',
    				'required' => 'required'
    		)
    ));
    
    $this->add(array(
    		'name' => 'image',
    		'options' => array(
    				'label' => 'Imagen'
    		),
    		'attributes' => array(
    				'type' => 'text',
    		)
    ));
    
    $this->add(array(
    		'name' => 'video',
    		'options' => array(
    				'label' => 'Video'
    		),
    		'attributes' => array(
    				'type' => 'text',
    		)
    ));
    
    $this->add(array(
    		'name' => 'youtube',
    		'options' => array(
    				'label' => 'Youtube'
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