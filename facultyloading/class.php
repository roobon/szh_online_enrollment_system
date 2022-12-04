<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<?php

  	 if (isset($_GET['id'])){			
		$mydb->setQuery("SELECT * 
								FROM  `subject` s,  `course` c  ,class cl
								WHERE s.`COURSE_ID` = c.`COURSE_ID` 
								AND s.`SUBJ_ID`=cl.`SUBJ_ID` 
								AND  s.`SUBJ_ID` = ".$_GET['id']."");
			 $rowcount = $mydb->num_rows();
         if ($rowcount > 0){
			$cur = $mydb->loadSingleResult();
			}		
		}
	  ?>
<div class="row">

   	<div class="col-lg-12">
   		<?php
		check_message();
		?>
   		<div class="panel panel-primary">
   			<div class="panel-heading">
			    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Instructor Class </h3>
			  </div>
			  <div class="panel-body">

			  	<div class="row">
			  		<div class="col-lg-12">
			  			<form class="form-horizontal span4" action="" method="POST">
				    		<table class="table" align="center" >	 
				    			
								  <tbody>				    
							     	<tr>


							     		<td><strong>Subject Code</strong></td>
							     		<td><strong>Description </strong></td>
							     		<td><strong>Crs/Yr</strong></td>
							     		<td><strong>Days</strong></td>
							     		<td><strong>Time</strong></td>
							     		<td><strong>Room</strong></td>
							     	</tr>	

							     	<tr>
							     		<td><input type="text" class="form-control input-sm" name="" value="<?php echo (isset($cur)) ? $cur->SUBJ_CODE : 'Code' ;?>"> </td>
							     		<td><input type="text" class="form-control input-sm" name="" value="<?php echo (isset($cur)) ? $cur->SUBJ_DESCRIPTION  : 'Description' ;?>"></td>
							     		<td><input type="text" class="form-control input-sm" name="" value="<?php echo (isset($cur)) ? $cur->COURSE_DESC : 'Course' ;?>"></td>
							     		<td><input type="text" class="form-control input-sm" name="" value="<?php echo (isset($cur)) ? $cur->DAY . ' ' .$cur->DAY : 'DAYS' ;?>"></td>
							     		<td><input type="text" class="form-control input-sm" name="" value="<?php echo (isset($cur)) ? $cur->DAY . ' ' .$cur->C_TIME : 'TIME' ;?>"></td>
							     		<td><input type="text" class="form-control input-sm" name="" value="<?php echo (isset($cur)) ? $cur->DAY . ' ' .$cur->ROOM : 'Room' ;?>"></td>
							     	</tr>

						    	</tbody>
						    </table>
						</form>
			  		</div>
			  	</div>
			  		<div class="row">
				  		<div class="col-lg-12">
				  		<h3 align="left">List of Student</h3>
						   <form action="" Method="POST">  					
							<table id="example" class="table table-striped" cellspacing="0">
							
							  <thead>
							  	<tr id="table" >
							  		<tr>
							  			<th>No.</th>
							  		<th>  ID#.</th>
							  		<th>Fullname</th>
							  		<th>Sex</th>
							  		<th>PRE</th>
							  		<th>MID</th>
							  		<th>FIN</th>
							  		<th>Final AVE.</th>				  		
							  		<th>Remarks</th>
							  	</tr>	
							  </thead>
							  <tbody>
							  	<?php 

							  	global $mydb;
							

							  		$mydb->setQuery(" SELECT * 
													FROM  `grades` g,  `tblstudent` s
													WHERE g.`IDNO` = s.`IDNO` AND g.`SUBJ_ID` =". $_GET['id']." order by s.LNAME ");
							  		loadresult();
							  	
							  		function loadresult(){
							  			global $mydb;
								  		$cur = $mydb->loadResultList();
								  		$i = 0;
										foreach ($cur as $student) {
								  		$i = $i + 1;
								  		echo '<tr>';

								  		echo '<td width="5%" align="center">'.$i .'</td>';
								  		// echo '<td><input type="checkbox" name="selector[]" id="selector[]" value="'.$student->IDNO. '"/>
								  		// 		<a href="edit_studentinfo.php?id='.$student->IDNO.'">' . $student->IDNO.'</a></td>';
								  		echo '<td>' . $student->IDNO.'</td>';
								  		echo '<td><a href="index.php?view=grade&classId='.$_GET['id'].'&gradeId='.$student->GRADE_ID.'&instructorId='.$_GET['IDNO'].'">'.$student->STUDENTNAME.'</a></td>';
								  		echo '<td>'. $student->SEX.'</td>';
								  		echo '<td>'. $student->PRE.'</td>';
								  		echo '<td>'. $student->MID.'</td>';
								  		echo '<td>'. $student->FIN.'</td>';
								  		echo '<td>'. $student->FIN_AVE.'</td>';
								  		echo '<td>'. $student->REMARKS.'</td>';  
								  		echo '</tr>';
								  		}

							  		} 
							  	
							  	?>

			 
							  </tbody>
							 
							</table>
							<div class="btn-group">
							  <a href="index.php" class="btn btn-default">Back</a>
							  <!--  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button> -->
							</div>
							</form>
				  		</div>
			  		</div>	

			  </div>

			  </div>	
   		</div>	
   	</div>
    	<!-- /.col-lg-12 -->
</div>
