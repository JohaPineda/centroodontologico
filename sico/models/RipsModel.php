<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class RipsModel extends ModelBase {

    public function traerConsultas() {
        $consulta = $this->db->executeQue("
        SELECT  facturas.idfactura, 
                pacientes.cedula, 
                concat(citas.anio,'/',citas.mes,'/',citas.dia) as fecha,   
                facturas.valor,
                servicios.nombreservicio 
        FROM    public.facturas, 
                public.citas, 
                public.pacientes, 
                public.servicios, 
                public.especialistas
        WHERE   facturas.idcita      = citas.idcita AND
                citas.idpaciente     = pacientes.idpaciente AND
                citas.idespecialista = especialistas.idespecialista AND
                especialistas.idservicio = servicios.idservicio;");
        while ($row = $this->db->arrayResult($consulta)) {
            $consultas[] = array('id' => $row['idfactura'],
                'cedula' => $row['cedula'],
                'fecha' => $row['fecha'],
                'servicio' => $row['nombreservicio'],
                'valor' => $row['valor']);
        }
        return $consultas;
    }

    public function traerProcedimientos() {
        $consulta = $this->db->executeQue("
        SELECT  facturas.idfactura, 
                pacientes.cedula,   
                concat(citas.anio,'/',citas.mes,'/',citas.dia) as fecha,   
                facturas.valor,servicios.idservicio, 
                servicios.nombreservicio,
                especialistas.nombre ,
                procedimientos.diagnostico    
        FROM    public.facturas,  
                public.citas,   
                public.pacientes, 
                public.servicios, 
                public.especialistas,
                public.procedimientos
        WHERE   facturas.idcita      = citas.idcita AND
                citas.idpaciente     = pacientes.idpaciente AND
                citas.idespecialista = especialistas.idespecialista AND
                especialistas.idservicio = servicios.idservicio AND
                procedimientos.idcita = citas.idcita ;");
        while ($row = $this->db->arrayResult($consulta)) {
            $consultas[] = array('id' => $row['idfactura'],
                'cedula' => $row['cedula'],
                'fecha' => $row['fecha'],
                'servicio' => $row['nombreservicio'],
                'valor' => $row['valor'],
                'codiserv' => $row['idservicio'],
                'nomesp' => $row['nombre'],
                'diagnostico' => $row['diagnostico']);
        }
        return $consultas;
    }

    public function traerCitasEspecialista() {
        $usuario = $this->getUserId();
        $consulta = $this->db->executeQue("
            SELECT p.idpaciente,p.nombre,p.cedula, c.hora, c.idcita, s.nombreservicio,e.nombre as medico,concat(c.anio,'/',c.mes,'/',c.dia) as fecha,c.estado
            FROM  
                pacientes p,  
                citas c, 
                especialistas e, 
                servicios s,
                usuarios u
            WHERE   
                c.idpaciente = p.idpaciente AND
                c.idespecialista = e.idespecialista AND  
                e.idservicio = s.idservicio AND
                e.idusuario  = u.idusuario AND
                u.idusuario = $usuario");
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $citas[] = array(
                    "id" => $row['idcita'],
                    "idpac" => $row['idpaciente'],
                    "nombrepaciente" => $row['nombre'],
                    "cedula" => $row['cedula'],
                    "fecha" => $row['fecha'],
                    "hora" => $this->formatohora($row['hora']),
                    "servicio" => $row['nombreservicio'],
                    "estado" => $row['estado']);
            }
        }
        return $citas;
    }

    public function formatohora($minutos) {
        $formato = $minutos / 60;
        $decimales = explode(".", number_format($formato, 2, ".", ""));
        if ($decimales[1] != 0) {
            $calc = ($decimales[1] * 60) / 100;
            $formt = ":" . $calc . "";
        } else {
            $formt = ":00";
        }
        $hora = $decimales[0] . $formt;

        return $hora;
    }

    public function historiaClinica($idpaciente, $idcita) {
        $consulta = $this->db->executeQue("
      select p.idpaciente,p.nombre as nombrep,p.cedula,p.correo,p.fechanacimiento,p.telefono,p.celular,e.nombre as nombree,s.nombreservicio,c.idcita
      from  citas c, 
            pacientes p, 
            especialistas e,  
            servicios s
        where  c.idpaciente = p.idpaciente and
            c.idespecialista = e.idespecialista and
            e.idservicio = s.idservicio and
                c.idcita = $idcita  and     
            p.idpaciente = $idpaciente");
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $historia = array(
                    "id" => $row['idpaciente'],
                    "idcita" => $row['idcita'],
                    "nombrepaciente" => $row['nombrep'],
                    "cedula" => $row['cedula'],
                    "correo" => $row['correo'],
                    "fnacimiento" => $row['fechanacimiento'],
                    "telefono" => $row['telefono'],
                    "celular" => $row['celular'],
                    "edad" => date('Y-m-d') - $row['fechanacimiento'],
                    "servicio" => $row['nombreservicio'],
                    "especialista" => $row['nombree']);
                $consulta5 = $this->db->executeQue("
                        select p.fecha,p.diagnostico,p.sangrado,p.sexo,p.dolor,e.nombre as nombree 
                        from   procedimientos p, citas c, especialistas e  
                        where  p.idcita=c.idcita and c.idespecialista= e.idespecialista and p.idpaciente = $idpaciente");
                $total5 = $this->db->numRows($consulta5);
                if ($total5 > 0) {
                    while ($row = $this->db->arrayResult($consulta5)) {
                        $procedimientos[] = array('id' => $row['idpaciente'],
                            'sangrado' => $row['sangrado'],
                            'diagnostico' => $row['diagnostico'],
                            'sexo' => $row['sexo'],
                            'fecha' => $row['fecha'],
                            'nombree' => $row['nombree'],
                            'dolor' => $row['dolor']);
                    }
                }
            }
        }
        $detalles = array(0 => $historia, 1 => $procedimientos);
        return $detalles;
    }

    public function procedimientos() {
        $idpaciente = $_POST["idpaciente"];
        $idcita = $_POST["idcita"];
        $dolor = $_POST["dolor"];
        $sangrado = $_POST["sangrado"];
        $diagnostico = $_POST["diagnostico"];
        $sexo = $_POST["sexo"];
        $fecha = date('Y-m-d');
        $idquery2 = "select nextval('procedimientos_idprocedimiento_seq'::regclass) limit 1";
        $consult2 = $this->db->executeQue($idquery2);
        $row = $this->db->arrayResult($consult2);
        $idprocedimiento = $row['nextval'];
        if ($this->db->executeQue("insert into procedimientos values($idprocedimiento,$idpaciente,$idcita,'$dolor','$sangrado','$diagnostico','$sexo','$fecha');
                update citas set estado = 'realizada' where idcita= $idcita")) {
            echo "<script>parent.parent.message('se ha guardado la historia clinica','images/iconosalerta/ok.png');" .   
                  "parent.updatedata('$idcita');" .     
            "parent.$.fancybox.close();</script>";
        } else { 
            echo "<script>parent.message('No se pudo guardar la historia clinica', 'images/iconosalerta/error.png');" .
            "parent.$.fancybox.close();</script>";
        }
    }

}

?>
