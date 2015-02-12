<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class MiPerfilModel extends ModelBase {

    public function modificarPassword($password) {
        $idusuario = $this->getUserId();
        $nuevacont = sha1($password);
        $consulta = "update usuarios set password='$nuevacont' where idusuario=$idusuario";
        if ($this->db->executeQue($consulta)) {
            $respuesta["respuesta"] = "si";
            echo json_encode($respuesta);
        } else {
            $respuesta["respuesta"] = "no";
            echo json_encode($respuesta);
        }
    }

    public function modificarMiperfil() {
        $idusuario = $this->getUserId();
        $direccion = $_POST["direccion"];
        $fnacimiento = $_POST["fechanacimiento"];
        $email = $_POST["correo"]; 
        $telefono = $_POST["telefono"];
        $celular = $_POST["celular"];  
        $consulta = "update pacientes set direccion='$direccion', correo='$email', telefono='$telefono',celular='$celular',fechanacimiento='$fnacimiento' where idusuario=$idusuario;";
        $consulta.= "update usuarios set  email='$email'  where idusuario=$idusuario";
        if ($this->db->executeQue($consulta)) {
            $respuesta["respuesta"] = "si";
            echo json_encode($respuesta);
        } else {
            $respuesta["respuesta"] = "no";
            echo json_encode($respuesta);
        }
        return $respuesta;
    }

    public function getPaciente() {
        $idusuario = $this->getUserId();
        $consulta = $this->db->executeQue("select * from pacientes p left join usuarios u on p.idusuario=u.idusuario where u.idusuario=$idusuario");
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $paciente = array(
                    "nombre" => $row['nombre'],
                    "cedula" => $row['cedula'],                     
                    "fechanacimiento" => explode(" ",(($row['fechanacimiento']))),
                    "alias" => $row['alias'],
                    "correo" => $row['correo'],
                    "direccion" => $row['direccion'],
                    "telefono" => $row['telefono'],
                    "celular" => $row['celular'],
                    "imagen" => $row['imagen']);
            }
        }
        return $paciente;
    }
    public function uploadPicture() {
        if ($_FILES["pic"]["size"] != 0) {
            $destino = $_FILES["pic"]["name"];
            copy($_FILES["pic"]["tmp_name"], $destino);
            $imagen = new Imagen($destino);
            $imagen->redimencionMaximum(225, 225);
            $namefile = time();
            $url_new = $imagen->guardar(IMAGES . SL . "tmp" . SL . $namefile, 100, true);
            unlink($destino);
            $idusuario=$this->getUserId();           
            $query = "update pacientes set imagen='$url_new' where idusuario=$idusuario";            
            $this->db->executeQue($query);
            if (isset($_POST['versioning'])) {                
                echo "<script> function terminarfin2(){ $(\"#imagen\",window.parent.document).html('<img title=\"\"  alt=\"abc\" src=\"$url_new\" />');" .
                "parent.message('Imagen subida con exito', 'images/iconosalerta/ok.png');" .
                "parent.$.fancybox.close();}setTimeout('terminarfin2()','300');</script>";
            } else {
                echo json_encode(array('status' => 'ok',
                    'newurl' => $url_new));
            }
        }
    }

}
?>

