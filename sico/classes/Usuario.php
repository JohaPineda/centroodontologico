<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class Usuario {

    private $id;
    private $id_estado;
    private $nombre;
    private $ciudad;
    private $alias;
    private $password;
    private $perfil;
    private $cedula;
    private $direccion;
    private $barrio;
    private $telefono;
    private $movil;
    private $fax;
    private $fecha_ingreso;
    private $email;
    private $id_padre;
    private $rango;
    private $fecha_nacimiento;

    public function __construct($id=null, $id_estado=null, $nombre=null, $ciudad=null, $alias=null, $password=null, 
            $perfil=null, $cedula=null, $direccion=null, $telefono=null, $movil=null, $fax=null, $fecha_ingreso=null,
            $email=null, $barrio=null, $id_padre=null, $rango=null, $fecha_nacimiento=null) {
        $this->id = $id;
        $this->id_estado = $id_estado;
        $this->nombre = $nombre;
        $this->ciudad = $ciudad;
        $this->alias = $alias;
        $this->password = $password;
        $this->perfil = $perfil;
        $this->cedula = $cedula;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->movil = $movil;
        $this->fax = $fax;
        $this->fecha_ingreso = $fecha_ingreso;
        $this->email = $email;
        $this->barrio = $barrio;
        $this->id_padre = $id_padre;
        $this->rango = $rango;
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdEstado() {
        return $this->id_estado;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function getAlias() {
        return $this->alias;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getMovil() {
        return $this->movil;
    }

    public function getFax() {
        return $this->fax;
    }

    public function getFechaIngreso() {
        return $this->fecha_ingreso;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getIdPadre() {
        return $this->id_padre;
    }

    public function getRango() {
        return $this->rango;
    }

    public function getFechaNacimiento() {
        return $this->fecha_nacimiento;
    }
    public function getBarrio() {
        return $this->barrio;
    }

    public function setBarrio($value) {        
        $this->barrio = $value ? $value:'';
    }

    public function setId($value) {
        $this->id = $value;
    }

    public function setIdEstado($value) {
        $this->id_estado = $value;
    }

    public function setNombre($value) {
        $this->nombre = $value;
    }

    public function setCiudad($value) {
        $this->ciudad = $value;
    }

    public function setAlias($value) {
        $this->alias = $value;
    }

    public function setPassword($value) {
        $this->password = $value;
    }

    public function setPerfil($value) {
        $this->perfil = $value;
    }

    public function setCedula($value) {
        $this->cedula = $value;
    }

    public function setDireccion($value) {
        $this->direccion = $value;
    }

    public function setTelefono($value) {
        $this->telefono = $value ? $value:0;
    }

    public function setMovil($value) {
        $this->movil = $value ? $value:0;
    }

    public function setFax($value) {
        $this->fax = $value ? $value:0;
    }

    public function setFechaIngreso($value) {
        $this->fecha_ingreso = $value;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function setIdPadre($value) {
        $this->id_padre = $value;
    }

    public function setRango($value) {
        $this->rango = $value;
    }

    public function setFechaNacimiento($value) {
        $this->fecha_nacimiento = $value ? $value:'1900-01-01';
    }

}

?>
