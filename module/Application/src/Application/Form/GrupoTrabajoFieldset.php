<?php
namespace Application\Form;
 
use Application\Entity\GrupoTrabajo;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
 
 
class GrupoTrabajoFieldset extends Fieldset implements InputFilterProviderInterface
{
  public function __construct()
  {
  	
  	parent::__construct('grupotrabajo');

  		 $date = new \DateTime('now');
       	 $this->setAttribute('method', 'post');
         $this->setHydrator(new ClassMethodsHydrator(false))
          	  ->setObject(new GrupoTrabajo());
             
 
    $this->add(array(
	      'name' => 'id',
	      'attributes' => array(
	        'type' => 'hidden'
	      )
    		
    ));

    $this->add(array(
	      'name' => 'nombre',
	      'options' => array(
	      	  'label' => 'Nombre'
	      ),
	      'attributes' => array(
	      	  'type' => 'text',
	      	  'required' => 'required'
	      )
    ));
    
    $this->add(array(
    		'name' => 'descripcion',
    		'options' => array(
    				'label' => 'Descripcion'
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