                      <?php 
                        if (!isset($_SESSION['ACCOUNT_ID'])){
                         redirect(web_root."admin/index.php");
                         }

                 
                       ?> 
	<?php
         $instid = $_GET['id'];
		  $singleinstructor = new Instructor();
		  $object = $singleinstructor->single_instructor($instid);
      
      ?>

 
 <form class="form-horizontal" action="controller.php?action=Assign" method="POST">       
   <div class="col-sm-12">

      <div class="col-sm-12 "> 
        
        <div class="col-sm-5 "> 
        <fieldset>
          <legend>Faculty Details</legend>  
     
             <div class="form-group">
                <div class="col-sm-12">
                  <label class="col-sm-4 control-label" for=
                  "IDNO">ID Number:</label>

                  <div class="col-sm-8">
                  <input type="text" hidden name="selector" value="">
                   <input class="form-control input-sm" id="idno" readonly name="idno" placeholder=
                        "Employee ID Number" type="text" value="<?php echo $object->IDNO;?>">
                  </div>
                </div>
              </div>
                <div class="form-group">
                 <div class="col-sm-12">
                  <label class="col-sm-4 control-label" for=
                  "name">Fullname:</label>

                  <div class="col-sm-8">
                   
                     <input class="form-control input-sm" id="name" readonly name="Iname" placeholder=
                        "Account Name" type="text" value="<?php echo $object->INST_FULLNAME;?>">
                  </div>
                </div>
              </div>
          
                  <div class="form-group">
                    <div class="col-sm-12">
                      <label class="col-sm-4 control-label" for=
                      "ay">Academic Year:</label>

                      <div class="col-sm-8">
                       
                      <input class="form-control input-sm" id="ay" readonly name="ay" placeholder=
                        "Account Name" type="text" value="<?php echo $_SESSION['AY'];?>">
                      </div>
                    </div>
                  </div>  
                 
                  <div class="form-group">
                    <div class="col-sm-12">
                      <label class="col-sm-4 control-label" for=
                      "SEMESTER">SEMESTER:</label>

                      <div class="col-sm-8">
                        
                      <input class="form-control input-sm" id="SEMESTER" readonly name="SEMESTER" placeholder=
                        "Account Name" type="text" value="<?php echo $_SESSION['SEMESTER'];?>">
                      </div>
                    </div>
                  </div>   
                   
                  
               </fieldset>
          
   
      </div>

      <div class="col-sm-7">
              <div class="table-responsive">   
                <table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
                
                  <thead>
                    <tr>
                      <th  width="20%" class="bottom"> <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">Code</th>
                      <th>Description</th>
                       <th>Unit</th>
                      <th>Course\Year</th>
                       <th>Semester</th>
                   
                 
                    </tr> 
                  </thead> 
                  <tbody>
                  
                    <?php 
                 
                      global $mydb; 
                      $mydb->setQuery("SELECT  * 
                        FROM  `subject` s,  `course` c
                      WHERE s.`COURSE_ID`= c.`COURSE_ID` AND s.`SUBJ_ID` NOT IN (SELECT  `SUBJ_ID` 
                        FROM  `class`)");
                      $SUBJ = $mydb->loadResultList();

                    foreach ($SUBJ as $result) {
                      echo '<tr>';
                     
                      echo '<td><input type="checkbox" name="selector[]" id="selector[]" value="'.$result->SUBJ_ID. '"/>' . $result->SUBJ_CODE.'</a></td>';

                      
                      echo '<td>'. $result->SUBJ_DESCRIPTION.'</td>';
                      echo '<td>'. $result->UNIT.'</td>';
                       echo '<td>'. $result->COURSE_NAME.'-'.$result->COURSE_LEVEL.'</td>';
                          echo '<td>'. $result->SEMESTER.'</td>';
                      echo '</tr>';
                    } 
                    ?>
                  </tbody>
                  
                </table>
             </div>

          <div class="btn-group">
      
                <button type="submit" class="btn btn-default" name="Assign"  ><span class="glyphicon glyphicon-bookmark"></span> Assign Subjects</button>';
                       
        </div>
         
      </div>
    </div>
   </div>
       
</form>
