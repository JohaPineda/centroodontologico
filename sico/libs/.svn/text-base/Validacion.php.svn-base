<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class Validacion {

    private static $instance;
    protected $db;
    private $config;

    private function __construct() {

        $this->db = DataBase::singleton();
        $this->config = Config::singleton();
    }

    public function isLogged() {
        session_start();
        if (isset($_SESSION['user']) && isset($_SESSION['autentificado'])
                && isset($_SESSION['certifed']) && isset($_SESSION['lastactivity']) && isset($_SESSION['init'])) {
            $usuario = unserialize($_SESSION['user']);
            if ($_SESSION['autentificado'] == "si" && $_SESSION['certifed'] == str_repeat(strrev(sha1($usuario->getIpUser()
                                            . "@pPliccati0N" . $usuario->getIdUser() . $_SESSION['init'])), 6)) {
                $query2 = "select * from sesiones where nombre='" . $_SESSION['certifed'] . "'";
                $rs = $this->db->executeQue($query2);
                $active = 0;
                $lastacty = 0;
                while ($row2 = $this->db->arrayResult($rs)) {
                    $active = $row2['activo'];                                       
                    $lastacty = $row2['lastactivity'];
                }
                if ((time() - $_SESSION['lastactivity'] > 900) || (time() - $lastacty > 900) || $active == 0) {
                    $query = "update sesiones set activo=0, updatedat='" . date("Y-m-d H:i:s") . "', lastactivity=0 where nombre='" . $_SESSION['certifed'] . "'";
                    $this->db->executeQue($query);
                    unset($_SESSION['autentificado']);
                    unset($_SESSION['user']);
                    unset($_SESSION['certifed']);
                    unset($_SESSION['lastactivity']);
                    unset($_SESSION['init']);
                    ob_end_clean();
                    session_destroy();
                    session_cache_expire(0);
                    header('location: index.php?controlador=User&accion=Login');
                } else {
                    $_SESSION['lastactivity'] = time();
                    $query = "update sesiones set updatedat='" . date("Y-m-d H:i:s") . "', lastactivity=" . $_SESSION['lastactivity'] . " where nombre='" . $_SESSION['certifed'] . "'";
                    $this->db->executeQue($query);
                    return true;
                }
            } else {
                unset($_SESSION['autentificado']);
                unset($_SESSION['user']);
                unset($_SESSION['certifed']);
                unset($_SESSION['lastactivity']);
                unset($_SESSION['init']);
                ob_end_clean();
                session_destroy();
                session_cache_expire(0);
                header('location: index.php?controlador=User&accion=Login');
            }
        } else {
            unset($_SESSION['autentificado']);
            unset($_SESSION['user']);
            unset($_SESSION['certifed']);
            unset($_SESSION['lastactivity']);
            unset($_SESSION['init']);
            ob_end_clean();
            session_destroy();
            session_cache_expire(0);
            header('location: index.php?controlador=User&accion=Login');
        }
    }

    public function Login($alias, $pass, $validid=false) {
        $query = null;
        if ($validid) {
            $consult = "SELECT * FROM usuarios WHERE idusuario=%s and idestado=2";
            if ($this->config->get('dbtype') == "postgres") {
                $query = str_replace('%s', (int) pg_escape_string($alias), $consult);
            } elseif ($this->config->get('dbtype') == "mysql") {
                $query = sprintf($consult, (int) mysql_real_escape_string($alias));
            }
        } else {
            $consult = "SELECT * FROM usuarios WHERE alias='%s' and estado='activo'";
            if ($this->config->get('dbtype') == "postgres") {
                $query = str_replace('%s', pg_escape_string($alias), $consult);
            } elseif ($this->config->get('dbtype') == "mysql") {
                $query = sprintf($consult, mysql_real_escape_string($alias));
            }
        }

        $consulta = $this->db->executeQue($query);

        if ($this->db->numRows($consulta) == 0) {
            session_cache_expire(0);
            session_start();
            $autentificado = "no";
            session_register('autentificado');
            if (isset($_SESSION['autentificado'])) {
                unset($_SESSION['autentificado']);
            }
            if (isset($_SESSION['user'])) {
                unset($_SESSION['user']);
            }
            if (isset($_SESSION['certifed'])) {
                unset($_SESSION['certifed']);
            }
            if (isset($_SESSION['lastactivity'])) {
                unset($_SESSION['lastactivity']);
            }
            if (isset($_SESSION['init'])) {
                unset($_SESSION['init']);
            }
            session_destroy();
            return false;
        } else {

            $resultados = $this->db->arrayResult($consulta);
            while ($row = $resultados) {
                if (sha1($pass) == $row['password']) {
                    session_start();
                    if (isset($_SESSION['autentificado'])) {
                        unset($_SESSION['autentificado']);
                    }
                    if (isset($_SESSION['user'])) {
                        unset($_SESSION['user']);
                    }
                    if (isset($_SESSION['certifed'])) {
                        unset($_SESSION['certifed']);
                    }
                    if (isset($_SESSION['lastactivity'])) {
                        unset($_SESSION['lastactivity']);
                    }
                    if (isset($_SESSION['init'])) {
                        unset($_SESSION['init']);
                    }
                    $autentificado = "si";
                    $usuario = new GUser($row['idusuario'], $row['nombreusuario'], $row['email'], $row['idperfil'], $row['alias']);
                    error_log("\n\nInicio de nueva sesion por: \n", 3, LOGUSER);
                    error_log("\n" . "Id: " . $row['idusuario'] . " \n", 3, LOGUSER);
                    error_log("Nombre: " . $row['nombreusuario'] . " \n", 3, LOGUSER);
                    error_log("Email: " . $row['email'] . " \n", 3, LOGUSER);
                    error_log("Perfil: " . $row['perfil'] . " \n", 3, LOGUSER);
                    error_log("Alias: " . $row['alias'] . " \n", 3, LOGUSER);
                    error_log("Ip: " . $usuario->getIpUser() . " \n", 3, LOGUSER);                    
                    error_log("Fecha: " . date("Y-m-d H:i:s") . " \n", 3, LOGUSER);
                    $_SESSION['autentificado'] = $autentificado;
                    $_SESSION['user'] = serialize($usuario);
                    $_SESSION['lastactivity'] = time();
                    $_SESSION['init'] = time();
                    $cadenadeexp = str_repeat(strrev(sha1($usuario->getIpUser() . "@pPliccati0N" . $usuario->getIdUser()
                                            . $_SESSION['init'])), 6);
                    $_SESSION['certifed'] = $cadenadeexp;
                    $idquery = "select nextval('sesiones_idsesion_seq'::regclass) from sesiones limit 1";
                    $consult = $this->db->executeQue($idquery);
                    $idses = 0;
                    while ($row = $this->db->arrayResult($consult)) {
                        $idses = $row['nextval'];
                    }
                    $query = "insert into sesiones values ($idses," . $usuario->getIdUser() . ",'" . date("Y-m-d H:i:s") .
                            "','$cadenadeexp',1,'" . $usuario->getIpUser() . "','" .
                            date("Y-m-d H:i:s") . "', " . $_SESSION['lastactivity'] . ")";
                    $this->db->executeQue($query);
                    return true;
                } else {
                    session_cache_expire(0);
                    session_start();
                    $autentificado = "no";
                    session_register('autentificado');
                    unset($_SESSION['autentificado']);
                    unset($_SESSION['user']);
                    unset($_SESSION['certifed']);
                    unset($_SESSION['lastactivity']);
                    unset($_SESSION['init']);
                    session_destroy();
                    return false;
                }
            }
        }
    }

    function Logout() {
        session_start();
        $query = "update sesiones set activo=0, updatedat='" . date("Y-m-d H:i:s") . "', lastactivity=0 where nombre='" . $_SESSION['certifed'] . "'";
        $this->db->executeQue($query);
        unset($_SESSION['autentificado']);
        unset($_SESSION['user']);
        unset($_SESSION['certifed']);
        unset($_SESSION['lastactivity']);
        unset($_SESSION['init']);
        session_destroy();
        session_cache_expire(0);
        header('location: index.php?controlador=User&accion=Login');
    }

    public static function singleton() {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

}

?>
