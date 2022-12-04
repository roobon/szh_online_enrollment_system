<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<?php

  	 if (isset($_GET['id'])){			
		$mydb->setQuery("SELECT * FROM schoolyr where IDNO= ".$_GET['id']."");
			 $rowcount = $mydb->num_rows();
         if ($rowcount ==1 ){
			$cur = $mydb->loadSingleResult();
			
			$mydb->setQuery("SELECT * FROM course where COURSE_ID= ".$cur->COURSE_ID."");
			$course = $mydb->loadSingleResult();
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
			    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span>Student Class Schedule </h3>
			  </div>
			  <div class="panel-body">

			  	<div class="row">
			  		<div class="col-lg-12">
			  			<form class="form-horizontal span4" action="" method="POST">
				    		<table class="table" align="center" >	 
				    			
								  <tbody>				    
							     	<tr>
							     		<td><strong>Student Name:</strong> <?php echo (isset($cur)) ? $cur->STUDENTNAME : 'Student Name' ;?><br/>
							     		<strong>Course:</strong> <?php echo (isset($cur)) ? $course->COURSE_NAME .'-'. $course->COURSE_LEVEL : 'Course Enrolled' ;?><br/>
							     		<strong>Enrollment Status:</strong> <?php echo (isset($cur)) ? $cur->CATEGORY : 'Enrollment Status' ;?><br/>
							     		<strong>Academic Year:</strong> <?php echo (isset($cur)) ? $cur->AY  : 'ay' ;?><br/>
							     		<strong>Semester:</strong> <?php echo (isset($cur)) ? $cur->SEMESTER : 'SEMESTER' ;?><br/>
							     	 
							     	</tr>
						    	</tbody>
						    </table>
						</form>
			  		</div>
			  	</div>
			  		<div class="row">
				  		<div class="col-lg-12">
				  		<h3 align="left">Schedules</h3>
						   <form action="" Method="POST">  					
							<table id="example" class="table table-striped table-bordered table-hover table-responsive" cellspacing="0">
							
							  <thead>
							  	<tr id="table" >
							  		<tr>
							  		<th>No.</th>
							  	
							  		<th>Subject Description</th>
							  		<th>Day</th>
							  		<th>Time</th>
							  		<th>Room</th>
							  		<th>Section</th>		
							  		<th>Instructor</th>				  		
							  		
							  	</tr>	
							  </thead>
							  <tbody>
							  	<?php 

							  	global $mydb;
							

							  		$mydb->setQuery("SELECT g.`IDNO`, `STUDENTNAME`, `DESCRIPTION`,`DAY`, `C_TIME`, `ROOM`, c.`SECTION`,INST_NAME FROM  class c RIGHT JOIN grades g  ON g.SUBJ_ID=c.SUBJ_ID WHERE g.IDNO=".$_GET['id']."");
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
								  		//echo '<td>' . $student->IDNO.'</td>';
								  		echo '<td>'. $student->DESCRIPTION.'</td>';
								  		echo '<td>'. $student->DAY.'</td>';
								  		echo '<td>'. $student->C_TIME.'</td>';
								  		echo '<td>'. $student->ROOM.'</td>';
								  		echo '<td>'. $student->SECTION.'</td>';
								  		echo '<td>'. $student->INST_NAME.'</td>';
								  		echo '</tr>';
								  		}

							  		} 
							  	
							  	?>

			 
							  </tbody>
							 
							</table>
							<div class="btn-group">
							
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
