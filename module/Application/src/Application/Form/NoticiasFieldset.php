<?php
namespace Application\Form;
 
use Admin\Entity\Noticias;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\InputFilter;
 
 
class NoticiasFieldset extends Fieldset implements InputFilterProviderInterface
{
  
  public function __construct()
  {
        
  	parent::__construct('noticias');
        
    	 $this->setAttribute('method', 'post');
         $this->setHydrator(new ClassMethodsHydrator(false))
          	  ->setObject(new Noticias());
      
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
 
    $this->add(array(
	      'name' => 'cuerpo',
	      'required' => true,
	      'options' => array(
	       	 'label' => 'Cuerpo Noticia'
	      ),
	      'attributes' => array(
	       	 'type' => 'textarea',
	      	 'id'   => 'content',
	      	 'class'=> 'article ',
	      	 'placeholder' => 'Ingrese el texto'
	      	 
	      )
    		
    ));
   
     
  }
  
  
  
    public function getInputFilterSpecification()
    {
        return array(
            'name' => array(
                'required' => true,
            )
        );
    }
}