<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class RegistrarUsuarioController extends ControllerPublic {

    public function main() {
        $this->Registrar();
    }
 
    public function Registrar() {
        $this->view->setTemplate('user' . DS . 'RegistrarUsuario');
        $this->document->addCss("insertForm");
        $this->document->addCss("style");
        $this->document->setHeader(); //encabezado
        $this->view->show(true);
    }

      public function passpaciente() {
        $this->view->setTemplate('user' . DS . 'RecordarPassword');
        $this->document->addCss("insertForm");
        $this->document->addCss("style");
        $this->document->setHeader(); //encabezado
        $this->view->show(true);
    }
    public function insertarpaciente() {
        $this->getModel("RegistrarUsuario");
        $this->model->insertarpaciente();
    }

    public function passwordpaciente() {
        $this->getModel("RegistrarUsuario");
        $this->model->passwordpaciente();
    }

}

?>
