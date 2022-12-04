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
	
	
		if ($_POST['subjcode'] == "" OR $_POST['subjdesc'] == "" OR $_POST['course'] == "") {
			message("All field is required!","error");
			 	redirect('index.php');
		}else{
			

			$subj = new Subject();
			$subjcode   	= $_POST['subjcode'];
			$subjdesc	 	= $_POST['subjdesc'];
			$unit 			= $_POST['unit'];
			$course 		= $_POST['course'];
			$ay 			= $_POST['ay'];
			$semester		= $_POST['Semester'];

		
			$subj->SUBJ_CODE		 = $subjcode;
			$subj->SUBJ_DESCRIPTION  = $subjdesc;
			$subj->UNIT 		     = $unit;
			$subj->COURSE_ID 		 = $course;
			$subj->AY 		     	 = $ay;
			$subj->SEMESTER 		 = $semester;


				 $istrue = $subj->create(); 
				 if ($istrue == 1){
				 	
				 	message("New Subject created successfully!","success");
				 	redirect('index.php');
				 }
		}		 
	 


	}

	function doEdit(){
	if ($_POST['subjcode'] == "" OR $_POST['subjdesc'] == "" OR $_POST['course'] == "") {
			message("All field is required!","error");
			 	redirect('index.php');
		}else{
			
		// `SUBJ_ID`, `SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`, `COURSE_ID`, `AY`, `SEMESTER`
			$subj = new Subject();
			$Subjectid		= $_GET['id'];
			$subjcode   	= $_POST['subjcode'];
			$subjdesc	 	= $_POST['subjdesc'];
			$unit 			= $_POST['unit'];
			$course 		= $_POST['course'];
			$ay 			= $_POST['ay'];
			$semester		= $_POST['Semester'];

		
			$subj->SUBJ_CODE		 = $subjcode;
			$subj->SUBJ_DESCRIPTION  = $subjdesc;
			$subj->UNIT 		     = $unit;
			$subj->COURSE_ID 		 = $course;
			$subj->AY 		     	 = $ay;
			$subj->SEMESTER 		 = $semester;
		
			
			$subj->update($Subjectid);
			message("Subject Has Been updated successfully!","success");
		 	redirect('index.php');
		}		 
	 

	}


	function doDelete(){
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","info");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$user = New User();
		// 	$user->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$user = New User();
	 		 	$user->delete($id);
			 
			message("User already Deleted!","info");
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