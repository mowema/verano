<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @ORM\Entity(repositoryClass="Admin\Entity\Repositories\MenuRepository")
 * @ORM\Table(name="menu")
 */
class Menu
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
     * @ORM\ManyToOne(targetEntity="Menu")
     */
     protected $parent;

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
       
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param field_type $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return the $alias
	 */
	public function getAlias() {
		return $this->alias;
	}

	/**
	 * @param field_type $alias
	 */
	public function setAlias($alias) {
		$this->alias = $alias;
	}

	/**
	 * @return the $parent
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * @param field_type $parent
	 */
	public function setParent($parent_id) {
		$this->parent = $parent_id;
	}

	/**
	 * @return the $path
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * @param field_type $path
	 */
	public function setPath($path) {
		$this->path = $path;
	}

	/**
	 * @return the $extension
	 */
	public function getExtension() {
		return $this->extension;
	}

	/**
	 * @param field_type $extension
	 */
	public function setExtension($extension) {
		$this->extension = $extension;
	}

	/**
	 * @return the $created_date
	 */
	public function getCreatedDate() {
		return $this->created_date;
	}

	/**
	 * @param field_type $created_date
	 */
	public function setCreatedDate($created_date) {
		$this->created_date = $created_date;
	}

	/**
	 * @return the $modified_date
	 */
	public function getModifiedDate() {
		return $this->modified_date;
	}

	/**
	 * @param field_type $modified_date
	 */
	public function setModifiedDate($modified_date) {
		$this->modified_date = $modified_date;
	}

	/**
	 * @return the $created
	 */
	public function getCreatedBy() {
		return $this->created;
	}

	/**
	 * @param field_type $created
	 */
	public function setCreatedBy($created) {
		$this->created = $created;
	}

	/**
	 * @return the $modified
	 */
	public function getModifiedBy() {
		return $this->modified;
	}

	/**
	 * @param field_type $modified
	 */
	public function setModifiedBy($modified) {
		$this->modified = $modified;
	}

	/**
	 * @return the $state
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * @param field_type $state
	 */
	public function setState($state) {
		$this->state = $state;
	}

       
	
	

}