<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Defaults  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  <i class="fa fa-plus-circle fw-fa"></i> New</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				
				  <thead>
				  	<tr>
				  		<th>Code</th>
				  		<th>Category</th>
				  		<th>Default Name</th>
				  		<th>Active</th>
						 <th width="10%" >Action</th>
				  	</tr>	
				  </thead>
				  <tbody>
				  	<?php 
				  	global $mydb;
				  		$mydb->setQuery("select  * from tblcommon_list");
						$cur = $mydb->loadResultList();
						foreach ($cur as $Defaults) {
				  		echo '<tr>';

				  		echo '<td>' . $Defaults->COMMON_CODE.'</a></td>';
				  		echo '<td>'. $Defaults->CATEGORY.'</td>';
				  		echo '<td>'. $Defaults->LISTNAME.'</td>';
				  		echo '<td>'. $Defaults->ISDEFAULT.'</td>';
				  		echo $active = "";
				  		
				  		echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$Defaults->COMMON_ID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Delete" href="controller.php?action=delete&id='.$Defaults->COMMON_ID.'" class="btn btn-danger btn-xs" '.$active.'><span class="fa fa-trash-o fw-fa"></span> </a>
				  					 </td>';
				  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
				 
				</table>
			
				</form>
	

</div> <!---End of container-->