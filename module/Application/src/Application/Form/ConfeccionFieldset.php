<?php
namespace Application\Form;
 
use Application\Entity\Boletin;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
 
class ConfeccionFieldset extends Fieldset implements InputFilterProviderInterface
{
  public function __construct()
  {
  
    parent::__construct('confeccion');

    	 $date = new \DateTime('now');
    	 $this->setAttribute('method', 'post');
         $this->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new Boletin());
     
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