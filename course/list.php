<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Course  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  <i class="fa fa-plus-circle fw-fa"></i> New</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<th>ID</th>
				  		<th>Course</th>
				  		<th>Level</th>
				  		<th>Major</th>
				  		<th>Description</th>
				  		<th width="10%" >Action</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  
				  	<?php 
				  		// $mydb->setQuery("SELECT * 
								// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
				  		$mydb->setQuery("SELECT * 
											FROM  `course`");
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		echo '<td>' . $result->COURSE_ID.'</a></td>';
				  		echo '<td>' . $result->COURSE_NAME.'</a></td>';
				  		echo '<td>'. $result->COURSE_LEVEL.'</td>';
				  		echo '<td>'. $result->COURSE_MAJOR.'</td>';
				  		echo '<td>'. $result->COURSE_DESC.'</td>';
				  	
				  		echo '<td align="center" > 
				  		<a title="Edit" href="index.php?view=edit&id='.$result->COURSE_ID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>';

							echo '<a title="Delete" href="controller.php?action=delete&id='.$result->COURSE_ID.'" class="btn glyphicon glyphicon-trash"><span class="fa fa-info fw-fa"></span> </a>';	  				
				  	
				  		echo '	 </td>';
				  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
					
				</table>
 
				<!-- <div class="btn-group">
				  <a href="index.php?view=add" class="btn btn-default">New</a>
				  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button>
				</div>
 -->
			</div>
				</form>
	

</div> <!---End of container-->