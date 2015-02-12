<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');
 
class ConsultaController extends ControllerBase {
  
    public function main() { 
        $this->view->setTemplate('rips' . DS . 'consulta');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_table"); 
        $this->document->setHeader();
        $this->getModel("Rips"); 
        $citas = $this->model->traerCitasEspecialista(); 
        $this->view->setVars("citas", $citas);   
        $this->view->show();  
    }  
    
    public function historiaClinica(){
        $this->view->setTemplate('rips' . DS . 'historiaclinica');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_table"); 
        $this->document->setHeader();
        $this->getModel("Rips");     
        $idpaciente = $_GET["idpaciente"];
        $idcita = $_GET["idcita"];   
        $detalles = $this->model->historiaClinica($idpaciente,$idcita);  
        $this->view->setVars("detalles", $detalles);     
        $this->view->show(true);            
    }
     
    public function procedimiento(){   
        $this->getModel("Rips");    
        $this->model->procedimientos();          
    }
    
    }
?>
