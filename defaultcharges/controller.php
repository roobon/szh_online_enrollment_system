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
	case 'add1' :
	doInsert1();
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
		if (isset($_POST['save'])){
			if ($_POST['Particulars'] == "" OR $_POST['amount'] == "") {
				message("All field is required!", "error");
				redirect('index.php');

			}else{
				      // `DEFID`, `COURSE_ID`, `COURSENAME`, `AY`, `SEMESTER`, `PARTICULARS`, `AMOUNT`
				$defulatcharge = new DefaultCharges();
				$PARTICULARS	= $_POST['Particulars'];
				$AMOUNT   		= $_POST['amount'];
				$SEMESTER 		= $_POST['sem'];
				$AY 	 		= $_POST['ay'];
				$COURSE_ID 	 		= $_POST['grdlvl'];

				$defulatcharge->PARTICULARS = $PARTICULARS;
				$defulatcharge->AMOUNT      = $AMOUNT;
				$defulatcharge->SEMESTER    = $SEMESTER;
				$defulatcharge->AY 		    = $AY;
				$defulatcharge->COURSE_ID 	= $COURSE_ID;
				$defulatcharge->create();

				
				message("New charges [". $PARTICULARS ."] has been updated successfully!","success");
				redirect('index.php');

			}
		}

	}
   
	
	function doEdit(){

		if (isset($_POST['save'])){
			
			if ($_POST['Particulars'] == "" OR $_POST['amount'] == "") {
				message("All field is required!", "error");
				redirect('index.php');

			}else{
				$defulatcharge = new DefaultCharges();
				
				$DEFID			= $_POST['PartID'];
				$PARTICULARS	= $_POST['Particulars'];
				$AMOUNT   		= $_POST['amount'];
				
				$COURSE_ID 	 		= $_POST['grdlvl'];

				//$defulatcharge->DEFID 		= $DEFID;
				$defulatcharge->PARTICULARS = $PARTICULARS;
				$defulatcharge->AMOUNT      = $AMOUNT;
				$defulatcharge->COURSE_ID 	= $COURSE_ID;
				$defulatcharge->update($DEFID);

				
				message("Charges [". $PARTICULARS ."] has been updated successfully!","success");
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