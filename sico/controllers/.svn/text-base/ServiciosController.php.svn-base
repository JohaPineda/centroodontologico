<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class ServiciosController extends ControllerBase {

    public function main() {  
        $this->view->setTemplate('servicios' . DS . 'servicios');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_table");
        $this->document->setHeader();  
        $this->getModel("Servicios"); 
        $servicios = $this->model->traerservicios(); 
        $this->view->setVars("servicios", $servicios);
        $this->view->show();    
    } 
      
    public function editarServicio(){  
        $this->view->setTemplate('servicios' . DS . 'editarservicio');
        $this->document->setHeader();  
        $this->getModel("Servicios");    
        $idservicio = $_GET["idservicio"]; 
        $servicios  = $this->model->editarservicios($idservicio); 
        $this->view->setVars("servicios", $servicios);  
        $this->view->show(true);  
    }  
      
    public function updateservicio(){    
    $idservicio = $_POST["idservicio"];
    $nombre = $_POST["nombre"];
    $tiempo = $_POST["tiempo"];
    $valor = $_POST["valor"];
    $descripcion = $_POST["descripcion"];
    $this->getModel("Servicios");      
    $this->model->updateservicio($idservicio,$nombre,$tiempo,$valor,$descripcion);        
    }
     
    //falta validar que no tenga citas asociadas
    public function deleteservicio(){
    $this->getModel("Servicios");      
    $this->model->deleteservicio();           
    }
     
    public function crearservicio(){   
        $this->view->setTemplate('servicios' . DS . 'crearservicio');
        $this->document->setHeader(); 
        $this->view->show(true);   
    }
    
    public function crearservicios(){   
    $nombre = $_POST["nombre"];
    $tiempo = $_POST["tiempo"];
    $valor = $_POST["valor"]; 
    $descripcion = $_POST["descripcion"];
    $this->getModel("Servicios");    
    $this->model->crearservicios($nombre,$tiempo,$valor,$descripcion);  
    }    
}

?>
