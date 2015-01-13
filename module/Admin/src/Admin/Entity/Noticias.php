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
     * @ORM\Column(type="text", nullable=true)
	 */
	 protected $title;
	 
	 /**
     * @ORM\Column(type="text", nullable=true)
	  */
	 protected $copete;
         
	 /**
     * @ORM\Column(type="text", nullable=true)
	  */
	 protected $bajada;
         
	 /**
     * @ORM\Column(type="text", nullable=true)
	  */
	 protected $imagen_url;
	
         
         
         
         
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
        * @ORM\Column(type="integer")
        */
       protected $state;
	/**
	 * @return the $id
	 */
       
       
	function getId() {
            return $this->id;
        }

        function getTitle() {
            return $this->title;
        }

        function getCopete() {
            return $this->copete;
        }

        function getBajada() {
            return $this->bajada;
        }

        function getImagen_url() {
            return $this->imagen_url;
        }

        function getCreated_date() {
            return $this->created_date;
        }

        function getModified_date() {
            return $this->modified_date;
        }

        function getCreated() {
            return $this->created;
        }

        function getModified() {
            return $this->modified;
        }

        function getState() {
            return $this->state;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setTitle($title) {
            $this->title = $title;
        }

        function setCopete($copete) {
            $this->copete = $copete;
        }

        function setBajada($bajada) {
            $this->bajada = $bajada;
        }

        function setImagen_url($imagen_url) {
            $this->imagen_url = $imagen_url;
        }

        function setCreated_date($created_date) {
            $this->created_date = $created_date;
        }

        function setModified_date($modified_date) {
            $this->modified_date = $modified_date;
        }

        function setCreated($created) {
            $this->created = $created;
        }

        function setModified($modified) {
            $this->modified = $modified;
        }

        function setState($state) {
            $this->state = $state;
        }


	

}