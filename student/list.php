<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>

<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
      paging:         false
    } );
} );
</script>
<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Students  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  <i class="fa fa-plus-circle fw-fa"></i> New</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				   <thead>
				  	<tr>
				  		<th>ID#.</th>
				  		<th>Fullname</th>
				  		<th>Gender</th>
				  		<th>Age</th>
				  		<th>Birth Date</th>
				  		<th>Status</th>
				  		<th>Email Address</th>
				  		<th></th>
				  	</tr>	
				  </thead>
				  <tbody>
				  	<?php 

				  	global $mydb;
				

				  	  @$idno =  $_GET['idno'];
				  	  @$lname =  $_GET['lname'];
				  	  @$fname =  $_GET['fname'];
				  	  if ($idno == '' AND $lname=='' AND $fname == ''){
				  	  	$mydb->setQuery("SELECT  `IDNO` , CONCAT(  `LNAME` ,  ' ',  `FNAME` ,  ' ',  `MNAME` ) AS  'Name',
				  						  `SEX` ,`AGE`, `BDAY` ,  `STATUS` ,  `EMAIL`
				  						  FROM  `tblstudent` ");
				  	  	loadresult();

				  	  }else{
							$mydb->setQuery("SELECT  `IDNO` , CONCAT(  `LNAME` ,  ' ',  `FNAME` ,  ' ',  `MNAME` ) AS  'Name',
				  						  `SEX` ,`AGE`, `BDAY` ,  `STATUS` ,  `EMAIL`
											FROM  `tblstudent` 
											WHERE  `IDNO` ='". $idno."' OR  `LNAME` = '". $lname ."'	OR  `FNAME` =  '". $fname ."' 
											");	

							loadresult();	
				  	  }

				  	
				  		function loadresult(){
				  			global $mydb;
					  		$cur = $mydb->loadResultList();
							foreach ($cur as $student) {
					  		echo '<tr>';

					  		echo '<td>'. $student->IDNO.'</a></td>';
					  		echo '<td>'. $student->Name.'</td>';
					  		echo '<td>'. $student->SEX.'</td>';
					  		echo '<td>'. $student->AGE.'</td>';
					  		echo '<td>'. $student->BDAY.'</td>';
					  		echo '<td>'. $student->STATUS.'</td>';
					  		echo '<td>'. $student->EMAIL.'</td>';
					  		$active = "disabled";
				  		
					  		echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$student->IDNO.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
					  					 <a title="Delete" href="controller.php?action=delete&id='.$student->IDNO.'" class="btn btn-danger btn-xs" '.$active.'><span class="fa fa-trash-o fw-fa"></span> </a>
					  					 </td>';
					  		echo '</tr>';
					  		}

				  		} 
				  	
				  	?>


				  </tbody>
				  <tfoot>
				  
				  </tfoot>
				</table>
 
				<!-- <div class="btn-group">
				  <a href="index.php?view=add" class="btn btn-default">New</a>
				  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button>
				</div>
 -->
			</div>
				</form>
	

</div> <!---End of container-->