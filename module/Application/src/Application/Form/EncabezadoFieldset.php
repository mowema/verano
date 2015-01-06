<?php
namespace Application\Form;
 
use Application\Entity\Noticia;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
 
 
class EncabezadoFieldset extends Fieldset implements InputFilterProviderInterface
{
  public function __construct()
  {
  	
  	parent::__construct('noticias');

    $date = new \DateTime('now');
    	 $this->setAttribute('method', 'post');
         $this->setHydrator(new ClassMethodsHydrator(false))
          	  ->setObject(new Noticia());
             
 
    $this->add(array(
	      'name' => 'id',
	      'attributes' => array(
	        'type' => 'hidden'
	      )
    		
    ));
    
    $this->add(array(
    		'name' => 'tipo',
    		'attributes' => array(
    				'type' => 'hidden',
    				'value'=> '2'
    		)
    
    ));
      
    $this->add(array(
	      'name' => 'titulo',
	      'options' => array(
	    
	      ),
	      'attributes' => array(
	      	  'type' => 'text',
	      	  'required' => 'required',
	      	'class' => 'form-control'
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