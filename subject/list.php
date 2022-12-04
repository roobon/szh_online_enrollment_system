<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Subjects  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  <i class="fa fa-plus-circle fw-fa"></i> New</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<th>ID</th>
				  		<th>Code</th>
				  		<th>Description</th>
				  		<th>Unit</th>
				  		<th>PRE REQUISITE</th>
				  		<th>AY</th>
				  		<th>SEMESTER</th>
				  		
				  		<th width="10%" >Action</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  
				  	<?php 
				  		// `SUBJ_ID`, `SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`, `COURSE_ID`, `AY`, `SEMESTER`
				  		$mydb->setQuery("SELECT * 
											FROM  `subject`");
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		echo '<td>' . $result->SUBJ_ID.'</a></td>';
				  		echo '<td>' . $result->SUBJ_CODE.'</a></td>';
				  		echo '<td>'. $result->SUBJ_DESCRIPTION.'</td>';
				  		echo '<td>'. $result->UNIT.'</td>';
				  		echo '<td>'. $result->PRE_REQUISITE.'</td>';
				  		echo '<td>'. $result->AY.'</td>';
				  		echo '<td>'. $result->SEMESTER.'</td>';
				  			$active = "Disabled";

				  		echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$result->SUBJ_ID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Delete" href="controller.php?action=delete&id='.$result->SUBJ_ID.'" class="btn btn-danger btn-xs" '.$active.'><span class="fa fa-trash-o fw-fa"></span> </a>
				  					 </td>';
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