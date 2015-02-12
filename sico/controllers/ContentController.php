<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class ContentController extends ControllerBase {

    public function main() {
        
    }

    public function adminNosotros() {
        $this->view->setTemplate('content' . DS . 'managerNosotros');        
        $this->document->addScript('editorareas');
        $this->document->addCss('styles8');
        $this->document->setHeader();
        $this->getModel('Contents');
        $contenido = $this->model->getContent();
        $this->view->setVars('content', $contenido);
        $this->view->show();
    }
    
    public function updatedNosotros(){
        $this->getModel('Contents');
        $this->model->UpdateContent();
    }

}

?>