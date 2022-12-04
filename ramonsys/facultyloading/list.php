<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List Faculty Loads  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  <i class="fa fa-plus-circle fw-fa"></i> New</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				
				  <thead>
				  	<tr>
					  	<th width="5%">IDNO.</th>
					  	<th>Employee Name</th>
					 	<th>Subject Description</th>
						<th>DAY</th>
						<th>TIME</th>
						<th>ROOM</th>
				  		<th>AY</th>
						<th>Semester</th>
						 <th width="10%" >Action</th>
				  	</tr>	
				  </thead>
				  <tbody>
				  	<?php 
				  //	`INSSUBJ_ID`, `EMPID`, `INSTNAME`, `GRADELEVEL`, `SUBJ_ID`, `SUBJDESCRPTION`, `AY`, `SECTION`
				  		  $mydb->setQuery("SELECT CLASS_ID,`INST_FULLNAME`,`CLASS_CODE`, `SUBJ_ID`, c.`INST_ID`, `SEMESTER`, `AY`, `DAY`, `C_TIME`, c.`INST_NAME`, `ROOM`, `SECTION` FROM `instructor` i, `class`c WHERE c.`INST_ID` =i.`IDNO`");
             			 	$rowcountss = $mydb->num_rows();

							if ($rowcountss > 0){

             			 	$cur = $mydb->loadResultList();

								foreach ($cur as $instSubj) {
							  		echo '<tr>';

							  		echo '<td>' . $instSubj->INST_ID.'</a></td>';
							  		echo '<td>'. $instSubj->INST_FULLNAME.'</td>';
							  		echo '<td>'. $instSubj->CLASS_CODE.'</td>';
									echo '<td>'. $instSubj->DAY.'</td>';
									echo '<td>'. $instSubj->C_TIME.'</td>';
									echo '<td>'. $instSubj->ROOM.'</td>';
									echo '<td>'. $instSubj->AY.'</td>';		
									echo '<td>'. $instSubj->SEMESTER.'</td>';		  		
							  		echo $active = "";
							  		
							  		echo '<td align="center" > 
							  		<a title="View Students" href="index.php?view=viewstudent&id='.$instSubj->SUBJ_ID.'&IDNO='.$instSubj->INST_ID.'" class="btn btn-primary btn-xs" '.$active.'><span class="glyphicon glyphicon-search"></span> </a>
							  		<a title="Edit Schedules" href="index.php?view=time&classid='.$instSubj->CLASS_ID.'&subjid='.$instSubj->SUBJ_ID.'&instid='.$instSubj->INST_ID.'&ay='.$instSubj->AY.'&sem='.$instSubj->SEMESTER.'" class="btn btn-primary btn-xs" '.$active.'><span class="glyphicon glyphicon-edit"></span> </a>
							  		<a title="Print Masterlist" href="index.php?view=print&id='.$instSubj->SUBJ_ID.'&IDNO='.$instSubj->INST_ID.'" class="btn btn-primary btn-xs" '.$active.'><span class="glyphicon glyphicon-edit"></span> </a>
							  					 <a title="Delete" href="controller.php?action=delete&id='.$instSubj->CLASS_ID.'&subjid='.$instSubj->SUBJ_ID.'" class="btn btn-danger btn-xs" '.$active.'><span class="fa fa-trash-o fw-fa"></span> </a>
							  					 </td>';
							  		echo '</tr>';
						  		}
						  	}else{
								  		echo '<tr>';
								  		//echo '<td colspan="6">No subjects assigned!</td>';
								  		echo '</tr>';
							}

								  		
							
				  	?>
				  </tbody>
				 
				</table>
			
				</form>
	

</div> <!---End of container-->