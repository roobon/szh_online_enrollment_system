<?php
require_once ("../include/initialize.php");
	  if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'cashier' :
	doInsert();
	break;

	case 'EntranceFee' :
	doEntrance();
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break;

	case 'Assign' :
	doAssign();
	break;

	case 'confirmEnrol';
	doConfirm();
	break;
	case '';
	doConfirm();
	break;

}
   
/*
//original code for cashier

	function doInsert(){
	
		if ($_POST['Idnum'] == "" OR $_POST['studname'] == "" ) {
			message("All field is required!", "error");
			redirect('index.php');
		}else{
	//`SYID`, `AY`, `SEMESTER`, `COURSE_ID`, `IDNO`, `CATEGORY`, `DATE_RESERVED`, `DATE_ENROLLED`, `STATUS`
		$studname 		= $_POST['studname'];	
		$payables 		= $_POST['totalpayables'];
		$ALLBALANCE		= $payables - $_POST['amountrecieved'];
		$amountreceived = $_POST['amountrecieved'];
		$change			= $_POST['Change'];
		$AY 			= $_POST['ay'];
		$SEMESTER 		= $_POST['sem'];
		$subjectId      = $_POST['selector'];
		$DATEENTRY 		= strftime("%Y-%m-%d %H:%M:%S", time());
		$subjId = count($subjectId);
		$newBal = 0;
		global $mydb, $PAID, $BALANCE;
			if (!$subjectId==''){
				for ($i=0; $i<$subjId; $i++){
					$mydb->setQuery("SELECT  * 
									FROM  `tblschedcharges` 
									WHERE  ID=".$subjectId[$i]);
					$cur = $mydb->loadResultlist();
					foreach ($cur as  $result) {
						$sced = new ScedofCharges();
						$IDNO 			= $_POST['Idnum'];
					//	$AMOUNTDUE		= $amortization;
		         		$AD = $result->AMOUNTDUE;
		         		if ($result->BALANCE > 0){
		         			
		         			if ($AD < $amountreceived ){
		         				$PAID = $AD;
		         				$BALANCE = 0;
		         				$amountreceived = $amountreceived - $PAID;

		         			}elseif($AD > $amountreceived){

		         				if (($amountreceived + $result->PAID) > $AD) {
		         					$BALANCE = 0;
		         					$PAID = $AD;

		         				}elseif(($amountreceived + $result->PAID) < $AD){


									$BALANCE = $result->BALANCE - ($amountreceived) ;
			         				$PAID = $amountreceived + $result->PAID;
									$amountreceived = $amountreceived - $PAID;	
		         				}



		         					         				
		         			}


		         			$sced->PAID 	  = $PAID;
							$sced->BALANCE 	  = $BALANCE;
					
							$sced->update($result->ID); 
			         		
		         		}
		         		//$sced->AMOUNTDUE  = $AMOUNTDUE;
						
						
					}			

				}
				$mydb->setQuery("INSERT INTO `tblcashier` (`CASHID`, `ORNO`, `STUDENTID`, `STUDENTNAME`, `AY`, `SEM`, `DATEPAY`, `AMOUNTPAY`, `AMOUNTBAL`, `CASHIER`) VALUES (NULL, '{$_POST['OR']}', '{$IDNO}', '{$studname }', '{$AY}', '{$SEMESTER}', '{$DATEENTRY}', '{$_POST['amountrecieved']}', '{$ALLBALANCE}', '{$_SESSION['ACCOUNT_NAME']}'); ");
			         		$mydb->executeQuery();
			         $lastid = $mydb->insert_id();
			    $mydb->setQuery("UPDATE tblcommon_list SET LISTNAME='{$_POST['OR']}' WHERE CATEGORY='OR'");
			         		$mydb->executeQuery();
			         		
	         	//message("Transaction has been saved!","info");
				redirect('index.php?view=print&lastid='.$lastid);
			}

			
		}

	}

*/
	function doEntrance(){
	
		if ($_POST['Idnum'] == "" OR $_POST['studname'] == "" OR $_POST['amountrecieved'] == "") {
			message("All field is required!", "error");
			redirect('index.php?view=add&id='.$_POST['Idnum']);
		}else{
	//`SYID`, `AY`, `SEMESTER`, `COURSE_ID`, `IDNO`, `CATEGORY`, `DATE_RESERVED`, `DATE_ENROLLED`, `STATUS`
		$studname 		= $_POST['studname'];	
		$payables 		= $_POST['totalpayables'];
		$ALLBALANCE		= $payables - $_POST['amountrecieved'];
		$amountreceived = $_POST['amountrecieved'];
		$change			= $_POST['Change'];
		$AY 			= $_POST['ay'];
		$SEMESTER 		= $_POST['sem'];
	
		$DATEENTRY 		= strftime("%Y-%m-%d %H:%M:%S", time());
		;global $mydb;
		if ($amountreceived >= $payables  ) {
			$mydb->setQuery("INSERT INTO `tblcashier` (`CASHID`, `ORNO`, `STUDENTID`, `STUDENTNAME`, `AY`, `SEM`, `DATEPAY`, `AMOUNTPAY`, `AMOUNTBAL`, `CASHIER`) VALUES (NULL, '{$_POST['OR']}', '{$_POST['Idnum']}', '{$studname }', '{$AY}', '{$SEMESTER}', '{$DATEENTRY}', 1500, 0, '{$_SESSION['ACCOUNT_NAME']}'); ");
	         		$mydb->executeQuery();
	         $lastid = $mydb->insert_id();
	 	   $mydb->setQuery("UPDATE tblcommon_list SET LISTNAME='{$_POST['OR']}' WHERE CATEGORY='OR'");
	        $mydb->executeQuery();

	       $mydb->setQuery("UPDATE schoolyr SET CATEGORY='Enrolled' WHERE AY='{$AY}' AND SEMESTER='{$SEMESTER}' AND IDNO='{$_POST['Idnum']}'");
	        $mydb->executeQuery();
	         		
     	message("Transaction has been saved!","info");
		redirect('index.php?view=printEntrance&lastid='.$lastid);

		}else{
			message("Entrance Fee should be Payed in Full!","info");
				redirect('index.php?view=addEntrance&id='.$_POST['Idnum']);
		}
		
	
		         			

		}
		

			
	}

		function doInsert(){
	
		if ($_POST['Idnum'] == "" OR $_POST['studname'] == "" OR $_POST['amountrecieved'] == "") {
			message("All field is required!", "error");
			redirect('index.php?view=add&id='.$_POST['Idnum']);
		}else{
	//`SYID`, `AY`, `SEMESTER`, `COURSE_ID`, `IDNO`, `CATEGORY`, `DATE_RESERVED`, `DATE_ENROLLED`, `STATUS`
		$studname 		= $_POST['studname'];	
		$payables 		= $_POST['totalpayables'];
		$ALLBALANCE		= $payables - $_POST['amountrecieved'];
		$amountreceived = $_POST['amountrecieved'];
		$change			= $_POST['Change'];
		$AY 			= $_POST['ay'];
		$SEMESTER 		= $_POST['sem'];
		$subjectId      = $_POST['selector'];
		$DATEENTRY 		= strftime("%Y-%m-%d %H:%M:%S", time());
		$subjId = count($subjectId);
		$newBal = 0;
		global $mydb, $PAID, $BALANCE;
			if (!$subjectId==''){
				for ($i=0; $i<$subjId; $i++){
					$mydb->setQuery("SELECT  * 
									FROM  `tblschedcharges` 
									WHERE SETTLED='NO' AND ID=".$subjectId[$i]);
					$cur = $mydb->loadResultlist();
					foreach ($cur as  $result) {
						$sced = new ScedofCharges();
						$IDNO 			= $_POST['Idnum'];
					//	$AMOUNTDUE		= $amortization;
						$SET = 'NO';
		         		$AD = $result->AMOUNTDUE;
		         		$OB = $result->OVERALLBAL;
		         		if ($result->BALANCE > 0){
		         			
		         			if ($AD < $amountreceived ){
		         				$PAID = $AD;
		         				$BALANCE = 0;
		         				$amountreceived = $amountreceived - $PAID;
		         				$SET = 'YES';
		         				$OB = $OB - $PAID;

		         			}elseif($AD == ($amountreceived + $result->PAID)){
		         				$PAID = $AD;
		         				$BALANCE = 0;
		         				$amountreceived = $amountreceived - $PAID;
		         				$OB = $OB - $PAID;
		         				$SET = 'YES';
		         				
		         			}elseif($AD > $amountreceived){

		         				if (($amountreceived + $result->PAID) > $AD) {
		         					$BALANCE = 0;
		         					$PAID = $AD;
		         					$SET = 'YES';
		         					$OB = $OB - $PAID;
		         				}elseif(($amountreceived + $result->PAID) < $AD){


									$BALANCE = $result->BALANCE - ($amountreceived) ;
			         				$PAID = $amountreceived + $result->PAID;
									$amountreceived = $amountreceived - $PAID;
									$OB = $OB - $PAID;
		         				}



		         					         				
		         			}
		         		//	echo $OB. $amountreceived .'<BR>';

		         			$sced->SETTLED    = $SET;
		         			$sced->PAID 	  = $PAID;
							$sced->BALANCE 	  = $BALANCE;
							$sced->OVERALLBAL = $OB;
							$sced->update($result->ID); 

			         		$mydb->setQuery("UPDATE tblschedcharges SET OVERALLBAL='{$OB}' WHERE IDNO='{$_POST['Idnum']}' AND SETTLED <> 'YES' AND AY = '{$AY}' AND SEM = '{$SEMESTER}'");
			         		$mydb->executeQuery();
		         		}
		         		//$sced->AMOUNTDUE  = $AMOUNTDUE;
						
						
					}	
		         		//$sced->AMOUNTDUE  = $AMOUNTDUE;
						
						
					}			

				}
				$mydb->setQuery("INSERT INTO `tblcashier` (`CASHID`, `ORNO`, `STUDENTID`, `STUDENTNAME`, `AY`, `SEM`, `DATEPAY`, `AMOUNTPAY`, `AMOUNTBAL`, `CASHIER`) VALUES (NULL, '{$_POST['OR']}', '{$_POST['Idnum']}', '{$studname }', '{$AY}', '{$SEMESTER}', '{$DATEENTRY}', '{$_POST['amountrecieved']}', '{$ALLBALANCE}', '{$_SESSION['ACCOUNT_NAME']}'); ");
			         		$mydb->executeQuery();
			         $lastid = $mydb->insert_id();
			    $mydb->setQuery("UPDATE tblcommon_list SET LISTNAME='{$_POST['OR']}' WHERE CATEGORY='OR'");
			         		$mydb->executeQuery();
			         		
	         	message("Transaction has been saved!","info");
				redirect('index.php?view=print&lastid='.$lastid);
			}

			
	}

	

	

	function doConfirm(){
		
		
		$id = 	$_GET['id'];

		$SY = new Schoolyr();
		$SY->CATEGORY 		= 'Enrolled';
		$SY->DATE_ENROLLED  = strftime("%Y-%m-%d %H:%M:%S", time());
		$SY->update($id);

			 
		message("Student is Now Enrolled!","info");
		redirect('index.php');
		// }
		// }

		
	}
	function doDelete(){
		
		
		$id = 	$_GET['id'];

		$dept = new Dept();
		$dept->delete($id);

			 
		message("Grade level already Deleted!","info");
		redirect('index.php');
		// }
		// }

		
	}

	function doAssign(){
		global $mydb;
	
		
		
		$grdlvl = $_POST['grdlvl'];
		$subjectId = $_POST['selector'];
		$subjId = count($subjectId);
		if (!$subjectId==''){
			for ($i=0; $i<$subjId; $i++){
				$mydb->setQuery("SELECT  * 
								FROM  `subject` 
								WHERE  SUBJ_ID=".$subjectId[$i]);
				$cur = $mydb->loadResultlist();
				foreach ($cur as  $result) {
					$grade = new Grades();
					$IDNO 			= $_POST['Idnum'];
					$STUDENTNAME    = $_POST['studname'];
	         		$SUBJ_ID  		= $result->SUBJ_ID;
	         		$DESCRIPTION    = $result->SUBJ_DESCRIPTION;
			 		$SYID    		= $_POST['syid'];
					$AY 			= $_POST['ay'];
					$SEMESTER 		= $_POST['SEMESTER'];

					$grade->IDNO 			= $IDNO;        
	                $grade->STUDENTNAME     = $STUDENTNAME;
	                $grade->SUBJ_ID 		= $SUBJ_ID;
					$grade->DESCRIPTION 	= $DESCRIPTION;
					$grade->SYID 			= $SYID;
					$grade->AY 				= $AY;
					$grade->SEMESTER		= $SEMESTER;
					$grade->create(); 
						message("New Student subject has been assigned successfully!","success");
						redirect('index.php');
				}	
			}	
		}else{
			message("Select first the subject(s) you want to Add!","error");
			redirect('index.php?view=asignsubj&id='.$IDNO.'');
		}	








/*
		$mydb->setQuery("SELECT * 
                      FROM  `subject` where LEVEL='". $grdlvl."'");
        $cur = $mydb->loadResultList();

            foreach ($cur as $result) {
            	$IDNO 			= $_POST['Idnum'];
				$STUDENTNAME    = $_POST['studname'];
         		$SUBJ_ID  		= $result->SUBJ_ID;
         		$DESCRIPTION    = $result->SUBJ_DESCRIPTION;
		 		$SYID    		= $_POST['syid'];
				$AY 			= $_POST['ay'];
				$GRADELEVEL		= $result->LEVEL;
				$SECTION   		= $_POST['section'];
                  
                $grade->IDNO 			= $IDNO;        
                $grade->STUDENTNAME     = $STUDENTNAME;
                $grade->SUBJ_ID 		= $SUBJ_ID;
				$grade->DESCRIPTION 	= $DESCRIPTION;
				$grade->SYID 			= $SYID;
				$grade->AY 				= $AY;
				$grade->GRADELEVEL		= $GRADELEVEL;
				$grade->SECTION   		= $SECTION;
				$grade->create(); 
            } 
			
			 */
			 //	message("New Student subject has been assigned successfully!","success");
			//	redirect('index.php');

	}
 
?>