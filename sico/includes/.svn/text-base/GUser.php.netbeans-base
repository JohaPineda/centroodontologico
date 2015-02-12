<?php
defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');
Class GUser{

    private $id;
    private $name;
    private $alias;
    private $mail;
    private $ip;
    private $perfil;

    function __construct($identifier = 0,$nombre="VISITANTE",$email= null, $perfiladd= null,$nick= null) {
        $this->id = $identifier;
        $this->name = $nombre;
        $this->mail = $email;
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->perfil=$perfiladd;
        $this->alias=$nick;
    }

    function getNameUser() {
        return $this->name;
    }
    
    function getIdUser() {
        return $this->id;
    }
    
    function getAliasUser() {
        return $this->alias;
    }
    
    function getMailUser() {
        return $this->mail;
    }
    
    function getPerfilUser() {
        return $this->perfil;
    }
    
    function getIpUser() {
        return $this->ip;
    }

}

?>