<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class IndexController extends ControllerBase {

    public function main() {
        $this->view->setTemplate('inicio');
        $this->document->setHeader();
        $this->view->show();
    }

}

?>