<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class UsuariosController extends ControllerBase {

    public function main() {
        //$this->traerUsuarios();
    }

    public function traerEspecialistas() {
        $this->view->setTemplate('usuarios' . DS . 'administrador');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_table");
        $this->document->setHeader();
        $this->getModel("Usuarios");
        $especialistas = $this->model->traerEspecialistas();
        $this->view->setVars("especialistas", $especialistas);
        $this->view->show();
    }

    public function addEspecialista() {
        $this->view->setTemplate('usuarios' . DS . 'addEspecialista');
        $this->document->addCss('styles8');
        $this->document->setHeader();
        $this->getModel("Usuarios");
        $servicios = $this->model->traerSericios();
        $consultorios = $this->model->traerConsultorios();
        $this->view->setVars("servicios", $servicios);
        $this->view->setVars("consultorios", $consultorios);
        $this->view->show(true);
    }

    public function editarespecialista() {
        $this->view->setTemplate('usuarios' . DS . 'editarespecialistas');
        $this->document->addCss('styles8');
        $this->document->setHeader();
        $this->getModel("Usuarios");
        $idespecialista = $_GET["idespecialista"];
        $servicios = $this->model->traerSericios();
        $consultorios = $this->model->traerConsultorios();
        $especialista = $this->model->editarespecialista($idespecialista);
        $this->view->setVars("especialista", $especialista);
        $this->view->setVars("servicios", $servicios);
        $this->view->setVars("consultorios", $consultorios);
        $this->view->show(true);
    }

    public function insertEspecialista() {
        $this->getModel("Usuarios");
        $this->model->insertEspecialista();
    }

    public function deleteMedico() {
        $this->getModel("Usuarios");
        $this->model->deleteMedico();
    }

    public function inactivarusuario() {
        $this->getModel("Usuarios");
        $this->model->inactivarusuario();
    }

    public function updateespecialista() {
        $idespecialista = $_POST["idespecialista"];
        $nombre = $_POST["nombre"];
        $servicio = $_POST["servicio"];
        $consultorio = $_POST["consultorio"];
        $this->getModel("Usuarios");
        $this->model->updateespecialista($nombre, $idespecialista, $consultorio, $servicio);
    }

    public function traerPacientes() {
        $this->view->setTemplate('usuarios' . DS . 'pacientes');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_table");
        $this->document->setHeader();
        $this->getModel("Usuarios");
        $pacientes = $this->model->traerPacientes();
        $this->view->setVars("pacientes", $pacientes);
        $this->view->show();
    }

    public function editarpaciente() {
        $this->view->setTemplate('usuarios' . DS . 'editarpaciente');
        $this->document->addCss('styles8');
        $this->document->setHeader();
        $this->getModel("Usuarios");
        $idpaciente = $_GET["idpaciente"];
        $paciente = $this->model->editarpaciente($idpaciente);
        $this->view->setVars("paciente", $paciente);
        $this->view->show(true);
    }

    public function updatepaciente() {
        $idpaciente = $_POST["idpaciente"];
        $nombre = $_POST["nombre"];
        $cedula = $_POST["cedula"];
        $correo = $_POST["correo"];
        $celular = $_POST["celular"];
        $telefono = $_POST["telefono"];
        $this->getModel("Usuarios");
        $this->model->updatepaciente($idpaciente, $nombre, $cedula, $correo, $celular, $telefono);
    }

    public function addPaciente() {
        $this->view->setTemplate('usuarios' . DS . 'addpaciente');
        $this->document->addCss('styles8');
        $this->document->setHeader();
        $this->getModel("Usuarios");
        $servicios = $this->model->traerSericios();
        $consultorios = $this->model->traerConsultorios();
        $this->view->setVars("servicios", $servicios);
        $this->view->setVars("consultorios", $consultorios);
        $this->view->show(true);
    }

    public function insertPaciente() {
        $this->getModel("Usuarios");
        $this->model->insertPaciente();
    }

}

?>