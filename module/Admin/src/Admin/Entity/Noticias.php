<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 *
 * @ORM\Entity(repositoryClass="Admin\Entity\Repositories\NoticiasRepository")
 * @ORM\Table(name="a_noticias")
 */
class Noticias
{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer");
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string")
	 */
	 protected $title;
	 
	 /**
	  * @ORM\Column(type="string")
	  */
	 protected $alias;
	
         

     /**
     * @ORM\Column(type="string")
     */
       protected $path;

     /**
     * @ORM\Column(type="string")
     */
       protected $extension;
      
      /**
      * @ORM\Column(type="datetime", options={"default" = "0000-00-00 00:00:00"})
      *
      */
       protected $created_date;
        
       /**
        * @ORM\Column(type="datetime", options={"default" = "0000-00-00 00:00:00"})
        *
        */
       protected $modified_date;
        
       /**
        * @ORM\ManyToOne(targetEntity="Application\Entity\User")
        */
       protected $created;
       
       /**
        * @ORM\ManyToOne(targetEntity="Application\Entity\User")
        */
       protected $modified;
       
       /**
        * @ORM\Column(type="string")
        */
       protected $state;
	/**
	 * @return the $id
	 */
       
       
	
	

}