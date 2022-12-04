<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Enrollment  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  <i class="fa fa-plus-circle fw-fa"></i> New</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				
				  <thead>
				  	<tr>
				  		<TH>STUDENT NAME</TH>
				  		<th>IDNO</th>
				  		<th>Course/Yr</th>
						<th>Semester</th>
						<th>AY</th>
				  		<th>CATEGORY</th>
						<th>STATUS</th>
						 <th width="15%" >Action</th>
				  	</tr>	
				  </thead>
				  <tbody>
				  	<?php 
				  //	`SYID`, `AY`, `COURSE_ID`, `IDNO`, `CATEGORY`, `SECTION`, `STATUS`
				  		$dept = new Schoolyr();
						$cur = $dept->allSchoolyr();
						global $mydb;
						$mydb->setQuery("SELECT `SYID`, `AY`, `SEMESTER`, schoolyr.`COURSE_ID`, `IDNO`, `CATEGORY`, `DATE_RESERVED`, `DATE_ENROLLED`, `STATUS`, `STUDENTNAME`,CONCAT(`COURSE_NAME`,'- ', `COURSE_LEVEL`) as 'COURSENAME' FROM `schoolyr` LEFT JOIN course ON schoolyr.COURSE_ID = course.COURSE_ID WHERE `AY`='{$_SESSION['AY']}' AND SEMESTER='{$_SESSION['SEMESTER']}'");
						$cur = $mydb->loadresultlist();

						foreach ($cur as $sy) {
					  		echo '<tr>';
							echo '<td>'. $sy->STUDENTNAME.'</td>';
							echo '<td>'. $sy->IDNO.'</td>';
							echo '<td>'. $sy->COURSENAME.'</td>';
							echo '<td>'. $sy->SEMESTER.'</td>';
					  		echo '<td>' . $sy->AY.'</a></td>';
					  		echo '<td>'. $sy->CATEGORY.'</td>';
					  		echo '<td>'. $sy->STATUS.'</td>';
					  		$active = "";
					  		
					  		echo '<td align="center" > <a title="Assign Subject" href="index.php?view=asignsubj&id='.$sy->IDNO.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-book fw-fa"></span></a>
					  		<a title="Assigned Subject" href="index.php?view=viewsubj&id='.$sy->IDNO.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-bookmark fw-fa"></span></a>
					  		 <a title="Edit" href="controller.php?action=confirmEnrol&id='.$sy->SYID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
					  					 <a title="Delete" href="controller.php?action=delete&id='.$sy->SYID.'" class="btn btn-danger btn-xs" '.$active.'><span class="fa fa-trash-o fw-fa"></span> </a>
					  					 </td>';
					  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
				 
				</table>
			
				</form>
	

</div> <!---End of container-->