<?php
require_once ("../include/initialize.php");
	  if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'Assess':
	doAssess();
	break;
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

}
   function doAssess(){
	
		if ($_POST['noofunits'] == "" ) {
		//	message("All field is required!", "error");
			redirect('index.php');
		}else{
	//``ASSESSID`, `NOOFUNIT`, `PERUNIT`, `NOOFLAB`, `AMOUNTPERLAB`, `TOTALAMOUNT`, `IDNO`, `AY`, `SEMESTER`
			$SY = new Assessment();

			$IDNO 			= $_POST['Idnum'];
			$AY 			= $_POST['ay'];
			$SEMESTER		= $_POST['sem'];
			$NOOFUNIT 		= $_POST['noofunits'];
			$PERUNIT    	= 210;
			$NOOFLAB     	= '';
			$AMOUNTPERLAB   = '';
			$TOTALAMOUNT    = $NOOFUNIT * $PERUNIT;
			
					
			$SY->AY 			= $AY;
			$SY->SEMESTER		= $SEMESTER;
			$SY->IDNO 			= $IDNO;
			$SY->NOOFUNIT 		= $NOOFUNIT;
			$SY->PERUNIT  		= $PERUNIT;
			$SY->NOOFLAB 		= $NOOFLAB;
			$SY->AMOUNTPERLAB   = $AMOUNTPERLAB;
			$SY->TOTALAMOUNT    = $TOTALAMOUNT;

			global $mydb;
			$mydb->setQuery("SELECT  * FROM tblassessment WHERE IDNO='{$IDNO}' AND AY='{$AY}' AND SEMESTER='{$SEMESTER}'");
			$rowcount = $mydb->num_rows();
            if ($rowcount > 0){
            	$SY->update($IDNO, $AY, $SEMESTER);

            }else{
            	$SY->create(); 
            	$tuition = new StudPayables();
            	$tuition->IDNO 			= $IDNO;        
            //    $tuition->PAYABLESID    = $PAYABLESID;
                $tuition->PARTICULARS 		= 'TUITION';
				$tuition->AMOUNT 	   		= $TOTALAMOUNT;
				$tuition->AY 				= $AY;
				$tuition->SEMESTER			= $SEMESTER;
				$tuition->create(); 

            	global $mydb;
				$mydb->setQuery("SELECT  * 
									FROM  `tbldefaultcharges` 
									WHERE  COURSE_ID='{$_POST['courseid']}' AND AY='{$_POST['ay']}' AND SEMESTER='{$_POST['sem']}'");
					$cur = $mydb->loadResultlist();
					//`PAYABLESID`, `PARTICULARS`, `AMOUNT`, `IDNO`, `AY`, `SEMESTER`
					//`DEFID`, `COURSE_ID`, `AY`, `SEMESTER`, `PARTICULARS`, `AMOUNT`SELECT * FROM `tbldefaultcharges` WHERE 1
					foreach ($cur as  $result) {
						$payables = new StudPayables();
					//	$IDNO 			= $_POST['Idnum'];
						$PAYABLESID     = $result->DEFID;
		         		$PARTICULARS  	= $result->PARTICULARS;
		         		$AMOUNT    		= $result->AMOUNT;
				 	//	$AY 			= $_POST['ay'];
					//	$SEMESTER 		= $_POST['sem'];
						//$COURSE_ID		= $_POST['courseid'];

						$payables->IDNO 			= $IDNO;        
		                $payables->PAYABLESID       = $PAYABLESID;
		                $payables->PARTICULARS 		= $PARTICULARS;
						$payables->AMOUNT 	   		= $AMOUNT;
						$payables->AY 				= $AY;
						$payables->SEMESTER			= $SEMESTER;
						$payables->create(); 
						//	message("Charges has been added to student payables successfully!","success");
						//	redirect('index.php?view=addSOA&id='.$IDNO.'&ay='.$AY.'&sem='.$SEMESTER.'');
					}	

            }
			           

			
		 	message("Assessment has been created successfully!","success");
			redirect('index.php');

		
		}

	}
	function doInsert(){
	
		if ($_POST['Idnum'] == "" OR $_POST['studname'] == "" ) {
			message("All field is required!", "error");
			redirect('index.php');
		}else{
	//`SYID`, `AY`, `SEMESTER`, `COURSE_ID`, `IDNO`, `CATEGORY`, `DATE_RESERVED`, `DATE_ENROLLED`, `STATUS`
			$SY = new Schoolyr();

			
			$AY 			= $_POST['ay'];
			$SEMESTER		= $_POST['sem'];
			$IDNO 			= $_POST['Idnum'];
			$CATEGORY 		= 'Registered';
			$DATE_RESERVED	= strftime("%Y-%m-%d %H:%M:%S", time()); 
			$STATUS 		= $_POST['Status'];
			$STUDENTNAME    = $_POST['studname'];
			$COURSENAME    = $_POST['grdlvl'];

			
					
			$SY->AY 			= $AY;
			$SY->SEMESTER		= $SEMESTER;
			$SY->IDNO 			= $IDNO;
			$SY->CATEGORY 		= $CATEGORY;
			$SY->DATE_RESERVED  = $DATE_RESERVED;
			$SY->STATUS 		= $STATUS;
			$SY->STUDENTNAME    = $STUDENTNAME;
			$SY->COURSE_ID      = $COURSENAME;
			$SY->create(); 
				 
		 	message("New Student [". $STUDENTNAME ."] has been Registered successfully!","success");
			redirect('index.php');

		
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
			redirect('index.php');
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