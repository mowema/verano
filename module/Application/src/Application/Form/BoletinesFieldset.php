<?php
namespace Application\Form;
 
use Application\Entity\Boletin;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
 
 
class BoletinesFieldset extends Fieldset implements InputFilterProviderInterface
{
  public function __construct()
  {
  
    parent::__construct('boletines');

    	 $date = new \DateTime('now');
    	 $this->setAttribute('method', 'post');
         $this->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new Boletin());
             
 
    $this->add(array(
	      'name' => 'id',
	      'attributes' => array(
	        'type' => 'hidden'
	      )
    		
    ));

    $this->add(array(
	      'name' => 'titulo',
	      'options' => array(
	      	  'label' => 'Titulo'
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