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
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break;

	case 'Assign' :
	doAssignSubject();
	break;
	case 'grade':
	savegrade();
	break;
 	case 'updatetime' :
	doupdatetime();
	break;
	case 'updatesced':
		doupdateSced();
		break;
	}

	function doupdateSced(){
	if (isset($_POST['btnupdate'])){

		$instClass = new InstructorClasses();
		//$Subjectid		= $_GET['id'];
		//$subjcode   	= $_POST['subjcode'];
		

		$size = count($_POST['classid']); 

			// $instClass->SUBJ_ID			 = $Subjectid;
			// $instClass->CLASS_CODE		 = $subjcode;
			// $instClass->INST_ID 		 = $INST_ID;		
			

			$i = 0; 
			while ($i < $size) { 
			// define each variable 
			$day 			= $_POST['day'][$i];
			$rm 			= $_POST['rmname'][$i];
			$time 			= $_POST['time'][$i];
			global $mydb;
				
				if ($day =='NONE' AND $rm=='NONE' AND $time=='NONE') {
				}else{
				$mydb->setQuery("SELECT  * 
								FROM  `class` 
								WHERE  DAY='{$day}' AND C_TIME='{$time}' AND ROOM='{$rm}' AND AY='{$_SESSION['AY']}' AND SEMESTER='{$_SESSION['SEMESTER']}'");
				 $rowcount = $mydb->num_rows();
				 $cur = $mydb->loadSingleResult();
			
				 if ($rowcount == 0){
		         	$instClass->ROOM 			 = $rm;
					$instClass->DAY 		 	 = $day;
					$instClass->C_TIME 		 	 = $time;
						
				
					$instClass->update($_POST['classid'][$i]);
		        
		        }else{
					echo '<script type="text/javascript">
					
				          alert("This Schedule Day: '. $day. ', Room: '.$rm.'Time: ' . $time .' has a Conflict And is currently set to '.$cur->INST_NAME.'"); 

						</script>';
		         	
		         }
	
				}
				
		/*	*/
			++$i; 

			} 

message("Scheulde has updated successfully!", "info");
			redirect('index.php');
		
	}
}
function doupdatetime(){
	if (isset($_POST['savetime'])){
	

	if ($_POST['subjdesc'] == "" OR $_POST['unit'] == "") {
		message("All field is required!","error");
		redirect('index.php');
	}else{
		

		$instClass = new InstructorClasses();
		//$Subjectid		= $_GET['id'];
		//$subjcode   	= $_POST['subjcode'];
		$day 			= $_POST['day'];
		$rm 			= $_POST['rmname'];
		$time 			= $_POST['time'];
		$ay 			= $_POST['sy'];
		$section 		= $_POST['section'];


			// $instClass->SUBJ_ID			 = $Subjectid;
			// $instClass->CLASS_CODE		 = $subjcode;
			// $instClass->INST_ID 		 = $INST_ID;		
			$instClass->ROOM 			 = $rm;
			$instClass->SECTION 		 = $section;
			$instClass->DAY 		 	 = $day;
			$instClass->C_TIME 		 	 = $time;
 			$instClass->update($_GET['classid']);
			message("Scheulde has updated successfully!", "info");
			redirect('index.php');
			 
			
		}	 

		
	}
}


	function savegrade(){
	if (isset($_POST['savegrades'])){

	if ($_POST['finalave']>=75 AND $_POST['finalave']<=100){
		$remarks = "Passed";
	}else{
		$remarks= "Failed";
	}

		/*	$instClass = New InstructorClasses();
			$cur = $instClass->single_class($_GET['classId']);*/
//`GRADE_ID`, `IDNO`, `STUDENTNAME`, `SUBJ_ID`, `DESCRIPTION`, `INST_ID`, `INST_NAME`, `SYID`, `AY`, `SEMESTER`, `SECTION`, `PRE`, `MID`, `FIN`, `FIN_AVE`, `REMARKS`

		$grade = new Grades();
		$grade->INST_ID 	= $_GET['instructorId'];
		$grade->PRE 		= $_POST['first'];
		$grade->MID 		= $_POST['second'];
		$grade->FIN 		= $_POST['third'];
		$grade->FIN_AVE	  	= $_POST['finalave'];
		$grade->REMARKS 	= $remarks;
		$grade->update($_GET['gradeId']);		 
 		message("Grade successfully updated!");
 		//$_GET['classId'];
		redirect("index.php?view=viewstudent&id=".$_GET['classId']."&IDNO=".$_GET['instructorId']."");
		///index.php?view=viewstudent&id=22&IDNO=321
	}
}
   function doAssignSubject(){
 		global $mydb;
 		$EMPIDNO = $_POST['idno'];

		$subjectId = $_POST['selector'];
		$subjId = count($subjectId);

		if (!$subjectId==''){
		// echo $selector , $selector;
			for ($i=0; $i<$subjId; $i++){
				//echo $subjectId[$i];
				$mydb->setQuery("SELECT  * 
								FROM  `subject` 
								WHERE  SUBJ_ID=".$subjectId[$i]);
				$cur = $mydb->loadResultlist();
				foreach ($cur as  $result) {
					//`CLASS_ID`, `CLASS_CODE`, `SUBJ_ID`, `INST_ID`, `SYID`, `AY`, `DAY`, `C_TIME`, `IDNO`, `ROOM`, `SECTION`
			 					
					$class = New InstructorClasses();
					$class->CLASS_CODE		=	$result->SUBJ_CODE;
					$class->SUBJ_ID			=	$result->SUBJ_ID;
					$class->INST_ID			=	$EMPIDNO;
					$class->AY				=	$_SESSION['AY'];
					$class->SEMESTER		=   $_SESSION['SEMESTER'];
					$class->DAY				=	'NONE';
					$class->C_TIME			=	'NONE';
					$class->INST_NAME		=	$_POST['Iname'];	
					$class->create();	

					 message("Subject(s) has been Added successfully!","info");
						redirect('index.php');
					

		}
				message("Faculty Load(s) already Added!","info");
			//	redirect('index.php');
			} 
		}else{
			message("Select first the subject(s) you want to Add!","error");
			redirect('index.php?view=addsubject&id='.$EMPIDNO.'');
		}
			
			
	}
	function doInsert(){
	
	
	

	}

	function doEdit(){

		

	}

	
	function doDelete(){
		$id = 	$_GET['id'];

		$grade = new Grades();
		$grade->INST_ID 	= '';
		$grade->INST_NAME 	= '';
		$grade->updateInstgrde($_GET['subjid'],$id);		 

		$subjectdel = New InstructorClasses();
		$subjectdel->delete($id);
		

		message("Subject has been Deleted!","info");
		redirect('index.php');
	}

	
 
?>