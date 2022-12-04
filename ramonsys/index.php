<?php 
require_once("include/initialize.php");
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(WEB_ROOT."login.php");
     } 
 $title="Admin Panel"; 
$content='home.php';
$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
switch ($view) {
	case '1' :
        // $title="Home";	
		// $content='home.php';	
		
		if ($_SESSION['ACCOUNT_TYPE']=='Administrator') {
				# code... 

			$content='home.php';
		}	
		break;	
	default :
		if ($_SESSION['ACCOUNT_TYPE']=='Cashier') {
				# code...
			$content='home.php';

		}	
		if ($_SESSION['ACCOUNT_TYPE']=='Administrator') {
				# code... 

			$content='home.php';

		}
	    // $title="Home";	
		// $content ='home.php';		
}
require_once("theme/templates.php");
?>