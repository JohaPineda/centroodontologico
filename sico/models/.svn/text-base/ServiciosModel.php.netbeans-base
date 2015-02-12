<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class ServiciosModel extends ModelBase {

    public function traerservicios() {
        $consulta = $this->db->executeQue("select * from servicios");
        $servicios;
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $consulta2 = $this->db->executeQue("select * from especialistas where idservicio=" . $row['idservicio']);
                $doctores = $this->db->numRows($consulta2);
                $servicios[] = array(
                    "id" => $row['idservicio'],
                    "nombre" => $row['nombreservicio'],
                    "tiempo" => $row['tiempo'],
                    "valor" => $row['valor'],
                    "descripcion" => $row['descripcion'],
                    "doctores" => $doctores);
            }
        }
        return $servicios;
    }

    public function editarservicios($idservicio) {
        $consulta = $this->db->executeQue("select * from servicios where idservicio = $idservicio");
        $servicios;
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            $row = $this->db->arrayResult($consulta);
            $servicios = array(
                "id" => $idservicio,
                "nombre" => $row['nombreservicio'],
                "tiempo" => $row['tiempo'],
                "valor" => $row['valor'],
                "descripcion" => $row['descripcion']);
        }
        return $servicios;
    }

    public function updateservicio($idservicio, $nombre, $tiempo, $valor, $descripcion) {
        if ($this->db->executeQue("update servicios set 
                                    nombreservicio = '$nombre',
                                    tiempo         = $tiempo,
                                    valor          = $valor, 
                                    descripcion    = '$descripcion' where 
                                    idservicio    = $idservicio")) {
            echo "<script>parent.message('Se ha actualizado el servicio', 'images/iconosalerta/ok.png');" .
            "parent.updatedata($idservicio,'$nombre',$tiempo,$valor,'$descripcion');" .
            "parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo actualizar el servicio', 'images/iconosalerta/error.png');" .
            "parent.$.fancybox.close();</script>";
        }
    }

    //falta actualizar cuando elimina el item
    public function deleteservicio() {
        if (isset($_POST["verify"])) {
            $servicioid = base64_decode(urldecode(strrev($_POST["verify"])));
            $query4 = "delete from servicios where idservicio=$servicioid";
            if ($this->db->executeQue($query4)) {
                $respuesta['res'] = 'si';
                $respuesta['idrow'] = $servicioid;
                echo json_encode($respuesta);
            } else {
                $respuesta['res'] = 'no';
                echo json_encode($respuesta);
            }
        }
    }

    //falta create data
    public function crearservicios($nombre, $tiempo, $valor, $descripcion) {
        $idquery2 = "select nextval('servicios_idservicio_seq'::regclass) limit 1";
        $consult2 = $this->db->executeQue($idquery2);
        $row = $this->db->arrayResult($consult2);
        $idservicio = $row['nextval'];
        if ($this->db->executeQue("insert into servicios values($idservicio,'$nombre',$tiempo,$valor,'$descripcion')")) {
            $idcode = sha1($idservicio);
            $idverify = strrev(urlencode(base64_encode($idservicio)));
            echo "<script>parent.message('Se ha creado el servicio con exito', 'images/iconosalerta/ok.png');" .
            "parent.createdata('$idservicio','$nombre','$tiempo',$valor,'$descripcion','$idcode','$idverify');" .
            "parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo crear el servicio', 'images/iconosalerta/error.png');" .
            "parent.$.fancybox.close();</script>";
        }
    }

}

?>
