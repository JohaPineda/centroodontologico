<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class ValidationController extends ControllerPublic {

    public function main() {
        
    }

    public function validar_presencia() {
        $this->getModel("Validacion");
        $valor = $_POST['valor'];
        if ($this->model->validar_presencia($valor)) {
            $respuesta['result'] = "true";
            echo json_encode($respuesta);
        } else {
            $respuesta['result'] = "false";
            $respuesta['mensaje'] = $this->document->t("IS_REQUIRED");
            echo json_encode($respuesta);
        }
    }

    public function validar_pattern() {
        $types = array('val1' => 'validar_nombre',
            'val3' => 'validar_email',
            'val2' => 'validar_numero',
            'val4' => 'validar_nombre_no_digit',
            'val5' => 'validar_nombre_short',
            'val6' => 'validar_decimal',
            'val7' => 'validar_direccion');
        $this->getModel("Validacion");
        $valor = $_POST['valor'];
        $tipo = $_POST['type'];
        $label = $_POST['label'];
        $min = $_POST['minis'];
        if($min<=0){
            $min=1;
        }
        if ($this->model->$types[$tipo]($valor,$min)) {
            $respuesta['result'] = "true";
            echo json_encode($respuesta);
        } else {
            $respuesta['result'] = "false";
            $respuesta['mensaje'] = $this->document->t("IS_INVALID", $label);
            echo json_encode($respuesta);
        }
    }

    public function validar_unica() {
        $this->getModel("Validacion");
        $value = $_POST['valor'];
        $table = $_POST['key'];
        $label = $_POST['label'];
        $field = $_POST['name'];
        $fields = explode('_', $field);
        if ($this->model->validar_unica($value, $fields[0], $table)) {
            $respuesta['result'] = "true";
            echo json_encode($respuesta);
        } else {
            $respuesta['result'] = "false";
            $respuesta['mensaje'] = $this->document->t("IS_REPEAT", $label);
            echo json_encode($respuesta);
        }
    }

}

?>
