<?php
$config = Config::singleton();
/* set connection mysql
  $config->set('dbtype', 'mysql');
  $config->set('dbport', '3306');
  $config->set('dbhost', 'localhost');
  $config->set('dbname', 'glugg_framework');
  $config->set('dbuser', 'root');
  $config->set('dbpass', 'admin');
  / */

$config->set('dbtype', 'postgres');
$config->set('dbport', '5432');
$config->set('dbhost', 'localhost');
$config->set('dbname', 'abc');
$config->set('dbuser', 'postgres');
$config->set('dbpass', 'admin');    
 
$config->set('lang', 'es'); 
$config->set('mail', 'danny0204@gmail.com');
$config->set('company', 'CONSULTORIOS ABC'); 
date_default_timezone_set('America/Panama');
?>