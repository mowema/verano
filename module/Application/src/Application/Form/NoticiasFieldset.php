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
	      'name' => 'title',
	      'options' => array(
	      	  'label' => 'Titulo'
	      ),
	      'attributes' => array(
	      	  'type' => 'text',
	      	  'required' => 'required',
	      	 'id'   => 'title',
	      )
    ));
 
    $this->add(array(
	      'name' => 'copete',
	      'required' => true,
	      'options' => array(
	       	 'label' => 'Copete'
	      ),
	      'attributes' => array(
	       	 'type' => 'textarea',
	      	 'id'   => 'copete',
	      	 'class'=> 'mceEditorL',
	      	 
	      )
    		
    ));
    $this->add(array(
	      'name' => 'bajada',
	      'required' => true,
	      'options' => array(
	       	 'label' => 'Cuerpo Noticia'
	      ),
	      'attributes' => array(
	       	 'type' => 'textarea',
	      	 'id'   => 'bajada',
	      	 'class'=> 'mceEditorF',
	      	 
	      )
    		
    ));
    
    $this->add(array(
	      'name' => 'imagen_url',
	      'options' => array(
	      	  'label' => 'Url de la imagen'
	      ),
	      'attributes' => array(
	      	  'type' => 'text',
                  
	      	 'id'   => 'imagen_url',
	      )
    ));
   
     
  }
  
  
  
    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
                'required' => true,
            )
        );
    }
}