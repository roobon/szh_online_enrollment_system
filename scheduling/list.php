<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

 if (isset($_POST['search'])){
 	redirect("index.php?view=add&cid=".$_POST['grdlvl']);
 }
?>
<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"> Select Course and Add new Schedule:</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <form class="navbar-form navbar-left" id="lets_search" action="#" method="POST">
      <div class="form-group">
        <select class="form-control input-sm" name="grdlvl" id="grdlvl">
        <?php
        global $mydb;
         $mydb->setQuery("SELECT `COURSE_ID`, CONCAT(`COURSE_NAME`,'-', `COURSE_LEVEL`, `COURSE_MAJOR`) as 'COURSE' FROM `course`"); 
         $cur = $mydb->loadResultList();
        foreach ($cur as $Department) {
          echo '<option value="'. $Department->COURSE_ID.'">'.$Department->COURSE .'</option>';
        }

        ?>

       </select> 
      </div>
       <button type="submit" name="search" class="btn btn-default"> Select <span class="glyphicon glyphicon-search"></span></button></span>
      
    </form>
   
  </div><!-- /.navbar-collapse -->
</nav>
<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Schedules   </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				  <thead>
				  	<tr>
				  	
				  		<th>Subject Code</th>
				  		<th>Description</th>
				  		<th>Days</th>
				  		<th>Time</th>
				  		<th>Room</th>
				  		<th>Course & Yr.</th>
				  		<th>Instructor</th>
				  		<th>AY</th>
				  		<th>SEMESTER</th>

				  		
				  		<th width="10%" >Action</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  
				  	<?php 
				  		// `SUBJ_ID`, `SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`, `COURSE_ID`, `AY`, `SEMESTER`
				  		$mydb->setQuery("SELECT CLASS_ID,`CLASS_CODE`, SUBJ_DESCRIPTION, `DAY`, `C_TIME`, `ROOM`, CONCAT(`COURSE_NAME`, '- ', `COURSE_LEVEL`) AS COURSENAME, `INST_NAME`, cl.AY, cl.SEMESTER FROM `subject` s, course c, class cl WHERE s.`COURSE_ID`= c.COURSE_ID AND s.`SUBJ_ID`= cl.SUBJ_ID");
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		//echo '<td>' . $result->SUBJ_ID.'</a></td>';
				  		echo '<td>' . $result->CLASS_CODE.'</a></td>';
				  		echo '<td>'. $result->SUBJ_DESCRIPTION.'</td>';
				  		echo '<td>'. $result->DAY.'</td>';
				  		echo '<td>'. $result->C_TIME.'</td>';
				  		echo '<td>'. $result->ROOM.'</td>';
				  		echo '<td>'. $result->COURSENAME.'</td>';
				  		echo '<td>'. $result->INST_NAME.'</td>';
				  		echo '<td>'. $result->AY.'</td>';
				  		echo '<td>'. $result->SEMESTER.'</td>';
				  		
				  			$active = "Enabled";

				  		echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$result->CLASS_ID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Delete" href="controller.php?action=delete&id='.$result->CLASS_ID.'" class="btn btn-danger btn-xs" '.$active.'><span class="fa fa-trash-o fw-fa"></span> </a>
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