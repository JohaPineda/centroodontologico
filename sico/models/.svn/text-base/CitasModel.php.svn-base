<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class CitasModel extends ModelBase {

    public function datoscita($idconsultorio, $idservicio, $idespecialista) {
        $consulta = $this->db->executeQue("
        select c.nombreconsultorio, c.idconsultorio, s.nombreservicio, s.idservicio, e.nombre, e.idespecialista, s.valor
        from    consultorios c,
                servicios s,
                especialistas e 
        where 	c.idconsultorio=$idconsultorio and 
                s.idservicio=$idservicio and
                e.idespecialista=$idespecialista and 
                e.idservicio=s.idservicio");


        while ($row = $this->db->arrayResult($consulta)) {
            $consultorio = array(
                "nombreconsultorio" => $row['nombreconsultorio'],
                "nombreservicio" => $row['nombreservicio'],
                "nombre" => $row['nombre'],
                "idconsultorio" => $row['idconsultorio'],
                "idservicio" => $row['idservicio'],
                "idespecialista" => $row['idespecialista'],
                "valor" => $row['valor']
            );
        }
        return $consultorio;
    }

    public function obtenerconsultorio() {
        $consulta = $this->db->executeQue("select * from consultorios");
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $consultorio[] = array(
                    "nombreconsultorio" => $row['nombreconsultorio'],
                    "idconsultorio" => $row['idconsultorio']);
            }
        }
        return $consultorio;
    }

    public function obtenerservicios() {
        $consulta = $this->db->executeQue("select * from servicios");
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $servicio[] = array(
                    "nombreservicio" => $row['nombreservicio'],
                    "idservicio" => $row['idservicio'],
                    "tiempo" => $row['tiempo']);
            }
        }
        return $servicio;
    }

    public function obtenermedico($idconsultorio, $idservicio) {
        $consulta = $this->db->executeQue("select * from especialistas where idconsultorio=$idconsultorio and idservicio=$idservicio");
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $medico[] = array(
                    "nombre" => $row['nombre'],
                    "idespecialista" => $row['idespecialista']);
            }
        }
        return $medico;
    }

    public function obtenermes() {
        $mes = (int) date("m");
        $meses[1] = "ENERO";
        $meses[2] = "FEBRERO";
        $meses[3] = "MARZO";
        $meses[4] = "ABRIL";
        $meses[5] = "MAYO";
        $meses[6] = "JUNIO";
        $meses[7] = "JULIO";
        $meses[8] = "AGOSTO";
        $meses[9] = "SEPTIEMBRE";
        $meses[10] = "OCTUBRE";
        $meses[11] = "NOVIEMBRE";
        $meses[12] = "DICIEMBRE";
        $mesarreglo = NULL;
        $suma = $mes;
        $cont = 0;
        $cont2 = 1;
        $index = 1;
        while ($cont < 5) {
            if ($cont == 0) {
                $mesarreglo[$index]["valor"] = $mes;
                $mesarreglo[$index]["mes"] = $meses[$mes];
                $cont++;
                $index += 1;
                $suma+=1;
            } else {
                if ($suma > 12) {
                    $mesarreglo[$index]["valor"] = $cont2;
                    $mesarreglo[$index]["mes"] = $meses[$cont2];
                    $cont2++;
                    $index += 1;
                    $cont++;
                } else {
                    $mesarreglo[$index]["valor"] = $suma;
                    $mesarreglo[$index]["mes"] = $meses[$suma];
                    $suma+=1;
                    $index += 1;
                    $cont++;
                }
            }
        }
        return $mesarreglo;
    }

    public function obtenerdias($mes) {
        $mesactual = (int) date("m");
        $anioactual = (int) date("y");
        $dias = NULL;
        $cuenta = 0;
        $cta = 1;
        $total = 0;
        $dmes = 0;
        $cantd = 0;
        if ($mes < $mesactual) {
            $anioactual+=1;
        } else {
            $anioactual = (int) date("y");
        }
        if (($anioactual % 4 == 0) && (($anioactual % 100 != 0) || ($anioactual % 400 == 0))) {
            if ($mes == 4 || $mes == 6 || $mes == 9 || $mes == 11) {
                $dmes = 31;
                $cantd = 30;
            } else if ($mes == 2) {
                $dmes = 30;
                $cantd = 29;
            } else {
                $dmes = 32;
                $cantd = 31;
            }
            if ($mes == $mesactual) {
                $diaactual = (int) date("d");
                $diasemana = (int) date("w");
            } else if ($mes == 2) {
                $diaactual = 1;
                $d = (int) date("d");
                $diasemana = (int) date("w");
                if ($mes > $mesactual) {
                    $meses = (abs($mesactual - $mes) * 30) + abs($mesactual - $mes);
                    $total = $meses - $d;
                    while ($cuenta < $total) {
                        if ($diasemana == 6) {
                            $diasemana = 0;
                            $cuenta++;
                        }
                        $diasemana++;
                        $cuenta++;
                    }
                } else {
                    $meses = (((12 - ($mesactual - $mes)) * 30) + (12 - ($mesactual - $mes)));
                    $total = $meses - $d;
                    while ($cuenta < $total) {
                        if ($diasemana == 6) {
                            $diasemana = 0;
                            $cuenta++;
                        }
                        $diasemana++;
                        $cuenta++;
                    }
                }
            } else {
                $diaactual = 1;
                $d = (int) date("d");
                $diasemana = (int) date("w");
                if ($mes >= 9) {
                    if ($mes < $mesactual) {
                        $meses = (((12 - ($mesactual - $mes)) * 30) + (12 - ($mesactual - $mes)));
                        $total = $meses - $d;
                        while ($cuenta < $total) {
                            if ($diasemana == 6) {
                                $diasemana = 0;
                                $cuenta++;
                            }
                            $diasemana++;
                            $cuenta++;
                        }
                    } else {
                        $meses = (abs($mesactual - $mes) * 30) + abs($mesactual - $mes);
                        $total = $meses - $d;

                        while ($cuenta < $total) {
                            if ($diasemana == 6) {
                                $diasemana = 0;
                                $cuenta++;
                            }
                            $diasemana++;
                            $cuenta++;
                        }
                    }
                } else {
                    $meses = (abs($mesactual - $mes) * 30) + abs($mesactual - $mes);
                    $total = $meses - $d;
                    while ($cuenta < $total) {
                        if ($diasemana == 6) {
                            $diasemana = 0;
                            $cuenta++;
                        }
                        $diasemana++;
                        $cuenta++;
                    }
                }
            }
            for ($i = $diaactual; $i < $dmes; $i++) {
                if ($diasemana == 0) {
                    $diasemana++;
                } else {
                    $dias[$cta] = $i;
                    $cta++;
                    if ($diasemana == 6) {
                        $diasemana = 0;
                    } else {
                        $diasemana+=1;
                    }
                }
            }
        } else {
            if ($mes == 4 || $mes == 6 || $mes == 9 || $mes == 11) {
                $dmes = 31;
                $cantd = 30;
            } else if ($mes == 2) {
                $dmes = 29;
                $cantd = 28;
            } else {
                $dmes = 32;
                $cantd = 31;
            }
            if ($mes == $mesactual) {
                $diaactual = (int) date("d");
                $diasemana = (int) date("w");
            } else if ($mes == 2) {
                $diaactual = 1;
                $d = (int) date("d");
                $diasemana = (int) date("w");
                if ($mes > $mesactual) {
                    $meses = (abs($mesactual - $mes) * 30) + abs($mesactual - $mes);
                    $total = $meses - $d;

                    while ($cuenta < $total) {
                        if ($diasemana == 6) {
                            $diasemana = 0;
                            $cuenta++;
                        }
                        $diasemana++;
                        $cuenta++;
                    }
                } else {
                    $meses = (((12 - ($mesactual - $mes)) * 30) + (12 - ($mesactual - $mes)));
                    $total = $meses - $d;

                    while ($cuenta < $total) {
                        if ($diasemana == 6) {
                            $diasemana = 0;
                            $cuenta++;
                        }
                        $diasemana++;
                        $cuenta++;
                    }
                }
            } else {
                $diaactual = 1;
                $d = (int) date("d");
                $diasemana = (int) date("w");
                if ($mes >= 9) {
                    if ($mes < $mesactual) {
                        $meses = (((12 - ($mesactual - $mes)) * 30) + (12 - ($mesactual - $mes)));
                        $total = $meses - $d;
                        while ($cuenta < $total) {
                            if ($diasemana == 6) {
                                $diasemana = 0;
                                $cuenta++;
                            }
                            $diasemana++;
                            $cuenta++;
                        }
                    } else {
                        $meses = (abs($mesactual - $mes) * 30) + abs($mesactual - $mes);
                        $total = $meses - $d;
                        while ($cuenta < $total) {
                            if ($diasemana == 6) {
                                $diasemana = 0;
                                $cuenta++;
                            }
                            $diasemana++;
                            $cuenta++;
                        }
                    }
                } else {
                    $meses = (abs($mesactual - $mes) * 30) + abs($mesactual - $mes);
                    $total = $meses - $d;
                    while ($cuenta < $total) {
                        if ($diasemana == 6) {
                            $diasemana = 0;
                            $cuenta++;
                        }
                        $diasemana++;
                        $cuenta++;
                    }
                }
            }
            for ($i = $diaactual; $i < $dmes; $i++) {
                if ($diasemana == 0) {
                    $diasemana++;
                } else {
                    $dias[$cta] = $i;
                    $cta++;
                    if ($diasemana == 6) {
                        $diasemana = 0;
                    } else {
                        $diasemana+=1;
                    }
                }
            }
        }
        return $dias;
    }

    public function horasmedico($idservicio) {
        $consulta = $this->db->executeQue("select * from servicios where idservicio=$idservicio");
        $row = $this->db->arrayResult($consulta);
        $tiempo = $row['tiempo'];
        $suma = 0;
        $ind = 0;
        $horario = NULL;
        $p = 0;
        $formato = 0;
        while ($suma < 1080) {
            $p = $suma + $tiempo;
            if ($p < 1080 && ($p + $tiempo) <= 1080) {
                if ($ind == 0) {
                    $suma = 480;
                    $formato = $suma / 60;
                    $decimales = explode(".", number_format($formato, 2, ".", ""));
                    if ($decimales[1] != 0) {
                        $calc = number_format(($decimales[1] * 60) / 100, 0, "", "");
                        $formt = ":" . $calc . "";
                    } else {
                        $formt = ":00";
                    }
                    $horario[$suma] = $decimales[0] . $formt;
                    $ind++;
                } else {
                    $suma+=$tiempo;
                    $formato = $suma / 60;
                    $decimales = explode(".", number_format($formato, 2, ".", ""));
                    if ($decimales[1] != 0) {
                        $calc = number_format(($decimales[1] * 60) / 100, 0, "", "");
                        $formt = ":" . $calc . "";
                    } else {
                        $formt = ":00";
                    }
                    $horario[$suma] = $decimales[0] . $formt;
                }
            } else {
                break;
            }
        }
        return $horario;
    }

    public function prefactura() {
        
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

    public function obteneranio($mes) {
        $mesactual = (int) date("m");
        if ($mes < $mesactual) {
            return ((int) date("Y")) + 1;
        } else {
            return ((int) date("Y"));
        }
    }

    public function buscarUsuario() {
        $idusuario = $this->getUserId();
        $consulta = $this->db->executeQue("select * from pacientes where idusuario=$idusuario");
        $row = $this->db->arrayResult($consulta);
        $idpaciente = $row['idpaciente'];
        return $idpaciente;
    }

    public function guardarcita($idpaciente) {

        $mes = $_POST['mes'];
        $dia = $_POST['dia'];
        $anio = $_POST['anio'];
        $hora = $_POST['hora'];
        $idespecialista = $_POST['idespecialista'];
        $idconsultorio = $_POST['idconsultorio'];
        $idquery2 = "select nextval('citas_idcita_seq'::regclass) limit 1";
        $consult2 = $this->db->executeQue($idquery2);
        $row2 = $this->db->arrayResult($consult2);
        $idelemnto2 = $row2['nextval'];
        $consulta2 = $this->db->executeQue("insert into  citas values($idelemnto2,$idespecialista,$idpaciente,$anio,$mes,$dia,$hora,'espera',$idconsultorio)");
        return $idelemnto2;
    }

    public function disponibles($horas, $dia, $mes, $idespecialista) {
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
        if ($horas == null) {
            
        }
        return $horas;
    }

    public function traercitas() {
        $idusuario = $this->getUserId();
        $consulta = $this->db->executeQue("select * from pacientes where idusuario=$idusuario");
        while ($row = $this->db->arrayResult($consulta)) {
            $idpaciente = $row['idpaciente'];
        }
        $consulta = $this->db->executeQue("select c.idcita, c.hora, c.anio, c.mes, c.dia, c.estado, f.valor,
	e.nombre, t.nombreconsultorio, s.nombreservicio 
        from  citas c,
              especialistas e,
              servicios s, 
              consultorios t,
              facturas f
        where c.idespecialista = e.idespecialista and
              e.idservicio     = s.idservicio and   
              t.idconsultorio = c.idconsultorio and
              c.idcita = f.idcita and
              c.idpaciente = $idpaciente");
        $servicios;
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $citas[] = array(
                    "id" => $row['idcita'],
                    "hora" => $this->formatohora($row['hora']),
                    "ano" => $row['anio'],
                    "mes" => $row['mes'],
                    "dia" => $row['dia'],
                    "especialista" => $row['nombre'],
                    "nombreconsultorio" => $row['nombreconsultorio'],
                    "nombreservicio" => $row['nombreservicio'],
                    "valor" => $row['valor'],
                    "estado" => $row['estado']);
            }
        }
        return $citas;
    }

    public function crearfactura($idcita) {
        $fecha = date("Y-m-d");
        $valor = ($_POST['valor']) * 1.16;
        $idquery2 = "select nextval('facturas_idfactura_seq'::regclass) limit 1";
        $consult2 = $this->db->executeQue($idquery2);
        $row2 = $this->db->arrayResult($consult2);
        $idelemnto2 = $row2['nextval'];
        $consulta2 = $this->db->executeQue("insert into  facturas values($idelemnto2,$idcita,'$fecha','cancelada',$valor)");
        $consulta3 = $this->db->executeQue("select c.idcita, c.hora, c.anio, c.mes, c.dia, c.estado, f.valor,
	e.nombre, t.nombreconsultorio, s.nombreservicio 
        from  citas c,
              especialistas e,
              servicios s, 
              consultorios t,
              facturas f                      
        where c.idespecialista = e.idespecialista and
              e.idservicio     = s.idservicio and   
              t.idconsultorio = c.idconsultorio and
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
            "estado" => $row['estado']);
        $idverify = strrev(urlencode(base64_encode($citas['id'])));
        $idcode = sha1($citas['id']);
        $fecha = $citas['anio'] . "/" . $citas['mes'] . "/" . $citas['dia'];
        $usuarioidentificador = $this->getUserId();
        $rsss=$this->db->executeQue("select correo, nombre, cedula from pacientes where idusuario=$usuarioidentificador");
        $mipaciente=$this->db->arrayResult($rsss);
        $this->enviarcorreo($mipaciente['nombre'], $citas['hora'], $fecha, $mipaciente['correo'], $citas['especialista'], $mipaciente['cedula'], $citas['servicio'], $citas['consultorio']);
        echo "<script> parent.message('Se ha creado una nueva cita','images/iconosalerta/ok.png'); " .
        "parent.createdata('" . $citas['id'] . "','" . $citas['especialista'] . "','" .
        $citas['consultorio'] . "','" . $citas['servicio'] . "','" . $citas['hora'] . "','" .
        $fecha . "','" . $citas['valor'] . "','" . $citas['estado'] . "','$idcode','$idverify');" .
        "parent.$.fancybox.close();  </script>";
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

    public function cancelarcita() {
        if (isset($_POST["verify"])) {
            $idcita = base64_decode(urldecode(strrev($_POST["verify"])));
            $this->db->executeQue("update citas set estado='cancelado' where idcita=$idcita");
            $repuesta['res'] = 'si';
            $repuesta['idrow'] = $idcita;
            $repuesta['idcod'] = sha1($idcita);
            echo json_encode($repuesta);
        }
    }

    public function midisponibilidad($nuevahora, $dia, $mes, $tiemposervicio) {
        $idusuario = $this->getUserId();
        $consulta = $this->db->executeQue("select * from pacientes where idusuario=$idusuario");
        $row2 = $this->db->arrayResult($consulta);
        $idpaciente = $row2['idpaciente'];
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

    public function especialistaServicio() {
        $idcita = $_GET['idcita'];
        $consulta = $this->db->executeQue("select c.idespecialista, c.idconsultorio, e.idservicio, c.mes, c.dia, c.hora 
                        from citas c left join especialistas e on e.idespecialista=c.idespecialista
                        where c.idcita=$idcita");
        $row = $this->db->arrayResult($consulta);
        $paciente = array(
            "idconsultorio" => $row['idconsultorio'],
            "idservicio" => $row['idservicio'],
            "mes" => $row['mes'],
            "dia" => $row['dia'],
            "horacita" => $row['hora']);

        return $paciente;
    }

    public function obtenerconsultorioeditar($idconsult) {
        $consulta = $this->db->executeQue("select * from consultorios where idconsultorio=$idconsult");
        $row = $this->db->arrayResult($consulta);
        $consultorio = $row['nombreconsultorio'];
        return $consultorio;
    }

    public function obtenerservicioeditar($idserv) {
        $consulta = $this->db->executeQue("select * from servicios where idservicio=$idserv");
        while ($row = $this->db->arrayResult($consulta)) {
            $servicio = array(
                "nombreservicio" => $row['nombreservicio'],
                "tiempo" => $row['tiempo']);
        }
        return $servicio;
    }

}

?>
