<?php
require_once("../include/initialize.php");
 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."/index.php");
     }

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
 $title="Billing Module"; 
 $header=$view; 
switch ($view) {
	case 'list' :
		$content    = 'list.php';		
		break;

	case 'add' :
		$content    = 'add.php';		
		break;
	case 'asignsubj' :
		$content    = 'assignsubj.php';		
		break;
	case 'viewsubj' :
		$content    = 'viewsubj.php';		
		break;

	case 'print' :
		$content    = 'edit.php';		
		break;

	case 'printEntrance' :
		$content    = 'entranceprint.php';		
		break;    
	case 'view' :
		$content    = 'view.php';		
		break;
	case 'addEntrance' :
		$content 	= 'addEntrance.php';
		break;	

	default :
		$content    = 'list.php';		
}
require_once ("../theme/templates.php");
?>
  
