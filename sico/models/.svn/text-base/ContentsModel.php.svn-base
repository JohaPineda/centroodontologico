<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class ContentsModel extends ModelBase {

    public function getContent() {
        $consulta = $this->db->executeQue('select * from contenidos where idposicion=1');
        $total = $this->db->numRows($consulta);
        $contenido = null;
        if ($total > 0) {
            while ($row = $this->db->arrayResult($consulta)) {
                $contenido = array('id' => $row['idcontenido'],
                    'titulo' => $row['titulo'],
                    'contenido' => $row['contenido'],
                    'anchomax' => $row['anchomax']);
            }
        }
        return $contenido;
    }
    
    public function UpdateContent(){
        if (isset($_POST["verifyid"]) && isset($_POST['formcorrect']) && $_POST['formcorrect'] == sha1(976780267)) {
            $contentid = base64_decode(urldecode(strrev($_POST["verifyid"])));            
            $contenido= $_POST["elm1"];
            if ($this->db->executeQue("update contenidos set contenido='$contenido'" .
                            " where idcontenido=$contentid")) {

                header('Location: index.php?controlador=Content&accion=adminNosotros');
            } else {
                header('Location: index.php?controlador=Content&accion=adminNosotros');
            }
        }
    }

    public function getUserId() {
        $usuario = unserialize($_SESSION['user']);
        return $usuario->getIdUser();
    }

}

?>