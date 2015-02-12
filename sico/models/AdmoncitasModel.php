<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class AdmoncitasModel extends ModelBase {

    public function traercitas($fechaini,$fechafin){ 
        $consulta = $this->db->executeQue("select p.idpaciente,p.nombre,p.cedula, c.hora, c.idcita, s.nombreservicio,e.nombre as medico,cast(concat(c.anio,'/',c.mes,'/',c.dia)  as date) as fecha,c.estado
            FROM  
                pacientes p,  
                citas c, 
                especialistas e, 
                servicios s
            WHERE   
                c.idpaciente = p.idpaciente AND
                c.idespecialista = e.idespecialista AND    
                e.idservicio = s.idservicio AND cast(concat(c.anio,'/',c.mes,'/',c.dia)  as date) between '$fechaini' AND '$fechafin'"); 

        $total = $this->db->numRows($consulta);
        if ($total > 0) { 
            while ($row = $this->db->arrayResult($consulta)) {
                $citas[] = array( 
                    "id" => $row['idcita'],
                    "nombrepaciente" => $row['nombre'],
                    "cedula" => $row['cedula'],
                    "servicio" => $row['nombreservicio'],
                    "medico" => $row['medico'],
                    "hora" => $this->formatohora($row['hora']),
                    "fecha" => $row['fecha'],
                    "estado" => $row['estado']);
            }
        }
        return $citas;
    } 

    public function fechaInicial() {
        $fechaactual = date("Y-m-d");
        return $fechaactual;  
    }
 
    public function fechaFinal() { 
        $fechaactual = date("Y-m-d");
        $hora_actual = strtotime("now");
        $fecha_final = strtotime("+30 days", $hora_actual);
        $fecha_final2 = date("Y-m-d", $fecha_final);       
        return $fecha_final2;
    }    

    public function guardarcita() {
        $idpaciente = $_POST['idpaciente'];
        $mes = $_POST['mes'];
        $dia = $_POST['dia'];
        $anio = $_POST['anio'];
        $hora = $_POST['horaoficial'];
        $idespecialista = $_POST['idespecialista'];
        $idconsultorio = $_POST['idconsultorio'];
        $idquery2 = "select nextval('citas_idcita_seq'::regclass) limit 1";
        $consult2 = $this->db->executeQue($idquery2);
        $row2 = $this->db->arrayResult($consult2);
        $idelemnto2 = $row2['nextval'];
        $this->db->executeQue("insert into  citas values($idelemnto2,$idespecialista,$idpaciente,$anio,$mes,$dia,$hora,'espera',$idconsultorio)");        
        return $idelemnto2;
    }

    public function crearfactura($idcita) {
        $fecha = date("Y-m-d");
        $valor = ($_POST['valor']) * 1.16;
        $idquery2 = "select nextval('facturas_idfactura_seq'::regclass) limit 1";
        $consult2 = $this->db->executeQue($idquery2);
        $row2 = $this->db->arrayResult($consult2);
        $idelemnto2 = $row2['nextval'];
        $this->db->executeQue("insert into  facturas values($idelemnto2,$idcita,'$fecha','cancelada',$valor)");
        $consulta3 = $this->db->executeQue("select c.idcita, c.hora, c.anio, c.mes, c.dia, c.estado, f.valor,
	e.nombre, t.nombreconsultorio, s.nombreservicio, p.nombre as paciente,p.cedula, p.correo
        from  citas c,
              especialistas e,
              servicios s, 
              consultorios t,
              facturas f,
              pacientes p 
        where c.idespecialista = e.idespecialista and
              e.idservicio     = s.idservicio and   
              t.idconsultorio = c.idconsultorio and
              p.idpaciente = c.idpaciente and
              c.idcita = f.idcita and
              c.idcita = $idcita");
        $row = $this->db->arrayResult($consulta3);
        $citas = array(
            "id" => $row['idcita'],
            "consultorio" => $row['nombreconsultorio'],
            "servicio" => $row['nombreservicio'],
            "hora" => $this->formatohora($row['hora']),
            "anio" => $row['anio'],
            "mes" => $row['mes'],
            "dia" => $row['dia'],
            "especialista" => $row['nombre'],
            "valor" => number_format($row['valor'], 0, "", "."),
            "estado" => $row['estado'],
            "paciente" => $row['paciente'],
            "cedula" => $row['cedula'],
            "correo" => $row['correo']);
        $idverify = strrev(urlencode(base64_encode($citas['id'])));
        $idcode = sha1($citas['id']);   
        $fecha = $citas['anio'] . "/" . $citas['mes'] . "/" . $citas['dia'];
        $this->enviarcorreo($citas['paciente'], $citas['hora'], $fecha, $citas['correo'], $citas['especialista'], $citas['cedula'], $citas['servicio'], $citas['consultorio']);
        echo "<script> parent.message('Se ha creado una nueva citas','images/iconosalerta/ok.png');" . 
        "parent.createdata('".$citas['id']."','".$citas['paciente']."','".$citas['cedula']."','".$citas['servicio']."','".$citas['especialista'] . "','" . $fecha. "','" . $citas['hora'] . "','" . $citas['estado'] . "','$idcode','$idverify');parent.$.fancybox.close();</script>;";
    }
    
    private function enviarcorreo($nombre, $hora, $fecha, $correo, $especialista, $cedula, $servicio, $consultorio) {
        $email = new Correo();
        $email->emailFrom($this->config->get("mail"));
        $email->nameFrom($this->config->get("company"));
        $email->subject("Cita consultorios abc");
        $email->emailTo($correo);
        $email->respondTo($this->config->get("mail"));
        $email->mailBody("
                Informaci&oacute;n del paciente: <br><br>
                Cedula: $cedula<br>
                Nombre: $nombre<br>
                Correo: $correo<br><br>
                A continuaci&oacute;n se encuentra la informaci&oacute;n de la cita: <br><br>                
                Fecha de la cita: $fecha<br>
                Hora: $hora<br>
                Consultorio: $consultorio             
                Especialista: $especialista<br>
                Servicio: $servicio");        
        $email->send();
    }
  
    public function obteneridPaciente($cedula){
        $consulta = $this->db->executeQue("select * from pacientes where cedula=$cedula");
        while ($row = $this->db->arrayResult($consulta)) {
            $paciente = array(
                "idpaciente" => $row['idpaciente'],
                "nombrepaciente" => $row['nombre']);
        }  
        return $paciente;
    }

    public function formatohora($minutos) {
        $formato = $minutos / 60;
        $decimales = explode(".", number_format($formato, 2, ".", ""));
        if ($decimales[1] != 0) {
            $calc = number_format(($decimales[1] * 60) / 100, 0, "", "");
            $formt = ":" . $calc . "";
        } else {
            $formt = ":00";
        }
        $hora = $decimales[0] . $formt;

        return $hora;
    }  

    public function midisponibilidad($nuevahora, $dia, $mes, $tiemposervicio, $horacita) {
        $idpaciente = $_POST['idpaciente'];
        $consul = $this->db->executeQue("select c.hora, s.tiempo from citas c, especialistas e, servicios s
           where c.idpaciente=$idpaciente and c.dia=$dia and c.mes=$mes and c.estado not in ('cancelado') 
                and c.idespecialista = e.idespecialista
                and e.idservicio = s.idservicio");  
        $this->db->numRows($consul);
        while ($row = $this->db->arrayResult($consul)) {
            $variable1 = (int) $row['hora'];
            $variable2 = (int) ($row['hora'] + $row['tiempo']);
            foreach ($nuevahora as $key => $value) {
                $key2 = $key + $tiemposervicio;
                if ($key >= $variable1 && $key < $variable2) {
                    if ($horabd != $horacita) {
                        unset($nuevahora[$key]);
                    }
                }
                if ($variable1 >= $key && $variable1 < $key2) {
                    if ($horabd != $horacita) {
                        unset($nuevahora[$key]);
                    }
                }
            }
        }
        return $nuevahora;
    }
     public function midisponibilidaddos($nuevahora, $dia, $mes, $tiemposervicio) {

        $idpaciente = $_POST['idpaciente'];
        $consul = $this->db->executeQue("select c.hora, s.tiempo from citas c, especialistas e, servicios s
           where c.idpaciente=$idpaciente and c.dia=$dia and c.mes=$mes and c.estado not in ('cancelado') 
                and c.idespecialista = e.idespecialista
                and e.idservicio = s.idservicio");
        $this->db->numRows($consul);
        while ($row = $this->db->arrayResult($consul)) {
            $variable1 = (int) $row['hora'];
            $variable2 = (int) ($row['hora'] + $row['tiempo']);
            foreach ($nuevahora as $key => $value) {
                $key2 = $key + $tiemposervicio;
                if ($key >= $variable1 && $key < $variable2) {
                    
                        unset($nuevahora[$key]);
                    
                }
                if ($variable1 >= $key && $variable1 < $key2) {
                    
                        unset($nuevahora[$key]);
                    
                }
            }
        }
        return $nuevahora;
    }

    public function disponibles($horas, $dia, $mes, $idespecialista, $horacita) {
        $mesactual = (int) date("m");
        if ($mes < $mesactual) {
            $anio = ((int) date("Y")) + 1;
        } else {
            $anio = ((int) date("Y"));
        }
        $consulta = $this->db->executeQue("select * from citas where 
            idespecialista=$idespecialista and dia=$dia and mes=$mes and anio=$anio and estado='espera'");
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $horabd = $row['hora'];
                if ($horabd != $horacita) {
                    unset($horas[$horabd]);
                }
            }
        }
        return $horas;
    }
     public function disponiblesdos($horas, $dia, $mes, $idespecialista) {
        $mesactual = (int) date("m");
        if ($mes < $mesactual) {
            $anio = ((int) date("Y")) + 1;
        } else {
            $anio = ((int) date("Y"));
        }
        $consulta = $this->db->executeQue("select * from citas where 
            idespecialista=$idespecialista and dia=$dia and mes=$mes and anio=$anio and estado='espera'");
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $horabd = $row['hora'];                
                    unset($horas[$horabd]);              
            }
        }
        return $horas;
    }

    public function verificarpaciente($cedula) {
        $consulta = $this->db->executeQue("select * from pacientes where cedula=$cedula");
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            $respuesta['respuesta'] = 'si';
            echo json_encode($respuesta);
        } else {
            $respuesta['respuesta'] = 'no';
            echo json_encode($respuesta);
        }
    }

    public function editarcitaadmin($anio, $idcita) {
        $idespecialista = $_POST['especialista'];
        $mes = $_POST['mes'];
        $dia = $_POST['dia'];
        $hora = $_POST['hora'];
        $hora2 = $this->formatohora($hora);
        if($this->db->executeQue("update citas set  idespecialista=$idespecialista, anio=$anio, mes=$mes, dia=$dia, hora=$hora where idcita=$idcita")){
            echo "<script> parent.message('Se ha Editado la cita','images/iconosalerta/ok.png');".
            "parent.updatedata($idcita,'$anio','$mes',$dia,'$hora2');" .        
            "parent.$.fancybox.close();</script>"; }   
           else { 
            echo "<script>parent.message('No se pudo actualizar la cita', 'images/iconosalerta/error.png');" .
            "parent.$.fancybox.close();</script>"; 
        }
    }

}

?>
