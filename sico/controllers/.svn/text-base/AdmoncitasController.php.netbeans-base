<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class AdmoncitasController extends ControllerBase {

    public function administrarCitas() {
        $this->view->setTemplate('citas' . DS . 'administrarcitas');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_page");
        $this->document->addCss("demo_table");
        $this->document->addCss("insertForm");
        $this->document->addCss("style");
        $this->document->setHeader(); //encabezado
        $this->getModel("Admoncitas");
        $fechaini;
        $fechafin;  
        if (isset($_POST['dateini'])&& isset($_POST['datefin'])  ) {
            $fechaini = $_POST['dateini'];
            $fechafin = $_POST['datefin'];
        } else {  
            $fechaini = $this->model->fechaInicial();
            $fechafin = $this->model->fechaFinal();
        }   
        $citas = $this->model->traercitas($fechaini,$fechafin);
        $this->view->setVars('fechaini', $fechaini);
        $this->view->setVars('fechafin', $fechafin);
        $this->view->setVars("citas", $citas);
        $this->view->show();
    }
    
    public function editarcita() {
        $this->view->setTemplate('citas' . DS . 'editarcita');
        $this->document->addCss("style");
        $this->document->setHeader(); //encabezado      
        $this->getModel("Citas");
        $servicios=$this->model->especialistaServicio();
        
        $idconsultorio =  $servicios['idconsultorio'];
        $idservicio = $servicios['idservicio']; 
        $servicio = $this->model->obtenerservicioeditar($idservicio);
        $consultorio = $this->model->obtenerconsultorioeditar($idconsultorio);
        $medico = $this->model->obtenermedico($idconsultorio, $idservicio);
        $mesarreglo = $this->model->obtenermes();
        $dias = $this->model->obtenerdias($servicios['mes']);
        $hora = $this->model->horasmedico($idservicio);
        $this->getModel("Admoncitas");
        $nuevahora = $this->model->disponibles($hora, $servicios['dia'], $servicios['mes'], $medico[0]['idespecialista'], $servicios['horacita']);
        $nuevahora2 = $this->model->midisponibilidad($nuevahora, $servicios['dia'], $servicios['mes'], $servicio['tiempo'], $servicios['horacita']);
        $this->view->setVars("idcita", $_GET['idcita']);  
        $this->view->setVars("hora", $nuevahora2);
        $this->view->setVars("dias", $dias);
        $this->view->setVars("mes", $mesarreglo);
        $this->view->setVars("medico", $medico);   
        $this->view->setVars("servicio", $servicio['nombreservicio']);
        $this->view->setVars("servicios", $servicios);
        $this->view->setVars("idservicio", $idservicio);
        $this->view->setVars("consultorio", $consultorio);
        $this->view->setVars("idconsultorio", $idconsultorio);
        $this->view->show(true);
    }

    public function admincita() {
        $this->view->setTemplate('catalogo' . DS . 'NuevaCitaAdmin');
        $this->document->addCss("style");
        $this->document->setHeader(); //encabezado                        
        $this->getModel("Citas");
        
        $servicio = $this->model->obtenerservicios();
        $idconsultorio = $consultorio[0]['idconsultorio'];
        $idservicio = $servicio[0]['idservicio'];
        
        $medico = $this->model->obtenermedico($idconsultorio, $idservicio);
        $mesarreglo = $this->model->obtenermes();
        $dias = $this->model->obtenerdias((int) date('m'));
        $hora = $this->model->horasmedico($idservicio);
        
        $this->getModel("Admoncitas");
        $nuevahora = $this->model->disponibles($hora, $dias[1], (int) date('m'), $medico[0]['idespecialista']);
        $nuevahora2 = $this->model->midisponibilidad($nuevahora, $dias[1], (int) date('m'), $servicio[0]['tiempo']);
        $this->view->setVars("hora", $nuevahora2);
        $this->view->setVars("dias", $dias);
        $this->view->setVars("mes", $mesarreglo);
        $this->view->setVars("medico", $medico);
        $this->view->setVars("servicio", $servicio);
        $this->view->setVars("consultorio", $consultorio);
        $this->view->show(true);
    }

    public function crearcita() {
        $this->view->setTemplate('catalogo' . DS . 'PrefacturaAdmin');
        $this->document->addCss("style");
        $this->document->setHeader(); //encabezado
        $idconsultorio = $_POST['consultorio'];
        $idservicio = $_POST['servicio'];
        $idespecialista = $_POST['especialista'];
        $this->getModel("Citas");
        $consultorio = $this->model->datoscita($idconsultorio, $idservicio, $idespecialista);
        $consultorio['mes'] = $_POST['mes'];
        $consultorio['dia'] = $_POST['dia'];
        $consultorio['hora'] = $_POST['hora'];
        $consultorio['horaformato'] = $this->model->formatohora($_POST['hora']);
        $consultorio['anio'] = $this->model->obteneranio($_POST['mes']);
        $this->getModel("Admoncitas");
        $consultorio['cedula'] = $_POST['cedula'];
        $pacient = $this->model->obteneridPaciente($_POST['cedula']);
        $consultorio['nombrepaciente'] = $pacient['nombrepaciente'];
        $consultorio['idpaciente'] = $pacient['idpaciente'];
        $this->view->setVars("consultorio", $consultorio);
        $this->view->show(true);
    }

    public function nuevacita() {
        $this->view->setTemplate('catalogo' . DS . 'NuevaCitaAdmin');
        $this->document->addCss("style");
        $this->document->setHeader(); //encabezado
        $this->getModel("Citas");
        $consultorio = $this->model->obtenerconsultorio();
        $servicio = $this->model->obtenerservicios();
        $idconsultorio = $consultorio[0]['idconsultorio'];
        $idservicio = $servicio[0]['idservicio'];
        $medico = $this->model->obtenermedico($idconsultorio, $idservicio);
        $mesarreglo = $this->model->obtenermes();
        $dias = $this->model->obtenerdias((int) date('m'));
        $hora = $this->model->horasmedico($idservicio);
        $this->getModel("Admoncitas");
        $nuevahora = $this->model->disponiblesdos($hora, $dias[1], (int) date('m'), $medico[0]['idespecialista']);
        $nuevahora2 = $this->model->midisponibilidaddos($nuevahora, $dias[1], (int) date('m'), $servicio[0]['tiempo']);
        $cedula=$_GET['cedula']?$_GET['cedula']:null;
        $this->view->setVars("cedula", $cedula);
        $this->view->setVars("hora", $nuevahora2);
        $this->view->setVars("dias", $dias);
        $this->view->setVars("mes", $mesarreglo);
        $this->view->setVars("medico", $medico);
        $this->view->setVars("servicio", $servicio);
        $this->view->setVars("consultorio", $consultorio);
        $this->view->show(true);
    }

    public function pagar() {
        $this->getModel("Admoncitas");
        $idcita = $this->model->guardarcita();
        $this->model->crearfactura($idcita);
    }

    public function ajaxverificarpaciente() {
        $cedula = $_POST['cedula'];
        $this->getModel("Admoncitas");
        $this->model->verificarpaciente($cedula);
    }

    public function cancelarcita() {
        $this->getModel("Citas");
        $this->model->cancelarcita();
    }
    public function editarcitaadmin(){
        $this->getModel("Citas");
        $idcita=$_POST['idcita'];        
        $anio= $this->model->obteneranio($_POST['mes']);
        $this->getModel("Admoncitas");
        $this->model->editarcitaadmin($anio, $idcita); 
    }

    public function registrarUser() {
        $this->view->setTemplate('catalogo' . DS . 'RegistrarUsuario');
        $this->document->addCss("insertForm");
        $this->document->addCss("style");
        $this->document->setHeader(); //encabezado
        $cedula=$_GET['cedula'];
        $this->view->setVars("cedula", $cedula);
        $this->view->show(true);
    }
    
    public function insertarpaciente() {
        $this->getModel("RegistrarUsuario");
        $this->model->insertarpaciente();
    }
}

?>
