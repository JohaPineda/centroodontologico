<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class Imagen {

    private $alto;
    private $alternativo;
    private $ancho;
    private $tipo;
    private $imagen;
    private $image_creators = array(
        1 => "imagecreatefromgif",
        2 => "imagecreatefromjpeg",
        3 => "imagecreatefrompng"
    );
    private $image_saves = array(
        1 => "imagegif",
        2 => "imagejpeg",
        3 => "imagepng"
    );
    private $props;

    function __construct($file, $alt=null) {

        $this->alternativo = $alt;
        $this->props = getimagesize($file);
        $this->tipo = $this->props['mime'];

        if ($this->tipo != 'image/jpeg' && $this->tipo != 'image/png' && $this->tipo != 'image/gif') {
            die("*** ERROR: '$file' no es un tipo de imagen valida");
        } else {
            $file_type = $this->props[2];
            $creador = $this->image_creators[$file_type];
            $this->alto = $this->props[1];
            $this->ancho = $this->props[0];
            $this->imagen = $creador($file);
        }
    }

    function redimencionScala($percent) {
        $file_type = $this->props[2];
        $new_width = $this->ancho * ($percent / 100);
        $new_height = $this->alto * ($percent / 100);
        if ($file_type != 3) {
            $image_p = imagecreatetruecolor($new_width, $new_height);
        } else {
            $image_p = imagecreate($new_width, $new_height);
        }
        imagecopyresampled($image_p, $this->imagen, 0, 0, 0, 0, $new_width, $new_height, $this->ancho, $this->alto);
        $this->imagen = $image_p;
        $this->alto = $new_height;
        $this->ancho = $new_width;
    }

    function redimencion($x, $y, $width, $heigth) {
        $file_type = $this->props[2];
        $new_width = $width;
        $new_height = $heigth;
        if ($file_type != 3) {
            $image_p = imagecreatetruecolor($new_width, $new_height);
        } else {
            $image_p = imagecreate($new_width, $new_height);
        }
        imagecopyresampled($image_p, $this->imagen, 0, 0, $x, $y, $new_width, $new_height, $new_width, $new_height);
        $this->imagen = $image_p;
        $this->alto = $new_height;
        $this->ancho = $new_width;
    }

    function redimencionMaximum($both, $heigth=0) {
        $file_type = $this->props[2];
        if ($heigth == 0) {
            if ($this->alto > $both || $this->ancho > $both) {
                if ($this->alto > $this->ancho) {
                    $proporcion = $both / $this->alto;
                    $new_width = $this->ancho * $proporcion;
                    $new_height = $this->alto * $proporcion;
                } else if ($this->alto < $this->ancho) {
                    $proporcion = $both / $this->ancho;
                    $new_width = $this->ancho * $proporcion;
                    $new_height = $this->alto * $proporcion;
                } else {
                    $new_width = $both;
                    $new_height = $both;
                }
            } else {
                $new_width = $this->ancho;
                $new_height = $this->alto;
            }
        } else {
            $new_width = $this->ancho;
            $new_height = $this->alto;
            if ($new_height > $heigth) {
                $proporcion = $heigth / $new_height;
                $new_width = $new_width * $proporcion;
                $new_height = $new_height * $proporcion;
            }
            if ($new_width > $both) {
                $proporcion = $both / $new_width;
               $new_width = $new_width * $proporcion;
                $new_height = $new_height * $proporcion;
            }
            if ($new_height > $heigth) {
                 $proporcion = $heigth / $new_height;
                $new_width = $new_width * $proporcion;
                $new_height = $new_height * $proporcion;
            }
            if ($new_width > $both) {
                $proporcion = $both / $new_width;
               $new_width = $new_width * $proporcion;
                $new_height = $new_height * $proporcion;
            }
        }
        if ($file_type != 3) {
            $image_p = imagecreatetruecolor($new_width, $new_height);
        } else {
            $image_p = imagecreate($new_width, $new_height);
        }
        imagecopyresampled($image_p, $this->imagen, 0, 0, 0, 0, $new_width, $new_height, $this->ancho, $this->alto);
        $this->imagen = $image_p;
        $this->alto = $new_height;
        $this->ancho = $new_width;
    }

    function guardar($ruta, $quality = 80, $return=false) {

        $file_type = $this->props[2];
        $save = $this->image_saves[$file_type];
        if ($file_type != 3) {
            if ($this->tipo == 'image/jpeg') {
                $save($this->imagen, $ruta . '.jpg', $quality);
                if ($return) {
                    return $ruta . '.jpg';
                }
            } else if ($this->tipo == 'image/gif') {
                $save($this->imagen, $ruta . '.gif', $quality);
                if ($return) {
                    return $ruta . '.gif';
                }
            }
        } else {
            $save($this->imagen, $ruta . '.png', ($quality - 10) / 10);
            if ($return) {
                return $ruta . '.png';
            }
        }
    }

    function mostrar() {
        header("Content-Type: " . $this->props['mime'] . "");
        $file_type = $this->props[2];
        $save = $this->image_saves[$file_type];
        $save($this->imagen);
    }

    function validarMinimos($min_width, $min_height) {
        if ($this->alto < $min_height || $this->ancho < $min_width) {
            return false;
        } else {
            return true;
        }
    }

    function getAlto() {
        return $this->alto;
    }

    function getAncho() {
        return $this->ancho;
    }

}

?>