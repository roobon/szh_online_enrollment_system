<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">Select Student   </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				
				  <thead>
				  	<tr>
				  		<th>IDNO</th>
				  		<TH>STUDENT NAME</TH>
				  		<th>Gender</th>
						<th>Email</th>
						<th>Birthday</th>
				  		<th width="15%" >Action</th>
				  	</tr>	
				  </thead>
				  <tbody>
				  	<?php 
				  //	`SYID`, `AY`, `COURSE_ID`, `IDNO`, `CATEGORY`, `SECTION`, `STATUS`
				  	
						global $mydb;
						    $mydb->setQuery("SELECT `SYID`, `AY`,`SEMESTER`, schoolyr.`COURSE_ID`, `IDNO`, `CATEGORY`, `DATE_RESERVED`, `DATE_ENROLLED`, `STATUS`, `STUDENTNAME`,CONCAT(`COURSE_NAME`,'- ', `COURSE_LEVEL`) as 'COURSENAME' FROM `schoolyr` LEFT JOIN course ON schoolyr.COURSE_ID = course.COURSE_ID WHERE `AY`='{$_SESSION['AY']}' AND SEMESTER='{$_SESSION['SEMESTER']}'");
						$curs = $mydb->loadresultlist();

						foreach ($curs as $sy) {
					  		echo '<tr>';
					  		echo '<td>'. $sy->IDNO.'</td>';
							echo '<td>'. $sy->STUDENTNAME.'</td>';
							echo '<td>'. $sy->COURSENAME.'</td>';
							echo '<td>'. $sy->SEMESTER.'</td>';
							echo '<td>'. $sy->AY.'</td>';
					  		$active = "";
					  		
					  	
					  		if ($sy->CATEGORY == 'Registered') {
					  			echo '<td align="center" > <a title="Pay Entrance Fee" href="index.php?view=addEntrance&id='.$sy->IDNO.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-book fw-fa"></span></a>
			  					 </td>';		 	


					  		}else{


			  					echo '<td align="center" > <a title="Go to billing" href="index.php?view=add&id='.$sy->IDNO.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-book fw-fa"></span></a>
			  					 </td>';
					  		}
					  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
				 
				</table>
			
				</form>
	

</div> <!---End of container-->