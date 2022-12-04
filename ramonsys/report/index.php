<?php
require_once("../include/initialize.php");
 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."/index.php");
     }
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$title ='Report';
switch ($view) {
	case 'list' :

		$content    = 'list.php';		
		break;
	 case 'print' :
	 	$content    = 'printsales.php';		
	 	break;	
			
	default :
		$content    = 'list.php';		
}
require_once ("../theme/templates.php");
?>
  

  
