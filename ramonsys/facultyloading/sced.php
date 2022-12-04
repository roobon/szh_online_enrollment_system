<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<?php

  	  if (isset($_GET['subjid'])){     
      $mydb->setQuery("SELECT * FROM `subject` s, `course` c ,class cl WHERE s.`COURSE_ID` = c.`COURSE_ID` AND s.`SUBJ_ID`=cl.`SUBJ_ID` AND cl.SUBJ_ID ='{$_GET['subjid']}' AND cl.INST_ID='{$_GET['instid']}' AND cl.AY='{$_GET['ay']}' AND cl.SEMESTER='{$_GET['sem']}'");
 $rowcount = $mydb->num_rows();
 
         if ($rowcount > 0){
      $cur = $mydb->loadSingleResult(); 
    $INST_ID =   (isset($cur)) ? $cur->INST_ID : 'INST_ID' ; 
      } 
}
	  ?>
<div class="row">

   	<div class="col-lg-12">
   		<?php
		check_message();
		?>
<form class="form-horizontal well span4" action="controller.php?action=updatetime&classid=<?php echo $_GET['classid'];?>" method="POST">

          <fieldset>
            <legend>Update Time</legend>
                              

              <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "subjcode">Subject Code</label>

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

              <!--     <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "unit">No of units</label>

                      <div class="col-md-8">-->
                         <input class="form-control input-sm" id="unit" name="unit" readonly placeholder=
                            "No of units" type="hidden" value="<?php echo (isset($cur)) ? $cur->UNIT  : 'UNIT';?>">
                   <!--   </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "pre">Prerequisite</label>

                      <div class="col-md-8">-->
                         <input class="form-control input-sm" id="pre" name="pre" readonly placeholder=
                            "Prerequisite" type="hidden" value="<?php (isset($cur)) ? $cur->PRE_REQUISITE  : 'PRE_REQUISITE';?>">
                  <!--    </div>
                    </div>
                  </div>-->
                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "course">Grade Level</label>

                      <div class="col-md-8">
                      <input class="form-control input-sm" id="course_name" name="course_name" readonly placeholder=
                            "Prerequisite" type="text" value="<?php echo (isset($cur)) ? $cur->COURSE_NAME : 'Course' ;?>">
                           
                    
                 
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "ay">Academic Year</label>

                      <div class="col-md-8">
                        <input class="form-control input-sm" id="sy" name="sy" readonly placeholder=
                            "Prerequisite" type="text" value="<?php echo (isset($cur)) ? $cur->AY : 'Course';?>">
                      </div>
                    </div>
                  </div>
            <!--  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Semester">Semester</label>

                      <div class="col-md-8">-->
                          <input class="form-control input-sm" id="semester" name="semester" readonly placeholder=
                            "Prerequisite" type="hidden" value="<?php echo (isset($cur)) ? $cur->SEMESTER : 'Semester' ;?>">
                  <!--    </div>
                    </div>
                  </div>-->
              <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "ay">Days</label>

                      <div class="col-md-8">
                        <select class="form-control input-sm"   name="day" id="day">
                  <option value="MWF">MWF</option>
                  <option value="TTH">TTH</option>
                  <option value="S">S</option>
                </select> 
                      </div>
                    </div>
                  </div>

                     <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "ay">Time</label>
                      <div class="col-md-8">
                        <select class="form-control input-sm"  name="time" id="time">
                  <option value="7:30-8:30">7:30-8:30</option>
                  <option value="8:30-9:30">8:30-9:30</option>
                  <option value="9:30-10:30">9:30-10:30</option>
                  <option value="10:30-11:30">10:30-11:30</option>
                  <option value="11:30-12:30">11:30-12:30</option>
                  <option value="12:30-1:30">12:30-1:30</option>
                  <option value="1:30-2:30">1:30-2:30</option>
                  <option value="2:30-3:30">2:30-3:30</option>
                  <option value="3:30-4:30">3:30-4:30</option>
                  <option value="4:30-5:30">4:30-5:30</option>
                  <option value="5:30-6:30">5:30-6:30</option>
                  
                </select> 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "rmname">Room</label>

                      <div class="col-md-8">
                        <select class="form-control input-sm"   name="rmname" id="rmname">
                          <?php
                               $room = new Room();
                              $cur = $room->listOfroom();
                    foreach ($cur as $Room) {
                               
                                  echo '<option value='. $Room->ROOM_NAME .'>'.$Room->ROOM_NAME.'</OPTION>';
                                }

                                ?>
                
                </select> 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "section">Section</label>

                      <div class="col-md-8">
                        <input type="text" name="section" id="section" class="form-control input-sm" Placeholder="Section">
                      </div>
                    </div>
                  </div>
               
             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                        <button class="btn btn-primary" name="savetime" type="submit" >Save</button>
                      </div>
                    </div>
                  </div>              
          </fieldset> 

                  
        </form>   	
</div><!--End of container-->

   	</div>
    	<!-- /.col-lg-12 -->
</div>
