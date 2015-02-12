<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class ConsultoriosController extends ControllerBase {

    public function main() {
        $this->view->setTemplate('consultorios' . DS . 'consultorios');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_table");
        $this->document->setHeader();
        $this->getModel("Consultorios");
        $consultorios = $this->model->traerconsultorios();
        $this->view->setVars("consultorios", $consultorios);
        $this->view->show();
    }

    public function crearconsultorio() {
        $this->view->setTemplate('consultorios' . DS . 'crearconsultorio');
        $this->document->setHeader();
        $this->view->show(true);
    }

    public function crearconsultorios() {
        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefono"];
        $this->getModel("Consultorios");
        $this->model->crearconsultorios($nombre, $direccion, $telefono);
    }

    public function editarconsultorio() {
        $this->view->setTemplate('consultorios' . DS . 'editarconsultorio');
        $this->document->setHeader();
        $this->getModel("Consultorios");
        $idconsultorio = $_GET["idconsultorio"];
        $consultorios = $this->model->editarconsultorios($idconsultorio);
        $this->view->setVars("consultorios", $consultorios);
        $this->view->show(true);
    }

    public function updateconsultorio() {
        $idconsultorio = $_POST["idconsultorio"];
        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefono"];
        $this->getModel("Consultorios");
        $this->model->updateconsultorio($idconsultorio, $nombre, $direccion, $telefono);
    }

    public function deleteconsultorio() {
        $this->getModel("Consultorios");
        $this->model->deleteconsultorio();
    }

}

?>