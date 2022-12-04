                      <?php 
                        if (!isset($_SESSION['ACCOUNT_ID'])){
                         redirect(web_root."admin/index.php");
                         }

                 
                       ?> 

<?php

 
      ?>
 
<form class="form-horizontal span6" action="index.php?view=list" method="POST">
<div class="col-md-8 well" >
<legend>Report Filter by AY and SemesteR, Course and Level</legend>
	<div class="form-group">
	    <div class="col-md-8">
	      <label class="col-md-4 control-label" for=
	      "course">AY :</label>

	      <div class="col-md-8">
	        <select class="form-control input-sm" name="ay" id="ay">

        <?php
         $mydb->setQuery("SELECT `LISTNAME` FROM `tblcommon_list` where CATEGORY='AY'");
         $cur = $mydb->loadResultList();
         foreach ($cur as $resSS) {
              echo '<option value="'. $resSS->LISTNAME.'" >'. $resSS->LISTNAME. '</option>';
         }
        ?>
      </select> 
	      </div>
	    </div>
	  </div>


	  <div class="form-group">
	    <div class="col-md-8">
	      <label class="col-md-4 control-label" for=
	      "grdlvl">SEMESTER :</label>

	      <div class="col-md-8">
	        <select class="form-control input-sm" name="sem" id="sem">

		        <?php
		         $mydb->setQuery("SELECT `LISTNAME` FROM `tblcommon_list` where CATEGORY='SEMESTER'");
		         $cur = $mydb->loadResultList();
		         foreach ($cur as $res) {
		              echo '<option value="'. $res->LISTNAME.'" >'. $res->LISTNAME. '</option>';
		         }
		        ?>
		      </select> 
	      </div>
	    </div>
	  </div>
	<div class="form-group">
	    <div class="col-md-8">
	      <label class="col-md-4 control-label" for=
	      "course">Course :</label>

	      <div class="col-md-8">
	        <select class="form-control input-sm" name="course" id="course">

        <?php
         $mydb->setQuery("SELECT COURSE_ID,`COURSE_NAME`,COURSE_LEVEL FROM `course`");
         $cur = $mydb->loadResultList();
         foreach ($cur as $res) {
              echo '<option value="'. $res->COURSE_ID.'" >'. $res->COURSE_NAME . '-' .$res->COURSE_LEVEL. '</option>';
         }
        ?>
      </select> 
	      </div>
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-8">
	      <label class="col-md-4 control-label" for=
	      "grdlvl"></label>

	      <div class="col-md-8">
	        <button type="submit" name="search" class="btn btn-default" >Search  <span class="glyphicon glyphicon-search"></span></button></span>
	      </div>
	    </div>
	  </div>

	

</div>


	

</div>

<div class="col-md-12">
    <span id="printout">
<H1>Students Record</H1>
      <div class="table-responsive">         
        <table id="studentlogs" class="table table-striped table-bordered table-hover"  style="font-size:12px" cellspacing="0">
        
         <thead>
				  	<tr>
				  		
				  		<th>IDNO</th>
				  		<TH>STUDENT NAME</TH>
				  		<th>Semester</th>
				  		<th>AY</th>
						<th>Course/Yr</th>						
								  	</tr>	
				  </thead>
				  <tbody>
				  	<?php 
				 	 global $mydb;
					if (isset($_POST['search'])){
						//echo $_POST['course']; 

						$res = $mydb->setQuery("SELECT * FROM schoolyr, course where schoolyr.COURSE_ID = course.COURSE_ID AND course.COURSE_ID='{$_POST['course']}' and AY='{$_POST['ay']}' and SEMESTER='{$_POST['sem']}' ");
					       $row_cnt = $mydb->num_rows();
					        if ($row_cnt > 0) {
					      	$cur = $mydb->loadResultList();
							foreach ($cur as $sy) {
					  		echo '<tr>';
				  			echo '<td>'. $sy->IDNO.'</td>';
					  		echo '<td>'. $sy->STUDENTNAME.'</td>';
					  		echo '<td>'. $sy->SEMESTER.'</td>';
					  		echo '<td>' . $sy->AY.'</a></td>';
					  		echo '<td>'.$sy->COURSE_NAME .'-' . $sy->COURSE_LEVEL.'</td>';
					  		//echo '<td>'. $sy->TIMEALLOTED.'</td>';
					  	
					  		
					  		echo '</tr>';
		

					  		} 

			echo '  </tbody>
          
        </table>';	
         echo '<a href="index.php?view=print&course='.$_POST['course'].'&ay='.$_POST['ay'].'&sem='.$_POST['sem'].'" class="btn btn-primary">Print</a>';
					        }else{
					  		message("No results found!","info");
						 	redirect('index.php');	 
					        		
					        }
					}

				  		
					
				  	?>
				
            <div class="btn-group">
      
         </span>


        </div>

        </div><!--End of container-->

    </div>
 </form>
       
