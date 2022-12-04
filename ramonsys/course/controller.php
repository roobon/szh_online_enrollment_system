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


	}
function doInsert(){
		
	if (isset($_POST['savecourse'])){

	if ($_POST['coursename'] == "" OR $_POST['coursedesc'] == "") {
		message("All field is required!","error");
			redirect('index.php?view=add');
	}else{
		

		$course = new Course();
		$coursename   	= $_POST['coursename'];
		$courselevel   	= $_POST['level'];
		$coursemajor   	= $_POST['major'];
		$coursedesc 	= $_POST['coursedesc'];
	//	$coursedept		= $_POST['dept'];
		$res = $course->find_all_course($coursename, $courselevel, $coursemajor);
				
		if ($res >=1) {
			message("Course name already exist!","error");
			redirect('index.php?view=add');
		}else{
			$course->COURSE_NAME = $coursename;
			$course->COURSE_LEVEL = $courselevel;
			$course->COURSE_MAJOR = $coursemajor;
			$course->COURSE_DESC = $coursedesc;
			//$course->DEPT_ID = $coursedept;	
			 $istrue = $course->create(); 
			 if ($istrue == 1){
			 	
			 	message("New [". $coursename ."] course created successfully!","success");
			 	redirect('index.php');
			 }
		}	 

		
	}
}
}
function doEdit(){
	$courseid = $_GET['id'];
	$singledept = new Course();
	$object = $singledept->single_course($courseid);


	if (isset($_POST['savecourse'])){

		if ($_POST['coursename'] == "" OR $_POST['coursedesc'] == "") {
			
			message("All field is required!", "error");
	redirect('index.php?view=add');
		}else{
			$course = new Course();
			$courseid		= $_GET['id'];
			$coursename   	= $_POST['coursename'];
			$courselevel   	= $_POST['level'];
			$coursemajor   	= $_POST['major'];
			$coursedesc 	= $_POST['coursedesc'];
		//	$coursedept		= $_POST['dept'];
					
			$course->COURSE_NAME = $coursename;
			$course->COURSE_LEVEL = $courselevel;
			$course->COURSE_MAJOR = $coursemajor;
			$course->COURSE_DESC = $coursedesc;
		//	$course->DEPT_ID 	 = $coursedept;	
			$course->update($courseid);
			

			message($coursename. " has updated successfully!", "info");
				redirect('index.php');

		}
	}
		
}

function doDelete(){
	  @$id=$_GET['id'];
	
	$Course = new Course();
		$Course->delete($id);
	message("Course(s) already Deleted!","info");
	redirect('index.php');
}
?>