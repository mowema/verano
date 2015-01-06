<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @ORM\Entity(repositoryClass="Application\Entity\Repositories\RegistroRepository")
 * @ORM\Table(name="app_registro")
 */
class Registro {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", options={"default" = 1})
     */
    protected $tipo;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $direccion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $cpostal;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $provincia;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $localidad;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $telefono;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $web;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $blog;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $rsocial;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $referente;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $referentel;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $perfil;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $perfilotro;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_creacion;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    protected $fecha_modificado;

    /**
     * @ORM\Column(type="integer")
     */
    protected $estado;

    public function getId() {
        return $this->id;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getCpostal() {
        return $this->cpostal;
    }

    public function getProvincia() {
        return $this->provincia;
    }

    public function getLocalidad() {
        return $this->localidad;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getWeb() {
        return $this->web;
    }

    public function getBlog() {
        return $this->blog;
    }

    public function getRsocial() {
        return $this->rsocial;
    }

    public function getReferente() {
        return $this->referente;
    }

    public function getReferentel() {
        return $this->referentel;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function getPerfilotro() {
        return $this->perfilotro;
    }

    public function getFecha_creacion() {
        return $this->fecha_creacion;
    }

    public function getFecha_modificado() {
        return $this->fecha_modificado;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setCpostal($cpostal) {
        $this->cpostal = $cpostal;
    }

    public function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    public function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setWeb($web) {
        $this->web = $web;
    }

    public function setBlog($blog) {
        $this->blog = $blog;
    }

    public function setRsocial($rsocial) {
        $this->rsocial = $rsocial;
    }

    public function setReferente($referente) {
        $this->referente = $referente;
    }

    public function setReferentel($referentel) {
        $this->referentel = $referentel;
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    public function setPerfilotro($perfilotro) {
        $this->perfilotro = $perfilotro;
    }

    public function setFecha_creacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function setFecha_modificado($fecha_modificado) {
        $this->fecha_modificado = $fecha_modificado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function populate($data = array()) {

        $this->id = $data['id'];
        $this->titulo = $data['titulo'];
        $this->cuerpo = $data['cuerpo'];
        $this->fecha_creacion = $data['fecha_creacion'];
        $this->fecha_modificado = $data['fecha_modificado'];
        $this->estado = $data['estado'];
        $this->usuario_c = $data['usuario_c'];
        $this->usuario_m = $data['usuario_m'];
    }

}
