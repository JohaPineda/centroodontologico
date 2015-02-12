<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class ControllerBase {

    protected $view;
    protected $model;
    protected $document;

    function __construct() {
        $validacion = Validacion::singleton();
        $this->view = new View();
        if ($validacion->isLogged()) {
            $this->document = Document::singleton();            
            $this->document->addScript("jquery-1.4.4.min");
            $this->document->addScript("jquery.hoverIntent.minified");
            $this->document->addScript("jquery.dcmegamenu.1.3.3");
            $this->document->addScript("tiny_mce");
            $this->document->addScript("cal");            
            $this->document->addScript("jquery.mousewheel-3.0.4.pack");
            $this->document->addScript("jquery.fancybox-1.3.4.pack");
            $this->document->addScript("aplication");            
            $this->document->addCss("calendar");
            $this->document->addCss("templatemo_style");
            $this->document->addCss("dcmegamenu");
            $this->document->addCss("blue");
            $this->document->addCss("demo");
            $this->document->addCss("style");
            $this->document->addCss("jquery.fancybox-1.3.4");
            $this->getModel("User");
            $nomeuser=$this->model->getUserName();
            $prefiljuser=$this->model->getUserProfile();     
            $this->view->setVars('nomeuser', $nomeuser);
            $this->view->setVars('prefiljuser', $prefiljuser);
            $this->view->setVars('doc', $this->document);
            $this->view->setVars('view', $this->view);
        }
    }

    function getModel($nameModel) {
        $model = $nameModel . 'Model';
        $path = MODELS . DS . $nameModel . 'Model.php';
        require ($path);
        $this->model = new $model();
        return $this->model;
    }

}

?>