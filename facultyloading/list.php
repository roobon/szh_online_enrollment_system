<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List Faculty Loads  </h1>
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
					 	<th>Address</th>
				  		<th>Gender</th>
				  		<th>Civil Status</th>
				  		<th>Specialization</th>
				 		<th>Email Address</th>
						 <th width="10%" >Action</th>
				  	</tr>	
				  </thead>
				  <tbody>
				  	<?php 
				  //	`INSSUBJ_ID`, `EMPID`, `INSTNAME`, `GRADELEVEL`, `SUBJ_ID`, `SUBJDESCRPTION`, `AY`, `SECTION`
				  		  $mydb->setQuery("SELECT `INST_FULLNAME`,`INST_FULLNAME`, `INST_ADDRESS`, `INST_SEX`, `INST_STATUS`, `SPECIALIZATION`, `INST_EMAIL`, `EMPLOYMENT_STATUS`,`INST_ID`,IDNO FROM `instructor` i");
             			 	$rowcountss = $mydb->num_rows();

							if ($rowcountss > 0){

             			 	$cur = $mydb->loadResultList();

								foreach ($cur as $instSubj) {
							  		echo '<tr>';

							  		echo '<td>' . $instSubj->IDNO.'</a></td>';
							  		echo '<td>'. $instSubj->INST_FULLNAME.'</td>';
							  		echo '<td>'. $instSubj->INST_ADDRESS.'</td>';
									echo '<td>'. $instSubj->INST_SEX.'</td>';
									echo '<td>'. $instSubj->INST_STATUS.'</td>';
									echo '<td>'. $instSubj->SPECIALIZATION.'</td>';
									echo '<td>'. $instSubj->INST_EMAIL.'</td>';		
									//echo '<td>'. $instSubj->SEMESTER.'</td>';		  		
							  		echo $active = "";
							  		
							  		echo '<td align="center" > 
							  		<a title="View Loads" href="index.php?view=viewloads&id='.$instSubj->IDNO.'&IDNO='.$instSubj->IDNO.'" class="btn btn-primary btn-xs" '.$active.'><span class="glyphicon glyphicon-search"></span> </a>
							  		<a title="Add Subjects" href="index.php?view=addsubject&id='.$instSubj->IDNO.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-plus fw-fa"></span></a>';/*
							  		<a title="Print Masterlist" href="index.php?view=print&id='.$instSubj->SUBJ_ID.'&IDNO='.$instSubj->INST_ID.'" class="btn btn-primary btn-xs" '.$active.'><span class="glyphicon glyphicon-edit"></span> </a>
							  					 <a title="Delete" href="controller.php?action=delete&id='.$instSubj->CLASS_ID.'&subjid='.$instSubj->SUBJ_ID.'" class="btn btn-danger btn-xs" '.$active.'><span class="fa fa-trash-o fw-fa"></span> </a>
							  					 </td>';*/
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