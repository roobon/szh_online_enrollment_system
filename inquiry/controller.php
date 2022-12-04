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


	}
function doInsert(){
		
if (isset($_POST['save'])){

	if ($_POST['rmname'] == "" OR $_POST['roomdesc'] == "") {
		message("All field is required!", "error");
		redirect('index.php?view=add');

	}else{
		$room = new Room();
		$rmid		= $_POST['roomid'];
		$rmname     = $_POST['rmname'];
		$rmdesc 	= $_POST['roomdesc'];
		$res = $room->find_all_room($rmname);
				
		if ($res >=1) {
			message("Room name already exist!","error");
			redirect('index.php?view=add');

		}else{
			$room->ROOM_NAME = $rmname;
			$room->ROOM_DESC = $rmdesc;
			 $istrue = $room->create(); 
			 if ($istrue == 1){
			 
			 	message("New [". $rmname ."] Room created successfully!","success");
				redirect('index.php');

			 }
		}	 

		
	}
}
}



function doEdit(){
	$rmid = $_GET['id'];

	if (isset($_POST['save'])){

		if ($_POST['rmname'] == "" OR $_POST['roomdesc'] == "") {
			$message= "All field is required!";
			redirect('index.php?view=edit&id='.$rmid);

		}else{
			$room = new Room();
			$rmid		= $_POST['roomid'];
			$rmname     = $_POST['rmname'];
			$rmdesc 	= $_POST['roomdesc'];
					
			$room->ROOM_ID	 = $rmid;
			$room->ROOM_NAME = $rmname;
			$room->ROOM_DESC = $rmdesc;
			$room->update($rmid);

			$message = $rmname. " has updated successfully!";
			redirect('index.php');
		}
}
}

function doDelete(){
		
	  @$id=$_POST['selector'];
	  $key = count($id);
	//multi delete using checkbox as a selector
	
	for($i=0;$i<$key;$i++){
 
		$room = new Room();
		$room->delete($id[$i]);
	}

message("Room(s) already Deleted!","info");
redirect('index.php');

}

?>