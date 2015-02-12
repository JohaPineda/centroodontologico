<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class RipsController extends ControllerBase {
  
    public function main() {
        $this->view->setTemplate('rips' . DS . 'rips');
        $this->document->addScript("tabs"); 
        $this->document->addCss("tabs");
        $this->document->setHeader();
        $this->getModel("Usuarios");
        $especialistas = $this->model->traerEspecialistas();
        $this->view->setVars("especialistas", $especialistas);
        $this->view->show(); 
    } 

        public function consultas() {
        $this->view->setTemplate('rips' . DS . 'consultas');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_table"); 
        $this->document->setHeader(); 
        $this->getModel("Rips");   
        $consultas = $this->model->traerConsultas();
        $this->view->setVars("consultas", $consultas);
        $this->view->show(true);  
    }
      
        public function procedimientos() {
        $this->view->setTemplate('rips' . DS . 'procedimientos');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_table"); 
        $this->document->setHeader();    
        $this->getModel("Rips");        
        $procedimientos= $this->model->traerProcedimientos();
        $this->view->setVars("procedimientos", $procedimientos); 
        $this->view->show(true);  
    }  
    
}

?>