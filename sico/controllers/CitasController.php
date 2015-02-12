<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class CitasController extends ControllerBase {

    public function main() {
        $this->Miscitas();
    }

    public function Miscitas() {
        $this->view->setTemplate('user' . DS . 'Citas');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_page");
        $this->document->addCss("demo_table");
        $this->document->addCss("insertForm");
        $this->document->addCss("style");
        $this->getModel("Citas");
        $citas = $this->model->traercitas();
        $this->view->setVars("citas", $citas);
        $this->document->setHeader(); //encabezado
        $this->view->show();
    }

    public function nuevacita() {
        $this->view->setTemplate('catalogo' . DS . 'NuevaCita');
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
        $this->view->setTemplate('catalogo' . DS . 'Prefactura');
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
        $this->view->setVars("consultorio", $consultorio);
        $this->view->show(true);
    }

    public function ajaxespecialistas() {
        $this->getModel("Citas");
        $medico = $this->model->obtenermedico($_POST['idconsultorio'], $_POST['idservicio']);
        $hora = $this->model->horasmedico($_POST['idservicio']);
        $nuevahora = $this->model->disponibles($hora, $_POST['dia'], $_POST['mes'], $medico[0]['idespecialista']);
        $nuevahora2 = $this->model->midisponibilidad($nuevahora, $_POST['dia'], $_POST['mes']);
        if (sizeof($medico) == 0) {
            echo json_encode(array($medico, array()));
        } else {
            echo json_encode(array($medico, $nuevahora2));
        }
    }

    public function ajaxdias() {
        $this->getModel("Citas");
        $dias = $this->model->obtenerdias($_POST['numeromes']);
        $arreglo["dias"] = $dias;
        $hora = $this->model->horasmedico($_POST['idservicio']);
        $nuevahora = $this->model->disponibles($hora, $dias[1], $_POST['numeromes'], $_POST['idespecialista']);
        $nuevahora2 = $this->model->midisponibilidad($nuevahora, $dias[1], $_POST['numeromes']);
        $arreglo['horas'] = $nuevahora2;
        echo json_encode($arreglo);
    }

    public function ajaxhorasmes() {
        $this->getModel("Citas");
        $hora = $this->model->horasmedico($_POST['idservicio']);
        $nuevahora = $this->model->disponibles($hora, $_POST['dia'], $_POST['numeromes'], $_POST['idespecialista']);
        $nuevahora2 = $this->model->midisponibilidad($nuevahora, $_POST['dia'], $_POST['numeromes']);
        echo json_encode(array($nuevahora2));
    }

    public function horasmedico() {
        $this->getModel("Citas");
        $hora = $this->model->horasmedico(3);
        $arreglo["hora"] = $hora;
        echo json_encode($arreglo);
    }

    public function prefactura() {
        $this->view->setTemplate('catalogo' . DS . 'Prefactura');
        $this->document->addCss("style");
        $this->document->setHeader(); //encabezado
        $this->getModel("Citas");
        $this->model->prefactura();
        $this->view->setVars("datoscita", $datoscita);
        $this->view->show(true);
    }

    public function pagar() {
        $this->getModel("Citas");
        $idpaciente = $this->model->buscarUsuario();
        $idcita = $this->model->guardarcita($idpaciente);
        $this->model->crearfactura($idcita);
    }

    public function simulador() {
        $this->view->setTemplate('simulador' . DS . 'simulador');
        $this->document->addCss("style");
        $this->document->setHeader();
        $valor = $_POST["valor"];
        $idespecialista = $_POST["idespecialista"];
        $cuota = $_POST["cuota"];
        $tarjeta = $_POST["tarjeta"];
        $dia = $_POST["dia"];
        $anio = $_POST["anio"];
        $mes = $_POST["mes"];
        $hora = $_POST["horaoficial"];
        $idconsultorio = $_POST["idconsultorio"];
        $idservicio = $_POST["idservicio"];
        $pagoonline = array("valor" => $valor, "cuota" => $cuota,
            "tarjeta" => $tarjeta, "dia" => $dia, "idespecialista" => $idespecialista,
            "anio" => $anio, "mes" => $mes, "idconsultorio" => $idconsultorio,
            "hora" => $hora, "idservicio" => $idservicio);
        $this->view->setVars("pagoonline", $pagoonline);
        $this->view->show(true);
    }

    public function cancelarcita() {
        $this->getModel("Citas");
        $this->model->cancelarcita();
    }

    public function ajaxnowtime() {
        $hora = $_POST['hora'];
        $ahoraArray = explode(':', date('H:i'));
        $ahora = ($ahoraArray[0] * 60) + $ahoraArray[1];
        if ($_POST['dia'] == date("d")) {
            if ($ahora > $hora) {
                echo json_encode(array('respuesta' => 'no', 'ahora' => $ahora));
            } else {
                echo json_encode(array('respuesta' => 'si'));
            }
        } else {
            echo json_encode(array('respuesta' => 'si'));
        }
    }

}
?>

