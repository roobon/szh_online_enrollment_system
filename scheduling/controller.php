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
   
	function doInsert(){
	
	if (isset($_POST['savecourse'])){
		$instClass = new InstructorClasses();
			$singlesubject = new Subject();
			$object = $singlesubject->single_subject($_POST['subjcode']);

			$CLASS_CODE   	= $object->SUBJ_CODE;
			$SUBJ_ID	 	= $object->SUBJ_ID;


			$singleinstructor = new Instructor();
	        $inst = $singleinstructor->single_instructor($_POST['instructor']);
	        $INST_ID			= $inst->IDNO;
	        $INST_FULLNAME		= $inst->INST_FULLNAME;

	        $DAY 	= $_POST['day'];
	        $C_TIME	= $_POST['time'];
	        $ROOM 	= $_POST['room'];



	        	global $mydb;
	        	$mydb->setQuery("SELECT  * 
								FROM  `class` 
								WHERE  DAY='{$DAY}' AND C_TIME='{$C_TIME}' AND ROOM='{$ROOM}' AND AY='{$_SESSION['AY']}' AND SEMESTER='{$_SESSION['SEMESTER']}'");
				 $rowcount = $mydb->num_rows();
			
			 if ($rowcount == 0){
	        	$instClass->CLASS_CODE 		 = $CLASS_CODE;
				$instClass->SUBJ_ID 		 = $SUBJ_ID;
				$instClass->INST_ID 		 = $INST_ID;
				$instClass->INST_NAME 	     = $INST_FULLNAME;
				$instClass->ROOM 			 = $ROOM;
				$instClass->DAY 		 	 = $DAY;
				$instClass->C_TIME 		 	 = $C_TIME;
				$instClass->AY 		 	 	 = $_SESSION['AY'];
				$instClass->SEMESTER 		 = $_SESSION['SEMESTER'];


				 $istrue = $instClass->create(); 
				 if ($istrue == 1){
				 	
				 	message("New Schedule has been created successfully!","success");
				 	redirect('index.php');
				 }
			}else{
				 $cur = $mydb->loadSingleResult();
				echo '<script type="text/javascript">
					
				          alert("This Schedule Day: '. $DAY. ', Room: '.$ROOM.'Time: ' . $C_TIME .' has a Conflict And is currently set to '.$cur->INST_NAME.'"); 

						</script>';
						redirect('index.php');
			}	 
	}
			
		


	}

	function doEdit(){
if (isset($_POST['savecourse'])){
		$instClass = new InstructorClasses();
			$singlesubject = new Subject();
			$object = $singlesubject->single_subject($_POST['subjcode']);

			$CLASS_CODE   	= $object->SUBJ_CODE;
			$SUBJ_ID	 	= $object->SUBJ_ID;


			$singleinstructor = new Instructor();
	        $inst = $singleinstructor->single_instructor($_POST['instructor']);
	        $INST_ID			= $inst->IDNO;
	        $INST_FULLNAME		= $inst->INST_FULLNAME;

	        $DAY 	= $_POST['day'];
	        $C_TIME	= $_POST['time'];
	        $ROOM 	= $_POST['room'];



	        	global $mydb;
	        	$mydb->setQuery("SELECT  * 
								FROM  `class` 
								WHERE  DAY='{$DAY}' AND C_TIME='{$C_TIME}' AND ROOM='{$ROOM}' AND AY='{$_SESSION['AY']}' AND SEMESTER='{$_SESSION['SEMESTER']}'");
				 $rowcount = $mydb->num_rows();
			
			 if ($rowcount == 0){
	        	$instClass->CLASS_CODE 		 = $CLASS_CODE;
				$instClass->SUBJ_ID 		 = $SUBJ_ID;
				$instClass->INST_ID 		 = $INST_ID;
				$instClass->INST_NAME 	     = $INST_FULLNAME;
				$instClass->ROOM 			 = $ROOM;
				$instClass->DAY 		 	 = $DAY;
				$instClass->C_TIME 		 	 = $C_TIME;
				$instClass->AY 		 	 	 = $_SESSION['AY'];
				$instClass->SEMESTER 		 = $_SESSION['SEMESTER'];


				 $istrue = $instClass->update($_GET['id']); 
				// if ($istrue == 1){
				 	
				 	message("Schedule has been updated successfully!","success");
				 	redirect('index.php');
				// }
			 }else{
				 $cur = $mydb->loadSingleResult();
				echo '<script type="text/javascript">
					
				          alert("This Schedule Day: '. $DAY. ', Room: '.$ROOM.'Time: ' . $C_TIME .' has a Conflict And is currently set to '.$cur->INST_NAME.'"); 

						</script>';
						redirect('index.php');
			}	 
	}
		 
	 

	}


	function doDelete(){
		

		
				$id = 	$_GET['id'];

				$class = New InstructorClasses();
	 		 	$class->delete($id);
			 
			message("Schedule already Deleted!","info");
			redirect('index.php');
	

		
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