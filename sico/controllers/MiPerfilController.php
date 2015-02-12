<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class MiPerfilController extends ControllerBase {

    public function main() {
        $this->modificarPerfil();
    }

    public function modificarPerfil() {
        $this->view->setTemplate('user' . DS . 'MiPerfil');
        $this->document->addScript("jquery-ui.min");
        $this->document->addScript("jquery002");
        $this->document->addCss("style");
        $this->document->addCss("ImageOverlay");
        $this->document->setHeader(); //encabezado
        $this->getModel("MiPerfil");
        $paciente = $this->model->getPaciente();
        $this->view->setVars("paciente", $paciente);
        $this->view->show();
    }

    public function modificarMiperfil() {
        $this->getModel("MiPerfil");
        $this->model->modificarMiperfil();
    }

    public function modificarPassword() {
        $password = $_POST["pass"];
        $this->getModel("MiPerfil");
        $this->model->modificarPassword($password);
    }

    public function imageManager() {
        $this->view->setTemplate('user' . DS . 'Imagen');
        $this->document->addCss("stylesdropdrag");
        $this->document->addCss("jquery.si");
        $this->document->addScript("jquery.filedrop");
        $this->document->addScript("script");
        $this->document->addScript("jquery.si");
        $this->document->setHeader();
        $this->view->show(true);
    }

    public function subirimagenAjax() {
        $this->getModel("MiPerfil");
        $this->model->uploadPicture();
    }
    public function subirimagen() {
        $this->view->setTemplate('user' . DS . 'Imagen');
        $this->document->addCss("stylesdropdrag");
        $this->document->addCss("jquery.si");
        $this->document->addScript("jquery.filedrop");
        $this->document->addScript("script");
        $this->document->addScript("jquery.si");
        $this->document->setHeader();
        $this->getModel("MiPerfil");
        $this->model->uploadPicture();
        $this->view->show(true);
    }

}

?>
