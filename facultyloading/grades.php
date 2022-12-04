<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<?php

  	 if (isset($_GET['id'])){			
		$mydb->setQuery("SELECT * 
								FROM  `subject` s,  `course` c  ,class cl
								WHERE s.`COURSE_ID` = c.`COURSE_ID` 
								AND s.`SUBJ_ID`=cl.`SUBJ_ID` 
								AND  s.`SUBJ_ID` = ".$_GET['id']."");
			 $rowcount = $mydb->num_rows();
         if ($rowcount > 0){
			$cur = $mydb->loadSingleResult();
			}		
		}
	  ?>
<div class="row">

   	<div class="col-lg-12">
   		<?php
		check_message();
		?>
   	
<?php
$gradeId = $_GET['gradeId'];
$grade = new Grades();
$cur = $grade->single_grades($gradeId);

	$subjid = $cur->SUBJ_ID;
	$studentId = $cur->IDNO;
?>
<form class="form-horizontal well span4" action="controller.php?action=grade&classId=<?php echo $_GET['classId'];?>&gradeId=<?php echo $_GET['gradeId'];?>&instructorId=<?php echo $_GET['instructorId'];?>" method="POST">

	<fieldset>
		<legend>Add Grades</legend>
		 <div class="form-group">
        <div class="col-md-8">
        <?php 
        	$stud = new Student();
        	$cur=$stud->single_student($studentId);
        ?>
          <label class="col-md-4 control-label" for=
          "subjdesc">Name</label>

          <div class="col-md-8">
             <input class="form-control input-sm" id="studname" name="studname" readonly placeholder=
								  "Subject Description" type="text" value="<?php echo (isset($cur)) ? $cur->LNAME . ' , '.$cur->FNAME: 'Name' ;?>">
          </div>
        </div>
          </div>								
 
			<div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for=
              "subjcode">Subject Code</label>
		<?php 
			$singlesubject = new Subject();
			$cur = $singlesubject->single_subject($subjid);
		?>
              <div class="col-md-8">
                 <input class="form-control input-sm" id="subjcode" name="subjcode" readonly placeholder=
									  "Subject Code" type="text" value="<?php echo (isset($cur)) ? $cur->SUBJ_CODE : 'Code' ;?>">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for=
              "subjdesc">Subject Description</label>

              <div class="col-md-8">
                 <input class="form-control input-sm" id="subjdesc" name="subjdesc" readonly placeholder=
									  "Subject Description" type="text" value="<?php echo (isset($cur)) ? $cur->SUBJ_DESCRIPTION  : 'Description' ;?>">
              </div>
            </div>
          </div>
		<?php
          $grade = new Grades();
		  $cur = $grade->single_grades($gradeId); 
		 ?>
           <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for=
              "first">PRELIM</label>

              <div class="col-md-8">
                 <input class="form-control input-sm" id="first" name="first"  onkeyup="calculategrade();javascript:checkNumber(this);"  type="text" value="<?php echo (isset($cur)) ? $cur->PRE  : 'FIRST' ;?>">
              </div>
            </div>
          </div>
           <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for=
              "second">MIDTERM</label>

              <div class="col-md-8">
                 <input class="form-control input-sm" id="second" name="second"  onkeyup="calculategrade();javascript:checkNumber(this);"    type="text" value="<?php echo (isset($cur)) ? $cur->MID  : 'SECOND' ;?>">
              </div>
            </div>
          </div>
           <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for=
              "third">FINAL</label>
              <div class="col-md-8">
                 <input class="form-control input-sm" id="third" name="third"  onkeyup="calculategrade();javascript:checkNumber(this);"  type="text" value="<?php echo (isset($cur)) ? $cur->FIN  : 'THIRD' ;?>">
              </div>
            </div>
          </div>
      
           <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for=
              "finalave">Final Average</label>
              <div class="col-md-8">
                 <input class="form-control input-sm" id="finalave" name="finalave" readonly    type="text" value="<?php echo (isset($cur)) ? $cur->FIN_AVE  : 'AVE' ;?>">
              </div>
            </div>
          </div>
          
		 <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for=
              "idno"></label>
              <div class="col-md-8">
                <a href="index.php?view=class&id=<?php echo $_GET['classId']; ?>&instructorId=<?php echo $_GET['instructorId'];?>" class="btn btn-primary" name="savecourse" type="submit" >Back</a>
               <button class="btn btn-primary" name="savegrades" type="submit" >Save</button>
              </div>
            </div>
          </div>							
	</fieldset>	

					
</form>
</div><!--End of container-->

   	</div>
    	<!-- /.col-lg-12 -->
</div>
