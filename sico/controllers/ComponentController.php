<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class ComponentController extends ControllerBase {

    public function main() {
        
    }

    public function imagesBanner() {
        $imgmostrar = new Imagen($_GET['img']);
        $imgmostrar->redimencionMaximum(120, 44);
        $imgmostrar->mostrar();
    }

    public function bannerImage() {
        $this->view->setTemplate('components' . DS . 'managerBanner');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_page");
        $this->document->addCss("demo_table");
        $this->document->setHeader();
        $this->getModel('Components');
        $imagenes = $this->model->getImagesBanner();
        $class = 'spec';
        $class2 = 'none';
        $this->view->setVars('slides', $imagenes);
        $this->view->setVars('default', $class);
        $this->view->setVars('default2', $class2);
        $this->view->show();
    }

    public function createImageBanner() {
        $this->view->setTemplate('components' . DS . 'imagenBanner');
        $this->document->addCss('styles8');
        $this->document->setHeader();
        $this->view->show(true);
    }

    public function subirimagennueva() {
        $this->getModel('Components');
        $this->model->subirImagen();
    }

    public function editImage() {
        $this->view->setTemplate('components' . DS . 'editarimagen');
        $this->document->addScript("jquery.imgareaselect.pack");
        $this->document->addCss('imgareaselect-animated');
        $this->document->setHeader();
        $imagen = $_GET['newimage'];
        if (isset($_GET['alto']) && isset($_GET['ancho'])) {
            $alto = $_GET['alto'];
            $ancho = $_GET['ancho'];
        }
        $this->view->setVars('alto', $alto);
        $this->view->setVars('ancho', $ancho);
        $this->view->setVars('editIm', $imagen);
        $this->view->show(true);
    }

    public function finalizarImageBan() {
        $this->getModel('Components');
        $this->model->finalizarImagen();
    }

    public function deleteBanImg() {
        $this->getModel('Components');
        $this->model->Deleteimgbanner();
    }

    public function infoImage() {
        $this->view->setTemplate('components' . DS . 'editImgban');
        $this->document->setHeader();
        $idImagen = $_GET['idbanim'];
        $this->getModel('Components');
        $imagenban = $this->model->getImageBanner($idImagen);
        $this->view->setVars('imgban', $imagenban);
        $this->view->show(true);
    }

    public function modifyImgBan() {
        $this->getModel('Components');
        $this->model->Updateimgbanner();
    }

    /*
     * 
     * 
     * 
     */

    public function galleryImages() {
        $this->view->setTemplate('components' . DS . 'managerGallery');
        $this->document->addScript("jquery.dataTables");
        $this->document->addCss('styles8');
        $this->document->addCss("demo_page");
        $this->document->addCss("demo_table");
        $this->document->setHeader();
        $this->getModel('Components');
        $imagenes = $this->model->getImagesGallery();
        $class = 'spec';
        $class2 = 'none';
        $this->view->setVars('slides', $imagenes);
        $this->view->setVars('default', $class);
        $this->view->setVars('default2', $class2);
        $this->view->show();
    }

    public function createImageGalery() {
        $this->view->setTemplate('components' . DS . 'imagenGallery');
        $this->document->addCss('styles8');
        $this->document->setHeader();
        $this->view->show(true);
    }

    public function subirimagenGallery() {
        $this->getModel('Components');
        $this->model->subirImagenGal();
    }

    public function deleteGalImg() {
        $this->getModel('Components');
        $this->model->DeleteimgGaller();
    }

    public function addVideo() {
        $this->view->setTemplate('components' . DS . 'addVideo');
        $this->document->setHeader();
        $this->view->show(true);
    }

    public function insertVideo() {
        $this->getModel('Components');
        $this->model->InsertVideo();
    }

}

?>