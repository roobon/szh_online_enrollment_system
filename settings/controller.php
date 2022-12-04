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
	
	if ($_POST['item'] == "" OR $_POST['default'] == "") {
		message("All field is required!", "error");
		redirect('index.php');
	}else{
		$defaults = new Defaults();
		$item		= $_POST['item'];
		$default  	= $_POST['default'];
		$category 	= $_POST['category'];

		$COMMONCODE	= $category.$item;
		$res = $defaults->find_all_default($COMMONCODE);
				
		if ($res >=1) {
			message("Default already exist!","error");
			redirect('index.php');
		}else{
			$defaults->COMMON_CODE  = $COMMONCODE;
			$defaults->CATEGORY 	= $category;
			$defaults->LISTNAME 	= $item;
			$defaults->ISDEFAULT    = $default;
			
			 $istrue = $defaults->create(); 
			 if ($istrue == 1){
			 
			 	message("New Default [". $item ."] has been created successfully!","success");
				redirect('index.php');

			 }
	}	 

		
	
	}

	}

	function doEdit(){
		global $mydb;
		if ($_POST['item'] == "" OR $_POST['default'] == "") {
			message("All field is required!", "error");
			redirect('index.php');
		}else{
			$defaults = new Defaults();
			$dftid		= $_POST['dftid'];
			$item		= $_POST['item'];
			$default  	= $_POST['default'];
			$category 	= $_POST['category'];
		
			if($default=="YES"){
			 	$mydb->setQuery("UPDATE `tblcommon_list` SET `ISDEFAULT` = 'NO' WHERE CATEGORY='{$category}' AND ISDEFAULT='YES' ");
			 	$mydb->executeQuery();
			 }
			$COMMONCODE	= $category.$item;
			
				$defaults->COMMON_CODE  = $COMMONCODE;
				$defaults->CATEGORY 	= $category;
				$defaults->LISTNAME 	= $item;
				$defaults->ISDEFAULT    = $default;
				$defaults->update($dftid);
				
				 	message("New Default [". $item ."] has been created successfully!","success");
					redirect('index.php');

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