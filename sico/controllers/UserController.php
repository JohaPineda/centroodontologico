<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class UserController extends ControllerPublic {

    public function main() {
        $this->Login();
    }

    public function Login() {
        if ($this->isLoggedNoRedirect()) {
            header('location: index.php');
        } else {
            $this->view->setTemplate('user' . DS . 'login');
            $this->document->setHeader();
            $message = null;
            $icon_message = null;
            if (isset($_GET['message'])) {
                if ($_GET['message'] == 'error') {
                    $message = $this->document->t("LOGIN_FAILED");    
                    $icon_message = IMAGES . SL . 'iconosalerta'.SL.'warning.png';
                }
            }
            $this->view->setVars('message', $message);
            $this->view->setVars('icon_message', $icon_message);
            $this->view->show(true);
        }
    }

    public function validacion() {
        $this->getModel("User");
        $this->model->LoginUser();
    }

    public function salir() {
        $this->getModel("User");
        $this->model->LogoutUser();
    }

    private function isLoggedNoRedirect() {
        session_start();
        if (isset($_SESSION['user']) && isset($_SESSION['autentificado'])
                && isset($_SESSION['certifed']) && isset($_SESSION['lastactivity']) && isset($_SESSION['init'])) {
            $usuario = unserialize($_SESSION['user']);
            if ($_SESSION['autentificado'] == "si" && $_SESSION['certifed'] == str_repeat(strrev(sha1($usuario->getIpUser()
                                            . "@pPliccati0N" . $usuario->getIdUser() . $_SESSION['init'])), 6)) {
                if (time() - $_SESSION['lastactivity'] > 900) {                    
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function verificarSessiones() {
        $this->getModel('User');
        $this->model->verificarSesiones();
    }

}

?>