<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class RegistrarUsuarioModel extends ModelBase {

    public function insertarpaciente() {
        $alias = $_POST["alias"];
        $cedula = $_POST["cedula"];
        $correo = $_POST["correo"];
        $direccion = $_POST["direccion"];
        $fullname = $_POST["fullname"];
        $pass = sha1($_POST["pass"]);
        $telefono = $_POST["telefono"]?$_POST["telefono"]:"NULL";
        $celular = $_POST["celular"]?$_POST["celular"]:"NULL";
        $fechanacimiento = $_POST["fechanacimiento"];
        $idquery = "select nextval('usuarios_idusuario_seq'::regclass) limit 1";
        $consult = $this->db->executeQue($idquery);
        $idelemnto = 0;
        while ($row = $this->db->arrayResult($consult)) {
            $idelemnto = $row['nextval'];
        }
        $tiempo = date('Y-m-d H:i:s');
        if ($this->db->executeQue("insert into usuarios values($idelemnto,2,'$alias','$pass','$fullname','$correo','$tiempo',1,'$tiempo',1,'activo')")) {
            $idquery2 = "select nextval('\"pacientes_idPaciente_seq\"'::regclass) limit 1";
            $consult2 = $this->db->executeQue($idquery2);
            $idelemnto2 = 0;
            while ($row2 = $this->db->arrayResult($consult2)) {
                $idelemnto2 = $row2['nextval'];
            }
            if ($this->db->executeQue("insert into pacientes values($idelemnto2,$idelemnto,'$fullname',$cedula,'$correo',$telefono,$celular,'images/defaultuser.jpg','$fechanacimiento','$direccion')")) {
                $this->enviarcorreo($fullname, $correo,$alias,$telefono,$celular,$fechanacimiento,$cedula,$_POST["pass"]);
                $respuesta['respuesta'] = 'si';
                echo json_encode($respuesta);
            } else {
                $respuesta['respuesta'] = 'no';
                echo json_encode($respuesta);
            }
        } else {
            $respuesta['respuesta'] = 'no';
            echo json_encode($respuesta);
        }
    }

    private function enviarcorreo($nombre, $correo, $user, $tel, $cel, $fecha, $cedula, $pass) {
        $email = new Correo();
        $email->emailFrom($this->config->get("mail"));
        $email->nameFrom($this->config->get("company"));
        $email->subject("Nuevo Usuario");
        $email->emailTo($correo);
        $email->respondTo($this->config->get("mail"));
        $email->mailBody("Bienvenido(a) $nombre a consultorios abc <br><br>
                A continuaci&oacute;n se encuentra la informaci&oacute;n con la que realiz&oacute; el registro: <br><br>
                Cedula: $cedula<br>
                Nombre: $nombre<br>
                Correo: $correo<br>
                Fecha de nacimiento: $fecha<br>
                telefono: $tel<br>
                Celular: $cel<br><br><br><br>
                A continuaci&oacute;n se encuentra la informaci&oacute;n de usuario con la cual va poder ingresar al sistema: <br><br>
                Usuario: $user<br>
                Contrase&ntilde;a: $pass");        
        $email->send();
    }
 
    public function passwordpaciente() {
        $nuevacont = "abc1234";
        $alias = $_POST["alias"];
        $consulta = $this->db->executeQue("select * from usuarios where alias='$alias'");
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $idusuario = $row['idusuario'];
                $correo = $row['email'];
                $alias = $row['alias'];
            }
            $passcod=  sha1($nuevacont);
            if ($this->db->executeQue("update usuarios set password='$passcod' where idusuario=$idusuario")) {
                $this->correopassword($alias, $correo, $nuevacont);
                $rta['respuesta'] = "si";
                echo json_encode($rta);
            }
        } else {
            $rta['respuesta'] = "no";
            echo json_encode($rta);
        }
    }

    private function correopassword($usuario, $correo, $nuevacont) {
        $coreeoempresa = "dachijogeka@hotmail.com";
        $email = new Correo();
        $email->emailFrom($coreeoempresa);
        $email->nameFrom("Consultorio abc");
        $email->subject("Reestablecer Contraseña");
        $email->emailTo($correo);
        $email->respondTo($coreeoempresa);
        $email->mailBody("Señor(a): $usuario su nueva contraseña es $nuevacont");
        $email->send();
    }
}
?>
