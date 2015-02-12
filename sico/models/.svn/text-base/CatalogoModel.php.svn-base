<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class CatalogoModel extends ModelBase {

    public function getConsultorios() {
        $consulta = $this->db->executeQue('select * from consultorios order by nombre asc');
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $consultorios[] = array('id' => $row['idconsultorio'],
                    'nombre' => $row['nombre']);
            }
        }
        return $consultorios;
    }

    public function getCategoria() {
        $idcategoria = $_GET['catid'];
        $consulta = $this->db->executeQue('select * from categorias where idcategoria=' . $idcategoria);
        $total = $this->db->numRows($consulta);
        $categoroia = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $categoroia = array('id' => $row['idcategoria'],
                    'nombre' => $row['nombrecategoria'],
                    'imagen' => $row['imgcategoria'],
                    'descripcion' => $row['descripcion']);
            }
        }
        return $categoroia;
    }

    public function getSubCategorias() {
        $idcategoria = $_GET['catid'];
        $consulta = $this->db->executeQue("select * from subcategorias where idcategoria=$idcategoria order by nombresubcategoria asc");
        $total = $this->db->numRows($consulta);
        $subcategoroias = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $subid = $row['idsubcategoria'];
                $consulta2 = $this->db->executeQue("select * from productos where idsubcategoria=$subid");
                $productos = $this->db->numRows($consulta2);
                $subcategoroias[] = array('id' => $row['idsubcategoria'],
                    'nombre' => $row['nombresubcategoria'],
                    'productos' => $productos);
            }
        }
        return $subcategoroias;
    }

    public function subirImagen() {

        if ($_FILES["image"]["size"] != 0) {
            $destino = $_FILES["image"]["name"];
            copy($_FILES["image"]["tmp_name"], $destino);
            $imagen = new Imagen($destino);
            if (!$imagen->validarMinimos(290, 200)) {
                unlink($destino);
                $respuesta['repuesta'] = "no";
                echo json_encode($respuesta);
            } else {
                $imagen->redimencionMaximum(500, 500);
                $namefile = time();
                $respuesta['repuesta'] = "si";
                $respuesta['url'] = $imagen->guardar(IMAGES . SL . "tmp" . SL . 'categoria' . time(), 100, true);
                $respuesta['alto'] = $imagen->getAlto();
                $respuesta['ancho'] = $imagen->getAncho();
                unlink($destino);
                echo json_encode($respuesta);
            }
        }
    }

    public function finalizarImagen() {
        $idcategoria = $_POST['categoriapic'];
        $urlimage = $_POST['editpicture'];
        $x1 = $_POST['x1'];
        $y1 = $_POST['y1'];
        $heigth = $_POST['h'];
        $width = $_POST['w'];
        $consulta = $this->db->executeQue('select * from categorias where idcategoria=' . $idcategoria);
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $id = $row['idcategoria'];
                $nombre = $row['nombrecategoria'];
                $descripcion = $row['descripcion'];
                $imagen = new Imagen($urlimage);
                $imagen->redimencion($x1, $y1, $width, $heigth);
                $imagen->redimencionMaximum(290);
                $namefile = time();
                $newurl = $imagen->guardar(IMAGES . SL . "catalogo" . SL . $nombre . 'categoria' . $namefile, 100, true);
                $imagen->guardar("../" . IMAGES . SL . "catalogo" . SL . $nombre . 'categoria' . $namefile, 100, true);
                $this->db->executeQue("update categorias set imgcategoria='$newurl' where idcategoria=$id");
                unlink($row['imgcategoria']);
                unlink($urlimage);
                return true;
            }
        } else {
            return false;
        }
    }

    public function finalizarnuevaImagen() {
        $nuevonombre = $_POST['categorianame'];
        $urlimage = $_POST['createpicture'];
        $x1 = $_POST['x1'];
        $y1 = $_POST['y1'];
        $heigth = $_POST['h'];
        $width = $_POST['w'];
        $imagen = new Imagen($urlimage);
        $imagen->redimencion($x1, $y1, $width, $heigth);
        $imagen->redimencionMaximum(290);
        $namefile = time();
        $newurl = $imagen->guardar(IMAGES . SL . "catalogo" . SL . 'categoria' . $namefile, 100, true);
        $imagen->guardar("../" . IMAGES . SL . "catalogo" . SL . 'categoria' . $namefile, 100, true);
        unlink($urlimage);
        $repuesta['urll'] = $newurl;
        $repuesta['nombre'] = $nuevonombre;
        $repuesta['repuesta'] = "si";
        echo json_encode($repuesta);
    }

    public function finisheditact() {
        $categoria = $_POST['catid'];
        $nombrecat = $_POST['name_category'];
        $descat = $_POST['descat'];
        if ($this->db->executeQue("update categorias set nombrecategoria='$nombrecat', descripcion ='$descat'  where idcategoria=$categoria")) {
            echo "<script>parent.message('Se ha actualizado la categoria', 'images/iconosalerta/ok.png');" .
            "parent.updatedata($categoria,'$nombrecat','$descat');parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo actualizar datos', 'images/iconosalerta/error.png');parent.$.fancybox.close();</script>";
        }
    }

    public function finishnewcat() {
        $imagen = $_POST['nuevaimagen'];
        $nombre = $_POST['name_category'];
        $idquery = "select nextval('categorias_idcategoria_seq'::regclass) from categorias limit 1";
        $consult = $this->db->executeQue($idquery);
        $idcat = 0;
        while ($row = $this->db->arrayResult($consult)) {
            $idcat = $row['nextval'];
        }
        if ($this->db->executeQue("insert into categorias values($idcat,'$nombre','$imagen')")) {
            echo "<script>parent.message('Se ha creado una nueva categoria', 'images/iconosalerta/ok.png');" .
            "parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo crear categoria', 'images/iconosalerta/error.png');parent.$.fancybox.close();</script>";
        }
    }

    /* Modelo
     * 
     * 
     * 
     * Metodos para la administracion de subcategorias
     */

    public function crearsubcategoria() {
        $categoria = $_POST['catid'];
        $nombresub = $_POST['name_subcategory'];
        $idquery = "select nextval('subcategorias_idsubcategoria_seq'::regclass) from subcategorias limit 1";
        $consult = $this->db->executeQue($idquery);
        $idsub = 0;
        while ($row = $this->db->arrayResult($consult)) {
            $idsub = $row['nextval'];
        }
        if ($this->db->executeQue("insert into subcategorias values($idsub,$categoria,'$nombresub')")) {
            echo "<script>parent.message('Se ha creado una nueva subcategoria', 'images/iconosalerta/ok.png');" .
            "parent.createdata('$nombresub',$idsub);parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo crear subcategoria', 'images/iconosalerta/error.png');parent.$.fancybox.close();</script>";
        }
    }

    public function getsubcategoria() {
        $idsubcategoria = $_GET['subcatid'];
        $idcategoria = $_GET['catid'];
        $consulta = $this->db->executeQue("select * from subcategorias where idsubcategoria=$idsubcategoria and idcategoria=$idcategoria");
        $total = $this->db->numRows($consulta);
        $subcategoroia = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $subcategoroia = array('id' => $row['idsubcategoria'],
                    'nombre' => $row['nombresubcategoria'],
                    'catid' => $row['idcategoria']);
            }
        }
        return $subcategoroia;
    }

    public function modifysubcategoria() {
        $categoria = $_POST['catid'];
        $subcategoria = $_POST['subcatid'];
        $nombresub = $_POST['name_subcategory'];
        if ($this->db->executeQue("update subcategorias set nombresubcategoria='$nombresub' where idsubcategoria=$subcategoria and idcategoria=$categoria")) {
            echo "<script>parent.message('Se ha actualizado la subcategoria', 'images/iconosalerta/ok.png');" .
            "parent.updatedata('$nombresub',$subcategoria);parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo actualizar datos', 'images/iconosalerta/error.png');parent.$.fancybox.close();</script>";
        }
    }

    /* Modelo
     * 
     * 
     * 
     * Metodos para la administracion de subcategorias
     */

    public function getMarcas() {
        $consulta = $this->db->executeQue('select * from marcas order by nombre asc');
        $total = $this->db->numRows($consulta);
        $marcas = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $idmarca = $row['idmarca'];
                $consulta2 = $this->db->executeQue("select * from productos where idmarca=$idmarca");
                $total2 = $this->db->numRows($consulta2);
                $marcas[] = array('id' => $row['idmarca'],
                    'nombre' => $row['nombre'],
                    'logo' => $row['logo'],
                    'productos' => $total2);
            }
        }
        return $marcas;
    }

    public function getMarca() {
        $idmarca = $_GET['marcaid'];
        $consulta = $this->db->executeQue('select * from marcas where idmarca=' . $idmarca);
        $total = $this->db->numRows($consulta);
        $marca = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $marca = array('id' => $row['idmarca'],
                    'nombre' => $row['nombre'],
                    'logo' => $row['logo']);
            }
        }
        return $marca;
    }

    public function subirImagenMarca() {

        if ($_FILES["image"]["size"] != 0) {
            $destino = $_FILES["image"]["name"];
            copy($_FILES["image"]["tmp_name"], $destino);
            $imagen = new Imagen($destino);
            if (!$imagen->validarMinimos(70, 70)) {
                unlink($destino);
                $respuesta['repuesta'] = "no";
                echo json_encode($respuesta);
            } else {
                $imagen->redimencionMaximum(500, 500);
                $namefile = time();
                $respuesta['repuesta'] = "si";
                $respuesta['url'] = $imagen->guardar(IMAGES . SL . "tmp" . SL . 'marca' . time(), 100, true);
                $respuesta['alto'] = $imagen->getAlto();
                $respuesta['ancho'] = $imagen->getAncho();
                unlink($destino);
                echo json_encode($respuesta);
            }
        }
    }

    public function finalizarImagenMarca() {
        $idmarca = $_POST['marcaid'];
        $urlimage = $_POST['editpicture'];
        $x1 = $_POST['x1'];
        $y1 = $_POST['y1'];
        $heigth = $_POST['h'];
        $width = $_POST['w'];
        $consulta = $this->db->executeQue('select * from marcas where idmarca=' . $idmarca);
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $id = $row['idmarca'];
                $nombre = $row['nombre'];
                $imagen = new Imagen($urlimage);
                $imagen->redimencion($x1, $y1, $width, $heigth);
                $imagen->redimencionMaximum(70, 70);
                $namefile = time();
                $newurl = $imagen->guardar(IMAGES . SL . "catalogo" . SL . $nombre . 'marca' . $namefile, 100, true);
                $imagen->guardar("../" . IMAGES . SL . "catalogo" . SL . $nombre . 'marca' . $namefile, 100, true);
                $this->db->executeQue("update marcas set logo='$newurl' where idmarca=$id");
                unlink($row['logo']);
                unlink($urlimage);
                return true;
            }
        } else {
            return false;
        }
    }

    public function finisheditMarca() {
        $marca = $_POST['marcaid'];
        $nombremarca = $_POST['name_marca'];
        if ($this->db->executeQue("update marcas set nombre='$nombremarca' where idmarca=$marca")) {
            echo "<script>parent.message('Se ha actualizado la marca', 'images/iconosalerta/ok.png');" .
            "parent.updatedata('$nombremarca',$marca);parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo actualizar datos', 'images/iconosalerta/error.png');parent.$.fancybox.close();</script>";
        }
    }

    public function finalizarnuevaImagenMarca() {
        $nuevonombre = $_POST['marcaname'];
        $urlimage = $_POST['createpicture'];
        $x1 = $_POST['x1'];
        $y1 = $_POST['y1'];
        $heigth = $_POST['h'];
        $width = $_POST['w'];
        $imagen = new Imagen($urlimage);
        $imagen->redimencion($x1, $y1, $width, $heigth);
        $imagen->redimencionMaximum(70, 70);
        $namefile = time();
        $newurl = $imagen->guardar(IMAGES . SL . "catalogo" . SL . 'marca' . $namefile, 100, true);
        $imagen->guardar("../" . IMAGES . SL . "catalogo" . SL . 'marca' . $namefile, 100, true);
        unlink($urlimage);
        $repuesta['urll'] = $newurl;
        $repuesta['nombre'] = $nuevonombre;
        $repuesta['repuesta'] = "si";
        echo json_encode($repuesta);
    }

    public function finishnewMarca() {
        $imagen = $_POST['nuevaimagen'];
        $nombre = $_POST['name_marca'];
        $idquery = "select nextval('marcas_idmarca_seq'::regclass) from marcas limit 1";
        $consult = $this->db->executeQue($idquery);
        $idmarca = 0;
        while ($row = $this->db->arrayResult($consult)) {
            $idmarca = $row['nextval'];
        }
        if ($this->db->executeQue("insert into marcas values($idmarca,'$nombre','$imagen')")) {
            echo "<script>parent.message('Se ha creado una nueva marca', 'images/iconosalerta/ok.png');" .
            "parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo crear marca', 'images/iconosalerta/error.png');parent.$.fancybox.close();</script>";
        }
    }

    /* Modelo
     * 
     * 
     * 
     * Metodos para la administracion de productos
     */

    public function getProductos($idsub=0) {

        $consulta = $this->db->executeQue('select * from productos where idcategoria=' . $idsub . ' order by nombreproducto asc');
        $total = $this->db->numRows($consulta);
        $productos = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
               $productos[] = array('id' => $row['idproducto'],
                    'nombre' => $row['nombreproducto']);
            }
        }
        return $productos;
    }

    public function getProducto() {
        $idproducto = $_GET['proid'];
        $consulta = $this->db->executeQue('select * from productos where idproducto=' . $idproducto);
        $total = $this->db->numRows($consulta);
        $producto = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $producto = array('id' => $row['idproducto'],
                    'nombre' => $row['nombreproducto'],
                    'imagen' => $row['imgminiperfil'],
                    'categoria' => $row['idcategoria']);              
            }
        }

        return $producto;
    }

    private function getsubcategoriabyid($idsubcategoria) {
        $consulta = $this->db->executeQue("select * from subcategorias where idsubcategoria=$idsubcategoria");
        $total = $this->db->numRows($consulta);
        $subcategoria = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $subcategoroia = array('id' => $row['idsubcategoria'],
                    'nombre' => $row['nombresubcategoria'],
                    'catid' => $row['idcategoria']);
            }
        }
        return $subcategoroia;
    }

    public function subirImagenProducto() {

        if ($_FILES["image"]["size"] != 0) {
            $destino = $_FILES["image"]["name"];
            copy($_FILES["image"]["tmp_name"], $destino);
            $imagen = new Imagen($destino);
            if (!$imagen->validarMinimos(180, 180)) {
                unlink($destino);
                $respuesta['repuesta'] = "no";
                echo json_encode($respuesta);
            } else {
                $imagen->redimencionMaximum(500, 500);
                $namefile = time();
                $respuesta['repuesta'] = "si";
                $respuesta['url'] = $imagen->guardar(IMAGES . SL . "tmp" . SL . 'producto' . time(), 100, true);
                $respuesta['alto'] = $imagen->getAlto();
                $respuesta['ancho'] = $imagen->getAncho();
                unlink($destino);
                echo json_encode($respuesta);
            }
        }
    }

    public function finalizarImagenProducto() {
        $idproducto = $_POST['proid'];
        $urlimage = $_POST['editpicture'];
        $x1 = $_POST['x1'];
        $y1 = $_POST['y1'];
        $heigth = $_POST['h'];
        $width = $_POST['w'];
        $consulta = $this->db->executeQue('select * from productos where idproducto=' . $idproducto);
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $id = $row['idproducto'];
                $nombre = $row['nombreproducto'];
                $imagen = new Imagen($urlimage);
                $imagen->redimencion($x1, $y1, $width, $heigth);
                $imagen->redimencionMaximum(180, 180);
                $namefile = time();
                $newurl = $imagen->guardar(IMAGES . SL . "catalogo" . SL . $nombre . 'producto' . $namefile, 100, true);
                $imagen->guardar("../" . IMAGES . SL . "catalogo" . SL . $nombre . 'producto' . $namefile, 100, true);
                $this->db->executeQue("update productos set imgminiperfil='$newurl' where idproducto=$id");
                unlink($row['imgminiperfil']);
                unlink($urlimage);
                return true;
            }
        } else {
            return false;
        }
    }

    public function finisheditProducto() {
        $producto = $_POST['productoid'];
        $nombre = $_POST['name_producto'];
        $categoria = $_POST['categorias'];
        if ($this->db->executeQue("update productos set nombreproducto='$nombre' where idproducto=$producto")) {
            echo "<script>parent.message('Se ha actualizado el producto', 'images/iconosalerta/ok.png');" .
            "parent.updatedata('$nombre',$producto);parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo actualizar datos', 'images/iconosalerta/error.png');parent.$.fancybox.close();</script>";
        }
    }

    public function finalizarnuevaImagenProducto() {
        $nuevonombre = $_POST['productoname'];
        $urlimage = $_POST['createpicture'];
        $x1 = $_POST['x1'];
        $y1 = $_POST['y1'];
        $heigth = $_POST['h'];
        $width = $_POST['w'];
        $imagen = new Imagen($urlimage);
        $imagen->redimencion($x1, $y1, $width, $heigth);
        $imagen->redimencionMaximum(180, 180);
        $namefile = time();
        $newurl = $imagen->guardar(IMAGES . SL . "catalogo" . SL . 'producto' . $namefile, 100, true);
        $imagen->guardar("../" . IMAGES . SL . "catalogo" . SL . 'producto' . $namefile, 100, true);
        unlink($urlimage);
        $repuesta['urll'] = $newurl;
        $repuesta['nombre'] = $nuevonombre;
        $repuesta['repuesta'] = "si";
        echo json_encode($repuesta);
    }

    public function finishnewProducto() {
        $nombre = $_POST['name_producto'];
        $categorias = $_POST['categorias'];
        $idquery = "select nextval('productos_idproducto_seq'::regclass) from productos limit 1";
        $consult = $this->db->executeQue($idquery);
        $idproducto = 0;
        while ($row = $this->db->arrayResult($consult)) {
            $idproducto = $row['nextval'];
        }
        if ($this->db->executeQue("insert into productos values($idproducto,'$nombre',$categorias)")) {
            echo "<script>parent.message('Se ha creado un nuevo producto', 'images/iconosalerta/ok.png');" .
            "parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo crear Producto', 'images/iconosalerta/error.png');parent.$.fancybox.close();</script>";
        }
    }

    public function fichatecnicaProducto() {
        $idproducto = $_GET['proid'];
        $consulta = $this->db->executeQue("select * from atributos_producto where idproducto=$idproducto");
        $total = $this->db->numRows($consulta);
        $atributos = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $atributos[] = array('id' => $row['idatributoproducto'],
                    'descripcion' => $row['descripcion'],
                    'producto' => $row['idproducto']);
            }
        }
        return $atributos;
    }

    public function crearAtributoProducto() {
        $producto = $_POST['proid'];
        $descripcion = $_POST['descripcion'];
        $idquery = "select nextval('atributos_producto_idatributoproducto_seq'::regclass) from atributos_producto limit 1";
        $consult = $this->db->executeQue($idquery);
        $idattr = 0;
        while ($row = $this->db->arrayResult($consult)) {
            $idattr = $row['nextval'];
        }
        if ($this->db->executeQue("insert into atributos_producto values($idattr,$producto,'$descripcion')")) {
            echo "<script>parent.message('Se ha creado una nueva Caracteristica', 'images/iconosalerta/ok.png');" .
            "parent.createdata('$descripcion',$idattr);parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo crear subcategoria', 'images/iconosalerta/error.png');parent.$.fancybox.close();</script>";
        }
    }

    public function getAtributoPro() {
        $attrid = $_GET['attrid'];
        $producto = $_GET['proid'];
        $consulta = $this->db->executeQue("select * from atributos_producto where idatributoproducto=$attrid and idproducto=$producto");
        $total = $this->db->numRows($consulta);
        $atributo = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $atributo = array('id' => $row['idatributoproducto'],
                    'descripcion' => $row['descripcion'],
                    'producto' => $row['idproducto']);
            }
        }
        return $atributo;
    }

    public function modifyAtributoProducto() {
        $attrid = $_POST['attrid'];
        $producto = $_POST['proid'];
        $descripcion = $_POST['descripcion'];
        if ($this->db->executeQue("update atributos_producto set descripcion='$descripcion' where idatributoproducto=$attrid and idproducto=$producto")) {
            echo "<script>parent.message('Se ha actualizado la Caracteristica', 'images/iconosalerta/ok.png');" .
            "parent.updatedata('$descripcion',$attrid);parent.$.fancybox.close();</script>";
        } else {
            echo "<script>parent.message('No se pudo actualizar datos', 'images/iconosalerta/error.png');parent.$.fancybox.close();</script>";
        }
    }

    /*
     * 
     * 
     */
 
    public function getSelectConsultorios($tagname='consultorios') {
        $consulta = $this->db->executeQue('select * from consultorios order by nombreconsultorio');
        $total = $this->db->numRows($consulta);
        $tagselect = "<select name='$tagname' id='$tagname'>";
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $nombre_consultorio = $row['nombreconsultorio'];
                $id_consultorio = $row['idconsultorio'];
                $tagselect.="<option value='" . $id_consultorio . "'>" . $nombre_consultorio . "</option>";
            }
        } else { 
            $tagselect = 'No se encontraron Consultorio.';
        }
        $tagselect.="</select>";
        return $tagselect;
    }

    public function getFirstConsultorioId() {
        $consulta = $this->db->executeQue('select * from consultorios order by nombreconsultorio limit 1');
        $total = $this->db->numRows($consulta);
        if ($total > 0) { 
            while ($row = $this->db->arrayResult($consulta)) {
                $id_consultorio = $row['idconsultorio'];
                return $id_consultorio;
            }
        }
    }

    public function getFirstSubCategoriaId($idcategoria) {
        $consulta = $this->db->executeQue('select * from subcategorias where idcategoria=' . $idcategoria . ' order by nombresubcategoria limit 1');
        $total = $this->db->numRows($consulta);
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $id_subcategoria = $row['idsubcategoria'];
                return $id_subcategoria;
            }
        } else {
            return 0;
        }
    }

    public function getSelectSubcategorias($idcategoria = 0, $tagname='subcategorias') {
        if ($idcategoria == 0) {
            $idcategoria = $this->getFirstCategoriaId();
        }
        $consulta = $this->db->executeQue('select * from subcategorias where idcategoria=' . $idcategoria . ' order by nombresubcategoria');
        $total = $this->db->numRows($consulta);
        $tagselect = "<select name='$tagname' id='$tagname'>";
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $nombre_subcat = $row['nombresubcategoria'];
                $id_subcat = $row['idsubcategoria'];
                $tagselect.="<option value='" . $id_subcat . "'>" . $nombre_subcat . "</option>";
            }
            $tagselect.="</select>";
        } else {
            $tagselect = 'No se encontraron subcategorias.';
        }
        return $tagselect;
    }

    public function getChangeCategoria() {
        $idcat = $_GET['catid'];
        $subcategorias = $this->getSelectSubcategorias($idcat);
        return $subcategorias;
    }

    public function getimagenesProducto() {
        $idproducto = $_GET['proid'];
        $consulta = $this->db->executeQue("select * from imagenes_producto where idproducto=$idproducto");
        $total = $this->db->numRows($consulta);
        $atributos = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $atributos[] = array('id' => $row['idimagen'],
                    'url' => $row['urlimagen'],
                    'idproducto' => $row['producto'],
                    'nombre' => $row['nombreimagen']);

                //$imgmostrar->mostrar();
                //$atributos['imagen'] = serialize($imgmostrar);
            }
        }
        return $atributos;
    }

    public function addImageProduct() {
        if ($_FILES["image"]["size"] != 0) {
            $producto = $_GET['proid'];
            $destino = $_FILES["image"]["name"];
            copy($_FILES["image"]["tmp_name"], $destino);
            $imagen = new Imagen($destino, 'default');
            $imagen->redimencionMaximum(600, 500);
            $namefile = time();
            $respuesta['url'] = $imagen->guardar(IMAGES . SL . "catalogo" . SL . 'producto' . $namefile, 100, true);
            $imagen->guardar("../" . IMAGES . SL . "catalogo" . SL . 'producto' . $namefile, 100, true);
            $idquery = "select nextval('imagenes_producto_idimagen_seq'::regclass) from imagenes_producto limit 1";
            $consult = $this->db->executeQue($idquery);
            $idimg = 0;
            while ($row = $this->db->arrayResult($consult)) {
                $idimg = $row['nextval'];
            }
            if ($this->db->executeQue("insert into imagenes_producto values($idimg,$producto,'" . $respuesta['url']
                            . "','default')")) {
                $respuesta['repuesta'] = "si";
                $respuesta['idpro'] = $producto;
                unlink($destino);
                echo json_encode($respuesta);
            }
        }
    }

    public function deleteattrProduct() {
        if (isset($_POST['verify'])) {
            $idatributopro = base64_decode(urldecode(strrev($_POST['verify'])));
            $idquery = "delete from atributos_producto where idatributoproducto=$idatributopro";
            if ($this->db->executeQue($idquery)) {
                echo json_encode(array('res' => 'si', 'idrow' => $idatributopro));
            } else {
                echo json_encode(array('res' => 'no'));
            }
        } else {
            echo json_encode(array('res' => 'no'));
        }
    }

    public function deleteimgProduct() {
        if (isset($_POST['verify'])) {
            $idimagenpro = base64_decode(urldecode(strrev($_POST['verify'])));
            $consulta = $this->db->executeQue("select * from imagenes_producto where idimagen=$idimagenpro");
            $total = $this->db->numRows($consulta);
            $imagen = null;
            if ($total > 0) {
                while ($row = $this->db->arrayResult($consulta)) {
                    $imagen = $row['urlimagen'];
                }
                $idquery = "delete from imagenes_producto where idimagen=$idimagenpro";
                if ($this->db->executeQue($idquery)) {
                    unlink($imagen);
                    unlink('../' . $imagen);
                    echo json_encode(array('res' => 'si', 'idrow' => $idimagenpro));
                } else {
                    echo json_encode(array('res' => 'no'));
                }
            } else {
                echo json_encode(array('res' => 'no'));
            }
        } else {
            echo json_encode(array('res' => 'no'));
        }
    }

    public function deleteProduct() {
        if (isset($_POST['verify'])) {
            $idproducto = base64_decode(urldecode(strrev($_POST['verify'])));
            $consulta = $this->db->executeQue("select * from imagenes_producto where idproducto=$idproducto");
            $total = $this->db->numRows($consulta);
            $imagen = null;
            $valcont = true;
            if ($total > 0) {
                while ($row = $this->db->arrayResult($consulta)) {
                    if ($valcont) {
                        $imagen = $row['urlimagen'];
                        $idquery = "delete from imagenes_producto where idproducto=$idproducto";
                        if ($this->db->executeQue($idquery)) {
                            unlink($imagen);
                            unlink('../' . $imagen);
                        } else {
                            echo json_encode(array('res' => 'no'));
                            $valcont = false;
                        }
                    }
                }
            }
            if ($valcont) {
               
                    if ($this->db->executeQue("delete from productos where idproducto=$idproducto")) {
                        echo json_encode(array('res' => 'si', 'idrow' => $idproducto));
                    } else {
                        echo json_encode(array('res' => 'no'));
                    }
                
            } else {
                echo json_encode(array('res' => 'no'));
            }
        } else {
            echo json_encode(array('res' => 'no'));
        }
    }

    public function deleteMarca() {
        if (isset($_POST['verify'])) {
            $idmarca = base64_decode(urldecode(strrev($_POST['verify'])));
            $consulta = $this->db->executeQue("select * from productos where idmarca=$idmarca");
            $total = $this->db->numRows($consulta);
            $imagen = null;
            if ($total == 0) {
                $consulta2 = $this->db->executeQue("select * from marcas where idmarca=$idmarca");
                while ($row2 = $this->db->arrayResult($consulta2)) {
                    $imagen = $row2['logo'];
                }
                $idquery = "delete from marcas where idmarca=$idmarca";
                if ($this->db->executeQue($idquery)) {
                    unlink($imagen);
                    unlink('../' . $imagen);
                    echo json_encode(array('res' => 'si', 'idrow' => $idmarca));
                } else {
                    echo json_encode(array('res' => 'no'));
                }
            } else {
                echo json_encode(array('res' => 'no'));
            }
        } else {
            echo json_encode(array('res' => 'no'));
        }
    }

    public function deleteCategoria() {
        if (isset($_POST['verify'])) {
            $idcategoria = base64_decode(urldecode(strrev($_POST['verify'])));
            $consulta = $this->db->executeQue("select * from subcategorias where idcategoria=$idcategoria");
            $total = $this->db->numRows($consulta);
            $imagen = null;
            if ($total == 0) {
                $consulta2 = $this->db->executeQue("select * from categorias where idcategoria=$idcategoria");
                while ($row2 = $this->db->arrayResult($consulta2)) {
                    $imagen = $row2['imgcategoria'];
                }
                $idquery = "delete from categorias where idcategoria=$idcategoria";
                if ($this->db->executeQue($idquery)) {
                    unlink($imagen);
                    unlink('../' . $imagen);
                    echo json_encode(array('res' => 'si', 'idrow' => $idcategoria));
                } else {
                    echo json_encode(array('res' => 'no'));
                }
            } else {
                echo json_encode(array('res' => 'no'));
            }
        } else {
            echo json_encode(array('res' => 'no'));
        }
    }

    public function deletesubCategoria() {
        if (isset($_POST['verify'])) {
            $idsubcat = base64_decode(urldecode(strrev($_POST['verify'])));
            $consulta2 = $this->db->executeQue("select * from productos where idsubcategoria=$idsubcat");
            $total2 = $this->db->numRows($consulta);
            if ($total2 == 0) {
                $idquery = "delete from subcategorias where idsubcategoria=$idsubcat";
                if ($this->db->executeQue($idquery)) {
                    echo json_encode(array('res' => 'si', 'idrow' => $idsubcat));
                } else {
                    echo json_encode(array('res' => 'no'));
                }
            } else {
                echo json_encode(array('res' => 'no'));
            }
        } else {
            echo json_encode(array('res' => 'no'));
        }
    }

}

?>
