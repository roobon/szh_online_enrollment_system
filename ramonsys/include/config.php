<?php
defined('server') ? null : define("server", "localhost");
defined('user') ? null : define ("user", "root") ;
defined('pass') ? null : define("pass","");
defined('database_name') ? null : define("database_name", "ramondb") ;

$this_file = str_replace('\\', '/', __File__) ;
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$webRoot =  str_replace (array($doc_root, "include/config.php") , '' , $this_file);
$srvRoot = str_replace ('config/config.php' ,'', $this_file);


define('WEB_ROOT', $webRoot);
define('SRV_ROOT', $srvRoot);
?>