<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class ComponentsModel extends ModelBase {

    public function getImagesBanner() {
        $consulta = $this->db->executeQue('select * from elementocomponente where idcomponente=2 order by ordenposicion asc');
        $total = $this->db->numRows($consulta);
        $imagenes = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $imagenes[] = array('id' => $row['idelementocomponente'],
                    'nombre' => $row['nombre'],
                    'imagen' => $row['url'],
                    'descripcion' => $row['descripcion']);
            }
        }
        return $imagenes;
    }

    public function getImageBanner($idimagen) {
        $consulta = $this->db->executeQue("select * from elementocomponente where idcomponente=2 and idelementocomponente=$idimagen");
        $total = $this->db->numRows($consulta);
        $imagenes = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $imagenes = array('id' => $row['idelementocomponente'],
                    'nombre' => $row['nombre'],
                    'imagen' => $row['url'],
                    'descripcion' => $row['descripcion']);
            }
        }
        return $imagenes;
    }

    public function subirImagen() {
        if ($_FILES["image"]["size"] != 0) {
            $destino = $_FILES["image"]["name"];
            copy($_FILES["image"]["tmp_name"], $destino);
            $imagen = new Imagen($destino);
            if (!$imagen->validarMinimos(549, 412)) {
                unlink($destino);
                $respuesta['repuesta'] = "no";
                echo json_encode($respuesta);
            } else {
                $imagen->redimencionMaximum(760);
                $namefile = time();
                $respuesta['repuesta'] = "si";
                $respuesta['tamano'] = $imagen->getAncho() + 100;
                $respuesta['url'] = $imagen->guardar(IMAGES . SL . "tmp" . SL . 'banner' . time(), 80, true);
                $respuesta['alto'] = $imagen->getAlto();
                $respuesta['ancho'] = $imagen->getAncho();
                unlink($destino);
                echo json_encode($respuesta);
            }
        }
    }

    public function finalizarImagen() {
        $urlimage = $_POST['editpicture'];
        $x1 = $_POST['x1'];
        $y1 = $_POST['y1'];
        $heigth = $_POST['h'];
        $width = $_POST['w'];
        $imagen = new Imagen($urlimage);
        $imagenmini = new Imagen($urlimage);
        $imagen->redimencion($x1, $y1, $width, $heigth);
        $imagen->redimencionMaximum($width, 412);
        $imagenmini->redimencion($x1, $y1, $width, $heigth);
        $imagenmini->redimencionMaximum(83, 45);
        $namefile = time();
        $newurl = $imagen->guardar(IMAGES . SL . "slideshow/bannerimg" . $namefile, 80, true);
        $imagen->guardar("../" . IMAGES . SL . "slideshow/bannerimg" . $namefile, 80, true);
        $newurlmini = $imagenmini->guardar(IMAGES . SL . "slideshow/bannerimg_mini" . $namefile, 80, true);
        $imagenmini->guardar("../" . IMAGES . SL . "slideshow/bannerimg_mini" . $namefile, 80, true);
        $consulta = $this->db->executeQue('select * from elementocomponente where idcomponente=2 order by ordenposicion asc');
        $total = $this->db->numRows($consulta) + 1;
        $idquery = "select nextval('elementocomponente_idelementocomponente_seq'::regclass) limit 1";
        $consult = $this->db->executeQue($idquery);
        $idelemnto = 0;
        while ($row = $this->db->arrayResult($consult)) {
            $idelemnto = $row['nextval'];
        }
        $user = $this->getUserId();
        $tiempo = date('Y-m-d H:i:s');
        if ($this->db->executeQue("insert into elementocomponente values($idelemnto,2,'imagen$idelemnto','$newurl','$newurlmini',$total,$user,'$tiempo','descripcion de la imagen')")) {
            unlink($urlimage);
            $idcode = sha1($idelemnto);
            $idverify = strrev(urlencode(base64_encode($idelemnto)));
            echo "<script>parent.parent.message('se ha creado una nueva imagen en el banner','images/iconosalerta/ok.png');" .
            "parent.parent.createdata('$idelemnto','imagen$idelemnto','descripcion de la imagen','$newurl','$idcode','$idverify');" .
            "parent.parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('Se produjo un error al crear la nueva imagen del banner','images/iconosalerta/error.png');" . "
                parent.$.fancybox.close();</script>";
        }
    }

    public function Deleteimgbanner() {
        if (isset($_POST["verify"])) {
            $bannerid = base64_decode(urldecode(strrev($_POST["verify"])));
            $consulta1 = $this->db->executeQue("select * from elementocomponente where idcomponente=2 and idelementocomponente=$bannerid");
            $imagen = null;
            while ($row2 = $this->db->arrayResult($consulta1)) {
                $imagen = $row2['url'];
            }
            if ($this->db->executeQue("delete from elementocomponente where idcomponente=2 and idelementocomponente=$bannerid")) {
                unlink($imagen);
                unlink('../' . $imagen);
                $nuevoorden = 1;
                $consult1 = $this->db->executeQue('select * from elementocomponente where idcomponente=2 order by ordenposicion asc');
                while ($row3 = $this->db->arrayResult($consult1)) {
                    $nuid = $row3['idelementocomponente'];
                    $this->db->executeQue("update elementocomponente set ordenposicion=$nuevoorden where idcomponente=2 and idelementocomponente=$nuid");
                    $nuevoorden++;
                }
                $repuesta['res'] = 'si';
                $repuesta['idrow'] = $bannerid;
                echo json_encode($repuesta);
            } else {
                $repuesta['res'] = 'no';
                echo json_encode($repuesta);
            }
        } else {
            $repuesta['res'] = 'no';
            echo json_encode($repuesta);
        }
    }

    public function Updateimgbanner() {
        if (isset($_POST["verifyid"]) && isset($_POST['formcorrect']) && $_POST['formcorrect'] == sha1(979867)) {
            $bannerid = base64_decode(urldecode(strrev($_POST["verifyid"])));
            $nombre = $_POST["name_imgban"];
            $descripcion = $_POST["descripcion"];
            if ($this->db->executeQue("update elementocomponente set nombre='$nombre'," .
                            "descripcion='$descripcion' where idcomponente=2 and idelementocomponente=$bannerid")) {

                echo "<script>parent.message('Se ha actualizado la imagen del banner','images/iconosalerta/ok.png');" .
                "parent.updatedata('$nombre','$bannerid','$descripcion');" .
                "parent.$.fancybox.close();</script>";
            } else {
                echo "<script>parent.message('Se produjo un error al actualizar la imagen del banner','images/iconosalerta/error.png');" . "
                parent.$.fancybox.close();</script>";
            }
        }
    }

    

    /*
     * 
     * 
     * 
     * 
     */

    public function getImagesGallery() {
        $consulta = $this->db->executeQue('select * from elementocomponente where idcomponente=1 order by ordenposicion asc');
        $total = $this->db->numRows($consulta);
        $imagenes = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $imagenes[] = array('id' => $row['idelementocomponente'],
                    'nombre' => $row['nombre'],
                    'imagen' => $row['url'],
                    'descripcion' => $row['descripcion']);
            }
        }
        return $imagenes;
    }

    public function subirImagenGal() {
        if ($_FILES["image"]["size"] != 0) {
            $destino = $_FILES["image"]["name"];
            copy($_FILES["image"]["tmp_name"], $destino);
            $imagen = new Imagen($destino);
            if (!$imagen->validarMinimos(200, 200)) {
                unlink($destino);
                echo "<script>parent.message('dimensiones de la imagen muy pequenias','images/iconosalerta/error.png');" . "
                window.location='index.php?controlador=Component&accion=createImageGalery';</script>";
            } else {
                $imagen->redimencionMaximum(900, 500);
                $namefile = time();
                $url = $imagen->guardar(IMAGES . SL . "galeria" . SL . 'itemgal' . $namefile, 80, true);
                $imagen->guardar("../" . IMAGES . SL . "galeria" . SL . 'itemgal' . $namefile, 80, true);
                unlink($destino);
                $consulta = $this->db->executeQue('select * from elementocomponente where idcomponente=1 order by ordenposicion asc');
                $total = $this->db->numRows($consulta) + 1;
                $idquery = "select nextval('elementocomponente_idelementocomponente_seq'::regclass) limit 1";
                $consult = $this->db->executeQue($idquery);
                $idelemnto = 0;
                while ($row = $this->db->arrayResult($consult)) {
                    $idelemnto = $row['nextval'];
                }
                $user = $this->getUserId();
                $tiempo = date('Y-m-d H:i:s');
                if ($this->db->executeQue("insert into elementocomponente values($idelemnto,1,'imagen$idelemnto','$url','$url',$total,$user,'$tiempo','descripcion de la imagen')")) {
                    $idcode = sha1($idelemnto);
                    $idverify = strrev(urlencode(base64_encode($idelemnto)));
                    echo "<script>parent.parent.message('se ha creado una nueva imagen en la galeria','images/iconosalerta/ok.png');" .
                    "parent.parent.createdata('$idelemnto','imagen$idelemnto','descripcion de la imagen','$url','$idcode','$idverify');" .
                    "parent.parent.$.fancybox.close();</script>";
                } else {
                    echo "<script>parent.parent.message('se ha producido un error al crear una nueva imagen en la galeria','images/iconosalerta/ok.png');" .
                    "parent.parent.$.fancybox.close();</script>";
                }
            }
        }
    }

    public function DeleteimgGaller() {
        if (isset($_POST["verify"])) {
            $bannerid = base64_decode(urldecode(strrev($_POST["verify"])));
            $consulta1 = $this->db->executeQue("select * from elementocomponente where idcomponente=1 and idelementocomponente=$bannerid");
            $imagen = null;
            while ($row2 = $this->db->arrayResult($consulta1)) {
                $imagen = $row2['url'];
            }
            if ($this->db->executeQue("delete from elementocomponente where idcomponente=1 and idelementocomponente=$bannerid")) {
                unlink($imagen);
                unlink('../' . $imagen);
                $nuevoorden = 1;
                $consult1 = $this->db->executeQue('select * from elementocomponente where idcomponente=1 order by ordenposicion asc');
                while ($row3 = $this->db->arrayResult($consult1)) {
                    $nuid = $row3['idelementocomponente'];
                    $this->db->executeQue("update elementocomponente set ordenposicion=$nuevoorden where idcomponente=1 and idelementocomponente=$nuid");
                    $nuevoorden++;
                }
                $repuesta['res'] = 'si';
                $repuesta['idrow'] = $bannerid;
                echo json_encode($repuesta);
            } else {
                $repuesta['res'] = 'no';
                echo json_encode($repuesta);
            }
        } else {
            $repuesta['res'] = 'no';
            echo json_encode($repuesta);
        }
    }

    public function InsertVideo() {
        $url=$_POST['url_video'];
        $urlmini= 'images/galeria/flash-logo2.png';
        $consulta = $this->db->executeQue('select * from elementocomponente where idcomponente=1 order by ordenposicion asc');
        $total = $this->db->numRows($consulta) + 1;
        $idquery = "select nextval('elementocomponente_idelementocomponente_seq'::regclass) limit 1";
        $consult = $this->db->executeQue($idquery);
        $idelemnto = 0;
        while ($row = $this->db->arrayResult($consult)) {
            $idelemnto = $row['nextval'];
        }
        $user = $this->getUserId();
        $tiempo = date('Y-m-d H:i:s');
        if ($this->db->executeQue("insert into elementocomponente values($idelemnto,1,'video$idelemnto','$url','$urlmini',$total,$user,'$tiempo','descripcion de la imagen')")) {
            $idcode = sha1($idelemnto);
            $idverify = strrev(urlencode(base64_encode($idelemnto)));
            echo "<script>parent.parent.message('se ha creado un nuevo video en la galeria','images/iconosalerta/ok.png');" .
            "parent.parent.createdata('$idelemnto','video$idelemnto','descripcion del video','$urlmini','$idcode','$idverify');" .
            "parent.parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.parent.message('se ha producido un error al crear un nuevo video en la galeria','images/iconosalerta/ok.png');" .
            "parent.parent.$.fancybox.close();</script>";
        }
    }

}

?>