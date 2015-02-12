<?php

defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');

class Document {

    private $styles;
    private $stylesindex;
    private $scripts;
    private $scriptsindex;
    private $end;
    private $document;
    private $title;
    private static $instance;

    function __construct() {         
        $this->document = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n";
        $this->document .='<html>' . "\n";
        $this->scriptsindex = 0;
        $this->stylesindex = 0;
        $this->addCss("barraf");
    }

    function setHeader() {
        session_start();
        $this->document .='<head>' . "\n";
        $this->document .='<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' . "\n";
        $this->document .= '<title>' . $this->title . '</title>' . "\n";
        if ($this->stylesindex != 0) {
            foreach ($this->styles as $value) {
                $this->document .=$value;
            }
        }
        if ($this->scriptsindex != 0) {
            foreach ($this->scripts as $value) {
                $this->document .=$value;
            }
        }
        $this->document .='</head>' . "\n";        
        $this->document .='<body>' . "\n";
        $this->document .='<div class="barraf" id="barraf">' . "\n";
        $this->document .=' <table border="0">' . "\n";
        $this->document .='<tr>' . "\n";
        $this->document .='<td rowspan="3" align="center" width="60px"><div id="iconmesagge" style="padding-left:10px"></div></td>' . "\n";
        $this->document .='</tr>' . "\n";
        $this->document .='<tr>' . "\n";
        $this->document .='<td ><div id="titlemesagge" style="padding-left:5px;color:#030"></div></td>' . "\n";
        $this->document .='</tr>' . "\n";
        $this->document .='<tr>' . "\n";
        $this->document .='</tr></table></div>' . "\n";
        echo $this->document;
    }

    function addCss($nameCss, $medio="screen") {
        $this->styles[$this->stylesindex] = '<link href="' . STYLES . SL . $nameCss . '.css" rel="stylesheet" type="text/css" media="'.$medio.'" />' . "\n";
        $this->stylesindex++;
    }

    function addScript($nameScript) {
        $this->scripts[$this->scriptsindex] = '<script src="' . JAVASCRIPTS . SL . $nameScript . '.js" type="text/javascript"></script>' . "\n";

        $this->scriptsindex++;
    }

    function setFinish() {

        $this->end .="\n" . '</body>' . "\n";
        $this->end .='</html>' . "\n";
        echo $this->end;
    }

    function settitle($tttle = "Sin titulo") {
        $this->title = $tttle;
    }

    private function appLang() {             
        $config = Config::singleton();
        $language = $config->get('lang');        
        $settings = parse_ini_file(MESSAGES . DS . $language . '_app.ini');        
        return $settings;
    }

    public function texto($variableini, $palabraclave= null) {      
        $settings = $this->appLang();
        if (is_null($palabraclave)) {           
            $mitexto = $settings[$variableini];
        } else {
            
            $mitexto = str_replace('%s', $palabraclave, $settings[$variableini]);
        }

        echo $mitexto;
    }
    
     public function t($variableini, $palabraclave= null) {      
        $settings = $this->appLang();
        if (is_null($palabraclave)) {           
            $mitexto = $settings[$variableini];
        } else {
            
            $mitexto = str_replace('%s', $palabraclave, $settings[$variableini]);
        }

        return $mitexto;
    }
    
    public static function urlRequest($url){
        ob_end_clean();
        header("Location: ".$url);
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
