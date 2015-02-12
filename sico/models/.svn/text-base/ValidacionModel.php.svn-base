<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class ValidacionModel extends ModelBase {

    private $models = array('val1' => 'usuarios',
        'val2' => 'especialistas',
        'val3' => 'pacientes');

     
    function validar_direccion($direccion, $minimum=1) {
        if (preg_match('/^[a-zA-ZñÑáéíóú.,#-\d_\s]{' . $minimum . ',50}$/i', $direccion)) {
            return true;
        } else {
            return false;
        }
    }

    function validar_nombre($nombre, $minimum=0) {
        if (preg_match('/^[a-zA-ZñÑáéíóú,-.\d_\s]{' . $minimum . ',50}$/i', $nombre)) {
            return true;
        } else {
            return false;
        }
    }

    function validar_nombre_no_digit($nombre, $minimum=0) {
        if (preg_match('/^[a-zA-ZñÑáéíóú\s]{' . $minimum . ',50}$/i', $nombre)) {
            return true;
        } else {
            return false;
        }
    }

    function validar_nombre_short($nombre, $minimum=0) {
        if (preg_match('/^[a-zA-ZñÑáéíóú\s]{' . $minimum . ',30}$/i', $nombre)) {
            return true;
        } else {
            return false;
        }
    }

    function validar_email($email, $minimum=0) {
        if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email)) {
            return true;
        } else {
            return false;
        }
    }

    function validar_numero($number, $minimum=0) {                
        if ($number != '') {
            if (preg_match('/^[0-9]{' . $minimum . ',15}$/', $number)) {
                if ($number > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    function validar_decimal($number, $minimum=0) {
        if ($number != '') {
            if (eregi('^[0-9]{' . $minimum . ',15}$|^[0-9]{' . $minimum . ',15}[,|\.]{0,1}[0-9]{1,15}$', $number)) {
                if ($number > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    function validar_unica($value, $field, $table) {
        $consulta = null;
        if (is_numeric($value)) {
            if ($field == 'referencia') {
                $query = "select * from " . $this->models[$table] . "  where " . $field . "='$value'";
            } else {
                $query = "select * from " . $this->models[$table] . "  where " . $field . "=" . $value;
            }
            $consulta = $this->db->executeQue($query);
        } else {
            $query = "select * from " . $this->models[$table] . "  where " . $field . "='$value'";
            $consulta = $this->db->executeQue($query);
        }
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            return false;
        } else {
            return true;
        }
    }

    function validar_presencia($value) {
        $values = (string) $values;
        if ($value != '') {
            return true;
        } else {
            return false;
        }
    }

}

?>
