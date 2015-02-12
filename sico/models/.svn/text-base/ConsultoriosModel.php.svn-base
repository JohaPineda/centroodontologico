<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class ConsultoriosModel extends ModelBase {

    public function traerconsultorios() {
        $consulta = $this->db->executeQue("select * from consultorios");
        $consultorios;
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $subconsulta = $this->db->executeQue("select * from citas where idconsultorio=" . $row['idconsultorio']);
                $citas = $this->db->numRows($subconsulta);
                $consultorios[] = array(
                    "id" => $row['idconsultorio'],
                    "nombreconsultorio" => $row['nombreconsultorio'],
                    "direccion" => $row['direccion'],
                    "telefono" => $row['telefono'],
                    "citas" => $citas);
            }
        }
        return $consultorios;
    }

    public function crearconsultorios($nombre, $direccion, $telefono) {
        $idquery2 = "select nextval('consultorios_id_seq'::regclass) limit 1";
        $consult2 = $this->db->executeQue($idquery2);
        $row = $this->db->arrayResult($consult2);
        $idconsultorio = $row['nextval'];
        if ($this->db->executeQue("insert into consultorios values($idconsultorio,'$nombre','$direccion',$telefono)")) {
            $idcode = sha1($idconsultorio);
            $idverify = strrev(urlencode(base64_encode($idconsultorio)));
            echo "<script>parent.parent.message('se ha creado un nuevo consultorio','images/iconosalerta/ok.png');" .
            "parent.createdata('$idconsultorio','$nombre','$direccion',$telefono,'$idcode','$idverify');" .
            "parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo crear el consultorio', 'images/iconosalerta/error.png');" .
            "parent.$.fancybox.close();</script>";
        }
    }

    public function editarconsultorios($idconsultorio) {
        $consulta = $this->db->executeQue("select * from consultorios where idconsultorio = $idconsultorio");
        $consultorios;
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            $row = $this->db->arrayResult($consulta);
            $consultorios = array(
                "id" => $idconsultorio,
                "nombre" => $row['nombreconsultorio'],
                "direccion" => $row['direccion'],
                "telefono" => $row['telefono']);
        }
        return $consultorios;
    }

    public function updateconsultorio($idconsultorio, $nombre, $direccion, $telefono) {
        if ($this->db->executeQue("update consultorios set 
                                    nombreconsultorio = '$nombre',  
                                    direccion         = '$direccion',
                                    telefono          = $telefono where  
                                    idconsultorio     = $idconsultorio")) {
            echo "<script>parent.message('Se ha actualizado el consultorio', 'images/iconosalerta/ok.png');" .
            "parent.updatedata($idconsultorio,'$nombre','$direccion',$telefono);" .
            "parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo actualizar el consultorio', 'images/iconosalerta/error.png');" .
            "parent.$.fancybox.close();</script>";
        }
    }

    public function deleteconsultorio() {
        if (isset($_POST["verify"])) {
            $consultorioid = base64_decode(urldecode(strrev($_POST["verify"])));
            $query4 = "delete from consultorios where idconsultorio=$consultorioid";
            if ($this->db->executeQue($query4)) {
                $respuesta['res'] = 'si';
                $respuesta['idrow'] = $consultorioid;
                echo json_encode($respuesta);
            } else {
                $respuesta['res'] = 'no';
                echo json_encode($respuesta);
            }
        }
    }

}

?>
