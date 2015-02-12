<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class CatalogoController extends ControllerBase {

    public function main() {
        
    }

    public function perfil() {
        $this->view->setTemplate('catalogo' . DS . 'perfil');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_page");
        $this->document->addCss("demo_table");
        $this->document->setHeader();
        $this->getModel('Catalogo');
        $marcas = $this->model->getMarcas();
        $class = 'spec';
        $class2 = 'none';
        $this->view->setVars('marcas', $marcas);
        $this->view->setVars('default', $class);
        $this->view->setVars('default2', $class2);
        $this->view->show();
    }

    public function miperfil() {
        $this->view->setTemplate('catalogo' . DS . 'miperfil');
        $this->document->addScript("jquery_002");
        $this->document->addCss("ImageOverlay");
        $this->document->setHeader();
        $this->getModel('Catalogo');
        $marca = $this->model->getMarca();
        $this->view->setVars('marcaedit', $marca);
        $this->view->show(true);
    }

    public function miscitas() {
        $this->view->setTemplate('catalogo' . DS . 'miscitas');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_page");
        $this->document->addCss("demo_table");
        $this->document->setHeader();
        $this->getModel('Catalogo');
        $class = 'spec';
        $class2 = 'none';
        $consultorios = $this->model->getSelectConsultorios();
        $idcons;
        if (isset($_POST['consultorios'])) {
            $idcons = $_POST['consultorios'];
        } else {
            $idcons = $this->model->getFirstConsultorioId();
        }
        $productos = $this->model->getProductos($idcat);
        $this->view->setVars('consultorios', $consultorios);
        $this->view->setVars('categoria', $idcat);
        $this->view->setVars('productos', $productos);
        $this->view->setVars('default', $class);
        $this->view->setVars('default2', $class2);
        $this->view->show();
    }

    public function consultarDisponibilidad() {
        $this->view->setTemplate('catalogo' . DS . 'consultarDisponibilidad');
        $this->document->addScript("jquery_002");
        $this->document->addCss("ImageOverlay");
        $this->document->setHeader();
        $this->view->show(true);
    }

}

?>
