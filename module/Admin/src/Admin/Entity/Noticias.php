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
     * @ORM\Column(type="text", nullable=true)
	  */
	 protected $parametros;
         
         
         
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
        
       
        public function getId() {
            return $this->id;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getCopete() {
            return $this->copete;
        }

        public function getBajada() {
            return $this->bajada;
        }

        public function getImagen_url() {
            return $this->imagen_url;
        }

        public function getParametros() {
            return $this->parametros;
        }

        public function getCreated_date() {
            return $this->created_date;
        }

        public function getModified_date() {
            return $this->modified_date;
        }

        public function getCreated() {
            return $this->created;
        }

        public function getModified() {
            return $this->modified;
        }

        public function getState() {
            return $this->state;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setTitle($title) {
            $this->title = $title;
        }

        public function setCopete($copete) {
            $this->copete = $copete;
        }

        public function setBajada($bajada) {
            $this->bajada = $bajada;
        }

        public function setImagen_url($imagen_url) {
            $this->imagen_url = $imagen_url;
        }

        public function setParametros($parametros) {
            $this->parametros = $parametros;
        }

        public function setCreated_date($created_date) {
            $this->created_date = $created_date;
        }

        public function setModified_date($modified_date) {
            $this->modified_date = $modified_date;
        }

        public function setCreated($created) {
            $this->created = $created;
        }

        public function setModified($modified) {
            $this->modified = $modified;
        }

        public function setState($state) {
            $this->state = $state;
        }


}