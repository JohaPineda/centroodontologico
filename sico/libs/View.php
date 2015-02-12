<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class View {

    private $path;
    private $menu;
    private $template;
    private $vars;

    function __construct() {
        $this->path = VIEWS . DS;
    }

    public function show($var=false) {

        if (is_array($this->vars)) {
            foreach ($this->vars as $key => $value) {
                $$key = $value;
            }
        }
        $fechas_template = $this->getFormatFecha();
        $url_main = $this->path;
        $url_menu = $this->menu;
        if ($var) {
            include($this->path);
        } else {
            include($this->template);
        }
        $aplication = Document::singleton();
        $aplication->setFinish();
    }

    public function setVars($nameVar, $valueVar) {

        $this->vars[$nameVar] = $valueVar;
    }

    public function setTemplate($name) {
        $this->menu = MENU;
        $this->template = TEMPLATE;
        $this->path = $this->path . $name . '.php';
    }

    public function input($name, $type, $lab, $validations= null, $options=null) {
        $tag = "<input ";
        if ($type == 'numeric') {
            $tag.= "type='text' name='$name' label='$lab' ";
        } else if ($type == 'calendar') {
            $tag.= "type='text' name='$name' label='$lab' ";
        } else {
            $tag.= "type='$type' name='$name' label='$lab' ";
        }
        if ($type == 'numeric') {
            if ($validations != null) {
                foreach ($validations as $key => $value) {
                    if ($key == 'required' && $value) {
                        $tag.='presence="val1" ';
                    }
                    if ($key == 'text' && $value == 'numeric') {
                        $tag.='patt="val2" ';
                    }
                    if ($key == 'norepeat') {
                        $tag.="norepeat='$value' ";
                    }
                    if ($key == 'minsize') {
                        $tag.="minsize='$value' ";
                    }
                }
                if ($options != null) {
                    foreach ($options as $key => $value) {
                        $tag.=$key . "='$value' ";
                    }
                }
            } else {
                if ($options != null) {
                    foreach ($options as $key => $value) {
                        $tag.=$key . '=' . $value . ' ';
                    }
                }
            }
            $tag.='onKeyPress="return validar(event)" />';
        } else if ($type == 'calendar') {
            if ($options != null) {
                foreach ($options as $key => $value) {
                    if ($key != 'class') {
                        $tag.=$key . "='$value' ";
                    }
                }
            }
            $tag.='class="onepic"/>';
        } else {
            if ($validations != null) {
                foreach ($validations as $key => $value) {
                    if ($key == 'required' && $value) {
                        $tag.='presence="val1" ';
                    }
                    if ($key == 'text' && $value == 'regular') {
                        $tag.='patt="val1" ';
                    }
                    if ($key == 'text' && $value == 'email') {
                        $tag.='patt="val3" ';
                    }
                    if ($key == 'text' && $value == 'onlytext') {
                        $tag.='patt="val4" ';
                    }
                    if ($key == 'text' && $value == 'shorttext') {
                        $tag.='patt="val5" ';
                    }
                    if ($key == 'text' && $value == 'decimal') {
                        $tag.='patt="val6" ';
                    }
                    if ($key == 'text' && $value == 'address') {
                        $tag.='patt="val7" ';
                    }
                    if ($key == 'norepeat') {
                        $tag.="norepeat='$value' ";
                    }
                    if ($key == 'minsize') {
                        $tag.="minsize='$value' ";
                    }
                }
                if ($options != null) {
                    foreach ($options as $key => $value) {
                        $tag.=$key . "='$value' ";
                    }
                }
            } else {
                if ($options != null) {
                    foreach ($options as $key => $value) {
                        $tag.=$key . "='$value' ";
                    }
                }
            }
            $tag.='/>';
        }
        echo $tag;
    }

    public function startForm($action, $id, $method='post') {
        echo "<form action='$action' method='$method' id='$id' onsubmit='return validates($(this).attr(\"id\"))'>";
    }

    public function endForm() {
        echo '</form>';
    }

    public function setFrame() {
        if (is_array($this->vars)) {
            foreach ($this->vars as $key => $value) {
                $$key = $value;
            }
        }
        $validacion = Validacion::singleton();
        if ($validacion->isLogged()) {
            include($this->path);
        }
    }
    
    public function getFormatFecha(){
        $fecha_hoy= date("Y-m-d");
        $fecha=split("-", $fecha_hoy);
        $anio=$fecha[0];
        $dia= (int) $fecha[2];        
        $mes=null;
        if($fecha[1]==1){
            $mes='Enero';
        }else if($fecha[1]==2){
            $mes='Febrero';
        }else if($fecha[1]==3){
            $mes='Marzo';
        }else if($fecha[1]==4){
            $mes='Abril';
        }else if($fecha[1]==5){
            $mes='Mayo';
        }else if($fecha[1]==6){
            $mes='Junio';
        }else if($fecha[1]==7){
            $mes='Julio';
        }else if($fecha[1]==8){
            $mes='Agosto';
        }else if($fecha[1]==9){
            $mes='Septiembrie';
        }else if($fecha[1]==10){
            $mes='Octubre';
        }else if($fecha[1]==11){
            $mes='Noviembre';
        }else if($fecha[1]==12){
            $mes='Diciembre';
        }
        $fechatotal= $dia.' de '.$mes.' del '.$anio;
        return $fechatotal;
    }

}

?>