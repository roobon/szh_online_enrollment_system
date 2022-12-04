<?php
require_once ("../include/initialize.php");
	  if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	case 'assign' :
	doassign();
	break;
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;

 
	}

   function doassign(){
		if (isset($_POST['assignall'])){

			global $mydb;
		
			$Id = $_POST['selector'];
			$ChargeId = count($Id);
			if (!$Id==''){
				for ($i=0; $i<$ChargeId; $i++){
					$mydb->setQuery("SELECT  * 
									FROM  `tbldefaultcharges` 
									WHERE  DEFID=".$Id[$i]);
					$cur = $mydb->loadResultlist();
					//`PAYABLESID`, `PARTICULARS`, `AMOUNT`, `IDNO`, `AY`, `SEMESTER`
					//`DEFID`, `COURSE_ID`, `AY`, `SEMESTER`, `PARTICULARS`, `AMOUNT`SELECT * FROM `tbldefaultcharges` WHERE 1
					foreach ($cur as  $result) {
						$payables = new StudPayables();
						$IDNO 			= $_POST['Idnum'];
						$PAYABLESID     = $result->DEFID;
		         		$PARTICULARS  	= $result->PARTICULARS;
		         		$AMOUNT    		= $result->AMOUNT;
				 		$AY 			= $_POST['ay'];
						$SEMESTER 		= $_POST['sem'];

						$payables->IDNO 			= $IDNO;        
		                $payables->PAYABLESID       = $PAYABLESID;
		                $payables->PARTICULARS 		= $PARTICULARS;
						$payables->AMOUNT 	   		= $AMOUNT;
						$payables->AY 				= $AY;
						$payables->SEMESTER		= $SEMESTER;
						$payables->create(); 
							message("Charges has been added to student payables successfully!","success");
							redirect('index.php?view=addSOA&id='.$IDNO.'&ay='.$AY.'&sem='.$SEMESTER.'');
					}	
				}	
			}else{
				message("Select first charges(s) you want to Add!","error");
				redirect('index.php?view=addSOA&id='.$IDNO.'');
			}	

		}elseif (isset($_POST['assigGroup'])) {
			global $mydb;
		
			//$Id = $_POST['selectors'];
			//$ChargeId = count($Id);
			//if (!$Id==''){
			//	for ($i=0; $i<$ChargeId; $i++){
					$mydb->setQuery("SELECT  * 
									FROM  `tbldefaultcharges` 
									WHERE  COURSE_ID='{$_POST['courseid']}' AND AY='{$_POST['ay']}' AND SEMESTER='{$_POST['sem']}'");
					$cur = $mydb->loadResultlist();
					//`PAYABLESID`, `PARTICULARS`, `AMOUNT`, `IDNO`, `AY`, `SEMESTER`
					//`DEFID`, `COURSE_ID`, `AY`, `SEMESTER`, `PARTICULARS`, `AMOUNT`SELECT * FROM `tbldefaultcharges` WHERE 1
					foreach ($cur as  $result) {
						$payables = new StudPayables();
						$IDNO 			= $_POST['Idnum'];
						$PAYABLESID     = $result->DEFID;
		         		$PARTICULARS  	= $result->PARTICULARS;
		         		$AMOUNT    		= $result->AMOUNT;
				 		$AY 			= $_POST['ay'];
						$SEMESTER 		= $_POST['sem'];
						//$COURSE_ID		= $_POST['courseid'];

						$payables->IDNO 			= $IDNO;        
		                $payables->PAYABLESID       = $PAYABLESID;
		                $payables->PARTICULARS 		= $PARTICULARS;
						$payables->AMOUNT 	   		= $AMOUNT;
						$payables->AY 				= $AY;
						$payables->SEMESTER		= $SEMESTER;
						$payables->create(); 
							message("Charges has been added to student payables successfully!","success");
							redirect('index.php?view=addSOA&id='.$IDNO.'&ay='.$AY.'&sem='.$SEMESTER.'');
					}	
			//	}	
			//}else{
			//	message("Select first charges(s) you want to Add!","error");
			//	redirect('index.php?view=addSOA&id='.$IDNO.'');
			//}	

		}elseif (isset($_POST['addtuition'])) {
			global $mydb;

					$mydb->setQuery("SELECT  * 
									FROM  `tblassessment` 
									WHERE  IDNO NOT IN (SELECT IDNO FROM tblstudpayables WHERE IDNO = {$_GET['id']} AND AY='{$_GET['ay']}' AND SEMESTER='{$_GET['sem']}' AND PARTICULARS='TUITION' OR PARTICULARS='LABORATORIES') AND IDNO = {$_GET['id']}");
					 $rcount = $mydb->num_rows();
					 
					 if ($rcount == 1){

					$cur = $mydb->loadSingleResult();
					//`ASSESSID`, `NOOFUNIT`, `PERUNIT`, `NOOFLAB`, `AMOUNTPERLAB`, `TOTALAMOUNT`, `IDNO`, `AY`, `SEMESTER``
					
						$payables = new StudPayables();
						$IDNO 			= $_POST['Idnum'];
						$PAYABLESID     = $cur->ASSESSID;
		         		$PART_TUITION  	= 'TUITION';
		         		$TUITIONAMOUNT  = $cur->NOOFUNIT * $cur->PERUNIT;
		         		$PART_LAB  		= 'LABORATORIES';
		         		$LABAMOUNT  	= $cur->NOOFLAB * $cur->AMOUNTPERLAB;
				 		$AY 			= $_POST['ay'];
						$SEMESTER 		= $_POST['sem'];


						$payables->IDNO 			= $IDNO;        
		                $payables->PAYABLESID       = $PAYABLESID;
		                $payables->PARTICULARS 		= $PART_TUITION;
						$payables->AMOUNT 	   		= $TUITIONAMOUNT;
						$payables->AY 				= $AY;
						$payables->SEMESTER			= $SEMESTER;
						$payables->create(); 
							message("Charges has been added to student payables successfully!","success");
							redirect("index.php?view=addSOA&id={$_GET['id']}&ay={$_GET['ay']}&sem={$_GET['sem']}");
					}else{
						message("Tuition and Laboratory charges has been assigned already!","error");
						redirect("index.php?view=addSOA&id={$_GET['id']}&ay={$_GET['ay']}&sem={$_GET['sem']}");
					}
						
		}elseif (isset($_POST['scedCharges'])) {
			
				# code...
			global $mydb;

			$mydb->setQuery("SELECT * FROM `tblschedcharges` WHERE `IDNO`={$_GET['id']} AND `AY`='{$_GET['ay']}' AND `SEM`='{$_GET['sem']}'");
			 $ResultCount = $mydb->num_rows();
			// echo $ResultCount;

				if ($ResultCount < 6){
					$totpayables = $_POST['totalpayables'];
					$amortization =ceil($totpayables / 6);
					
					//echo $excessBal;
				//	$balance = 0;
					$Date = strftime("%Y-%m-%d", time());
			
					for ($i=0; $i < 6; $i++) { 
						$Date = date('Y-m-d', strtotime($Date. ' + 12 days'));
					
						if ($i == 0) {
							$Term = '1st-Term Pre:';
						}elseif ($i == 1) {
							$Term = '1st-Term Mid:';
						}elseif ($i == 2) {
							$Term = '1st-Term Fin:';
						}elseif ($i == 3) {
							$Term = '2nd-Term Pre:';
						}elseif ($i == 4) {
							$Term = '2nd-Term Mid:';
						}elseif ($i == 5) {
							$Term = '2nd-Term Fin:';
							//$AMOUNTDUE		= $amortization - $excessBal;
						}							
						// $balance = $balance + $amortization;
					
							//IDNO`, `TERM`, `DUEDATE`, `AMOUNTDUE`, `PAID`, `BALANCE`, `AY`, `SEM`
							$sced = new ScedofCharges();
							$IDNO 			= $_POST['Idnum'];
							$TERM		    = $Term;
			         		$DUEDATE		= $Date;
			         		$AMOUNTDUE		= $amortization;
			         		$PAID		    = 0;
			         		$BALANCE		= $amortization;
					 		$AY 			= $_POST['ay'];
							$SEMESTER 		= $_POST['sem'];
							$OVERALLBAL     = $totpayables;


							$sced->IDNO 	  = $IDNO;        
			                $sced->TERM       = $TERM;
			                $sced->DUEDATE 	  = $DUEDATE;
			                if ($i==5){
			                	$excessBal =  ($AMOUNTDUE * 6) - $totpayables;
			                	$AMOUNTDUE = $AMOUNTDUE - $excessBal;
			                	$BALANCE   = $AMOUNTDUE;
			                }
			              	$sced->AMOUNTDUE  = $AMOUNTDUE;
							$sced->PAID 	  = $PAID;
							$sced->BALANCE 	  = $BALANCE;
							$sced->AY 		  = $AY;
							$sced->SEM 		  = $SEMESTER;
							$sced->OVERALLBAL = $OVERALLBAL;
							$sced->create(); 



					}
				
					 	message("Scedule of Charges has been saved successfully!","success");
						redirect("index.php?view=addSOA&id={$_GET['id']}&ay={$_GET['ay']}&sem={$_GET['sem']}");
				}else{
					 	
				 	message("Scedule of Charges has already Created!","error");
						redirect("index.php?view=addSOA&id={$_GET['id']}&ay={$_GET['ay']}&sem={$_GET['sem']}");
				}
			
		}

	}


	function doInsert(){
	$charge = $_POST['charges'];
	$subjId = count($charge);
	echo $subjId;
//	print_r($aDataTabaleHeaderHTML); die();

	}

	function doEdit(){

		if (isset($_POST['save'])){

			if ($_POST['deptname'] == "" OR $_POST['deptdesc'] == "") {
				message("All field is required!", "error");
				redirect('index.php');

			}else{
				$dept = new Dept();
				$deptid		= $_POST['deptid'];
				$deptname   = $_POST['deptname'];
				$dept_desc 	= $_POST['deptdesc'];
						
				$dept->DEPT_ID		   = $deptid;
				$dept->DEPARTMENT_NAME = $deptname;
				$dept->DEPARTMENT_DESC = $dept_desc;
				$dept->update($deptid);

				
				message("Grade Level [". $deptname ."] has been updated successfully!","success");
				redirect('index.php');

			}
		}

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

	function doupdateimage(){
 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="photos/".$myfile;


		if ( $errofile > 0) {
				message("No Image Selected!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
		}else{
	 
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']); 
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				message("Uploaded file is not an image!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
			}else{
					//uploading the file
					move_uploaded_file($temp,"photos/" . $myfile);
		 	
					 

						$user = New User();
						$user->USERIMAGE 			= $location;
						$user->update($_SESSION['USERID']);
						redirect("index.php");
						 
							
					}
			}
			 
		}
 
?>