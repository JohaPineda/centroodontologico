<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class UsuariosModel extends ModelBase {

    public function traerEspecialistas() {
        $consulta = $this->db->executeQue("select u.idusuario, e.idespecialista, e.nombre, c.nombreconsultorio, s.nombreservicio
from especialistas e, consultorios c, servicios s, usuarios u
where e.idconsultorio=c.idconsultorio and e.idservicio=s.idservicio and e.idusuario=u.idusuario");
        while ($row = $this->db->arrayResult($consulta)) {
            $subconsulta = $this->db->executeQue("select * from citas where idespecialista=" . $row['idespecialista']);
            $citas = $this->db->numRows($subconsulta);
            $especialistas[] = array('id' => $row['idespecialista'],
                'nombre' => $row['nombre'],
                'consultorio' => $row['nombreconsultorio'],
                'servicio' => $row['nombreservicio'],
                'citas' => $citas);
        }
        return $especialistas;
    }

    public function traerSericios() {
        $consulta = $this->db->executeQue("select * from servicios");
        while ($row = $this->db->arrayResult($consulta)) {
            $servicios[] = array('id' => $row['idservicio'],
                'nombre' => $row['nombreservicio'],
                'tiempo' => $row['tiempo'],
                'valor' => $row['valor']);
        }
        return $servicios;
    }

    public function traerConsultorios() {
        $consulta = $this->db->executeQue("select * from consultorios");
        while ($row = $this->db->arrayResult($consulta)) {
            $consultorios[] = array('id' => $row['idconsultorio'],
                'nombre' => $row['nombreconsultorio'],
                'direccion' => $row['direccion'],
                'telefono' => $row['telefono']);
        }
        return $consultorios;
    }

    public function deleteMedico() {
        if (isset($_POST['verify'])) {
            $idmedico = base64_decode(urldecode(strrev($_POST['verify'])));
            $idquery = "delete from especialistas where idespecialista=$idmedico";
            if ($this->db->executeQue($idquery)) {
                echo json_encode(array('res' => 'si', 'idrow' => $idmedico));
            } else {
                echo json_encode(array('res' => 'no'));
            }
        } else {
            echo json_encode(array('res' => 'no'));
        }
    }

    public function inactivarusuario() {
        if (isset($_POST['verify'])) {
            $idpaciente = base64_decode(urldecode(strrev($_POST['verify'])));
            $paciente = $this->db->executeQue($query = "select u.idusuario from usuarios u,pacientes p where p.idusuario = u.idusuario and p.idpaciente = $idpaciente ");
            while ($row = $this->db->arrayResult($paciente)) {
                $pacientes = array('idusuario' => $row['idusuario']);
            }
            $pac = $pacientes["idusuario"];
            $idquery = "update usuarios set estado = 'inactivo' where idusuario = $pac";
            if ($this->db->executeQue($idquery)) {
                echo json_encode(array('res' => 'si', 'idrow' => $idmedico));
            } else {
                echo json_encode(array('res' => 'no'));
            }
        } else {
            echo json_encode(array('res' => 'no'));
        }
    }

    public function insertEspecialista() {
        $fullname = $_POST['nombre'];
        $alias = $_POST['usuario'];
        $pass = sha1($_POST['pass']);
        $consultorio = $_POST['consultorio'];
        $servicio = $_POST['servicio'];
        $idquery2 = "select nextval('usuarios_idusuario_seq'::regclass) limit 1";
        $consult2 = $this->db->executeQue($idquery2);
        $row = $this->db->arrayResult($consult2);
        $idusuario = $row['nextval'];
        $tiempo = date('Y-m-d H:i:s');
        if ($this->db->executeQue("insert into usuarios 
                values($idusuario,3,'$alias','$pass','$fullname',NULL,'$tiempo',1,'$tiempo',1,'activo')")) {
            $idquery2 = "select nextval('especialistas_idespecialista_seq'::regclass) limit 1";
            $consult2 = $this->db->executeQue($idquery2);
            $row2 = $this->db->arrayResult($consult2);
            $idelemnto = $row2['nextval'];
            $idquery = "insert into especialistas
        values($idelemnto,$idusuario,'$fullname',$consultorio,$servicio)";
            if ($this->db->executeQue($idquery)) {
                $idcode = sha1($idelemnto);
                $idverify = strrev(urlencode(base64_encode($idelemnto)));
                $array = $this->traerNombreConsultorioServicio($consultorio, $servicio);
                $nomcon = $array['consultorio'];
                $nomser = $array['servicio'];
                echo "<script>parent.parent.message('se ha creado un nuevo especialista','images/iconosalerta/ok.png');" .
                "parent.createdata('$idelemnto','$fullname','$nomcon','$nomser','$idcode','$idverify');" .
                "parent.$.fancybox.close();</script>";
            } else {
                echo "<script>parent.parent.message('se ha creado un nuevo especialista','images/iconosalerta/ok.png');" .
                "parent.parent.$.fancybox.close();</script>";
            }
        } else {
            echo "<script>parent.parent.message('se ha creado un nuevo especialista','images/iconosalerta/ok.png');" .
            "parent.parent.$.fancybox.close();</script>";
        }
    }

    private function traerNombreConsultorioServicio($consultorio, $servicio) {
        $consult1 = "select nombreconsultorio from consultorios where idconsultorio=$consultorio";
        $consult2 = "select nombreservicio from servicios where idservicio=$servicio";
        $res1 = $this->db->executeQue($consult1);
        $res2 = $this->db->executeQue($consult2);
        $row1 = $this->db->arrayResult($res1);
        $row2 = $this->db->arrayResult($res2);
        return array('consultorio' => $row1['nombreconsultorio'], 'servicio' => $row2['nombreservicio']);
    }

    public function editarespecialista($idespecialista) {
        $consulta = $this->db->executeQue("select * from especialistas where idespecialista = $idespecialista");
        $especialista;
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            $row = $this->db->arrayResult($consulta);
            $especialista = array(
                "id" => $idespecialista,
                "nombre" => $row['nombre'],
                "idcons" => $row['idconsultorio'],
                "idserv" => $row['idservicio']);
        }
        return $especialista;
    }

    //falta actualizar en pantalla   
    public function updateespecialista($nombre, $idespecialista, $consultorio, $servicio) {
        $consulta2 = $this->db->executeQue("select  nombreservicio 
                                    from   servicios
                                    where  idservicio = $servicio");
        while ($row = $this->db->arrayResult($consulta2)) {
            $serv = array('nombreservicio' => $row['nombreservicio']);
        }
        $nombres = $serv['nombreservicio'];

        $consulta3 = $this->db->executeQue("select nombreconsultorio 
                                    from   consultorios
                                    where  idconsultorio = $consultorio");
        while ($row = $this->db->arrayResult($consulta3)) {
            $consul = array('nombreconsultorio' => $row['nombreconsultorio']);
        }
        $nombrec = $consul['nombreconsultorio'];
        if ($this->db->executeQue("update especialistas set  
                                    nombre         = '$nombre',
                                    idconsultorio  = $consultorio,
                                    idservicio     = $servicio where  
                                    idespecialista = $idespecialista")) {
            echo "<script>parent.message('Se ha actualizado el especialista', 'images/iconosalerta/ok.png');" .
            "parent.updatedata($idespecialista,'$nombre','$nombrec','$nombres');" .
            "parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo actualizar el especialista', 'images/iconosalerta/error.png');" .
            "parent.$.fancybox.close();</script>";
        }
    }

    public function traerPacientes() {
        $consulta = $this->db->executeQue("select * from pacientes p, usuarios u where p.idusuario=u.idusuario");
        while ($row = $this->db->arrayResult($consulta)) {
            $pacientes[] = array('id' => $row['idpaciente'],
                'nombre' => $row['nombre'],
                'cedula' => $row['cedula'],
                'correo' => $row['correo'],
                'telefono' => $row['telefono'],
                'celular' => $row['celular'],
                'direccion' => $row['direccion'],
                'estado' => $row['estado']);
        }
        return $pacientes;
    }

    public function editarpaciente($idpaciente) {
        $consulta = $this->db->executeQue("select * from pacientes where idpaciente = $idpaciente");
        $paciente;
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            $row = $this->db->arrayResult($consulta);
            $paciente = array(
                "id" => $idpaciente,
                "nombre" => $row['nombre'],
                "cedula" => $row['cedula'],
                "correo" => $row['correo'],
                "telefono" => $row['telefono'],
                "celular" => $row['celular'],
                "direccion" => $row['direccion']);
        }
        return $paciente;
    }

    public function updatepaciente($idpaciente, $nombre, $cedula, $correo, $celular, $telefono) {
        if ($this->db->executeQue("update pacientes set  
                                    nombre    = '$nombre', 
                                    cedula    = $cedula,   
                                    correo    = '$correo',  
                                    celular   = $celular,   
                                    telefono  = $telefono where   
                                    idpaciente = $idpaciente")) {
            echo "<script>parent.message('Se ha actualizado el paciente', 'images/iconosalerta/ok.png');" .
            "parent.updatedata('$idpaciente','$nombre','$cedula','$correo');" .
            "parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo actualizar el paciente', 'images/iconosalerta/error.png');" .
            "parent.$.fancybox.close();</script>";
        }
    }

    public function insertPaciente() {
        $nombre = $_POST['nombre'];
        $cedula = $_POST['cedula'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $celular = $_POST['celular'];
        $direccion = $_POST['direccion'];
        $alias = $_POST['alias'];
        $pass = sha1($_POST['pass']);
        $direccion = $_POST['direccion'];
        $tiempo = date('Y-m-d H:i:s');
        $idquery2 = "select nextval('usuarios_idusuario_seq'::regclass) limit 1";
        $consult2 = $this->db->executeQue($idquery2);
        $row = $this->db->arrayResult($consult2);
        $idusuario = $row['nextval'];
        if ($this->db->executeQue("insert into usuarios  values($idusuario,2,'$alias','$pass','$nombre','$correo','$tiempo',1,'$tiempo',1,'activo')")) {
            $idcode = sha1($idelemnto);
            $idverify = strrev(urlencode(base64_encode($idelemnto)));
            $idquery2 = "select nextval('especialistas_idespecialista_seq'::regclass) limit 1";
            $consult2 = $this->db->executeQue($idquery2);
            $row2 = $this->db->arrayResult($consult2);
            $idelemnto = $row2['nextval'];
            $idquery = "insert into pacientes  
        values($idelemnto,$idusuario,'$nombre',$cedula,'$correo',$telefono,$celular,'images/defaultuser.jpg',NULL,'$direccion')";
            if ($this->db->executeQue($idquery)) {
                echo "<script>parent.parent.message('se ha creado un nuevo paciente','images/iconosalerta/ok.png');" .
                "parent.createdata('$idelemnto','$nombre','$cedula','$correo','activo','$idcode','$idverify');" .
                "parent.$.fancybox.close();</script>";
            } else {
                echo "<script>parent.parent.message('se ha creado un nuevo paciente','images/iconosalerta/ok.png');" .
                "parent.parent.$.fancybox.close();</script>";
            }
        } else {
            echo "<script>parent.parent.message('se ha creado un nuevo paciente','images/iconosalerta/ok.png');" .
            "parent.parent.$.fancybox.close();</script>";
        }
    }

}

?>
