<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
*
* @ORM\Entity(repositoryClass="Admin\Entity\Repositories\ContentRepository")
* @ORM\Table(name="content")
*/
class Content
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
       * @ORM\ManyToOne(targetEntity="Admin\Entity\Category")
       */
       protected $category;
       
       /**
       * @ORM\Column(type="string")
       */
       protected $minitit;
       
       /**
       * @ORM\Column(type="text")
       */
       protected $copy;
       
       /**
        * @ORM\Column(type="text")
        */
       protected $body;
       
       /**
       * @ORM\Column(type="text")
       */
       protected $address;
       
       /**
       * @ORM\Column(type="text")
       */
       protected $image;

       /**
       * @ORM\Column(type="text")
       */
       protected $video;
       
       /**
       * @ORM\Column(type="string")
       */
       protected $state;
       
       /**
       * @ORM\Column(type="string")
       */
       protected $youtube;

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
        * @ORM\Column(type="integer")
        */
       protected $hits;
       
       /**
       * @ORM\ManyToOne(targetEntity="Application\Entity\User")
       */
       protected $created;

       /**
       * @ORM\ManyToOne(targetEntity="Application\Entity\User")
       */
       protected $modified;
       

            

       /*/public function __construct()
       {
             $this->boletin = new ArrayCollection();

       }
       * 
        */
    
       
       /**
       * @return the $id
       */
       public function getId() {
             return $this->id;
       }

       /**
       * @param field_type $id
       */
       public function setId($id) {
             $this->id = $id;
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
       * @return the $category
       */
       public function getCategory() {
             return $this->category;
       }

       /**
       * @param field_type $category
       */
       public function setCategory($category) {
             $this->category = $category;
       }

       /**
       * @return the $minitit
       */
       public function getMinitit() {
             return $this->minitit;
       }

       /**
       * @param field_type $minitit
       */
       public function setMinitit($minitit) {
             $this->minitit = $minitit;
       }

       /**
       * @return the $copy
       */
       public function getCopy() {
             return $this->copy;
       }

       /**
       * @param field_type $copy
       */
       public function setCopy($copy) {
             $this->copy = $copy;
       }
       
       /**
        * @return the $copy
        */
       public function getBody() {
       	return $this->body;
       }
       
       /**
        * @param field_type $copy
        */
       public function setBody($body) {
       	$this->body = $body;
       }

       /**
       * @return the $address
       */
       public function getAddress() {
             return $this->address;
       }

       /**
       * @param field_type $address
       */
       public function setAddress($address) {
             $this->address = $address;
       }

       /**
       * @return the $image
       */
       public function getImage() {
             return $this->image;
       }

       /**
       * @param field_type $image
       */
       public function setImage($image) {
             $this->image = $image;
       }

       /**
       * @return the $video
       */
       public function getVideo() {
             return $this->video;
       }

       /**
       * @param field_type $video
       */
       public function setVideo($video) {
             $this->video = $video;
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

       /**
       * @return the $youtube
       */
       public function getYoutube() {
             return $this->youtube;
       }

       /**
       * @param field_type $youtube
       */
       public function setYoutube($youtube) {
             $this->youtube = $youtube;
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
       * @return the $modify_date
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
       
       public function getHits() {
       	return $this->hits;
       }
       
       /**
        * @param field_type $modified
        */
       public function setHits($hits) {
       	$this->hits = $hits;
       }




}

