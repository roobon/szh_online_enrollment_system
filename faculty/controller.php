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
	
	if ($_POST['idno'] == "" OR $_POST['name'] == "" OR $_POST['address'] == "" OR $_POST['email'] == "") {
		message("All field is required!","error");
		redirect("index.php");
	}else{
		

		$inst 			= new Instructor();
		$idno   		= $_POST['idno'];
		$name   		= $_POST['name'];
		$address	 	= $_POST['address'];
		$Gender			= $_POST['Gender'];
		$civilstats 	= $_POST['civilstats'];
		$specialization = $_POST['specialization'];
		$email 			= $_POST['email'];
		$empStats 		= $_POST['empStats'];	



		$res = $inst->find_all_instructor($name,$idno);
				
		if ($res >=1) {
			message("Instructor already exist!","error");
			redirect('index.php');
		}else{
			$inst->IDNO					 = $idno;
			$inst->INST_FULLNAME		 = $name;
			$inst->INST_ADDRESS 		 = $address;
			$inst->INST_SEX 			 = $Gender;
			$inst->INST_STATUS 			 = $civilstats;
			$inst->SPECIALIZATION 		 = $specialization;
			$inst->INST_EMAIL 			 = $email;
			$inst->EMPLOYMENT_STATUS	 = $empStats;


			 $istrue = $inst->create(); 
			
			 	message("New Instructor [". $name ."] has been created successfully!","success");
			 	redirect('index.php');
			
		}	 

		
	}
	}

	function doEdit(){
	if ($_POST['name'] == "" OR $_POST['address'] == "" OR $_POST['email'] == "") {
		message("All field is required!","error");
		redirect('index.php');
			 
	}else{
		

		$inst 			= new Instructor();
		$idno   		= $_POST['idno'];
		$instid         = $_POST['instid'];
		$name   		= $_POST['name'];
		$address	 	= $_POST['address'];
		$Gender			= $_POST['Gender'];
		$civilstats 	= $_POST['civilstats'];
		$specialization = $_POST['specialization'];
		$email 			= $_POST['email'];
		$empStats 		= $_POST['empStats'];	
			$inst->IDNO					 = $idno;
			$inst->INST_FULLNAME		 = $name;
			$inst->INST_ADDRESS 		 = $address;
			$inst->INST_SEX 			 = $Gender;
			$inst->INST_STATUS 			 = $civilstats;
			$inst->SPECIALIZATION 		 = $specialization;
			$inst->INST_EMAIL 			 = $email;
			$inst->EMPLOYMENT_STATUS	 = $empStats;
			$inst->update($idno);
		
			 	message($name."has been updated successfully!","success");
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