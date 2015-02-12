<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

abstract class ModelBase {

    protected $db;
    protected $config;

    public function __construct() {
        $this->db = DataBase::singleton();
        $this->config = Config::singleton();
    }
    
    public function getUserId() {
        $usuario = unserialize($_SESSION['user']);
        return $usuario->getIdUser();
    }
}

?>