<?php 
  if (!isset($_SESSION['ACCOUNT_ID'])){
   redirect(web_root."admin/index.php");
   }

   $id = $_GET['id'];
 //  $mydb->setQuery("SELECT `SYID`, `AY`, `SEMESTER`, schoolyr.`COURSE_ID`, `IDNO`, `CATEGORY`, `DATE_RESERVED`, `DATE_ENROLLED`, `STATUS`, `STUDENTNAME`,CONCAT(`COURSE_NAME`,'- ', `COURSE_LEVEL`) as 'COURSENAME' FROM `schoolyr` LEFT JOIN course ON schoolyr.COURSE_ID = course.COURSE_ID and IDNO='{$syid}' LIMIT 1");
 //  $cur = $mydb->loadsingleResult();
    $sy = new Schoolyr();
    $cur = $sy->single_sy($id);

?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#examples').DataTable( {
      paging:         false
    } );
} );
</script>
 <nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"> Student Assigning of Subjects:</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><?php
       $created =  strftime("%Y-%m-%d %H:%M:%S", time()); 


      echo date_toText($created); ?></a></li>
      <li class="dropdown">
       
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
 <form class="form-horizontal" action="controller.php?action=Assign" method="POST">       
   <div class="col-sm-12">

      <div class="col-sm-12 "> 
        
        <div class="col-sm-4 "> 

            <div class="form-group">
                    <div class="col-sm-12">
                       <label class="col-sm-4 control-label" for=
                      "Idnum">ID Number:</label>

                      <div class="col-sm-8">
                         <input type="text" hidden name="selector" value="">
                        <input name="syid" type="hidden" value="<?php echo $SYID; ?>">
                         <input class="form-control input-sm" id="Idnum" readonly name="Idnum" placeholder=
                            "ID Number" type="text" value="<?php echo (isset($cur)) ? $cur->IDNO : 'IDNO' ;?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <label class="col-sm-4 control-label" for=
                      "studname">Student Name:</label>

                      <div class="col-sm-8">
                        <input class="form-control input-sm" id="studname" readonly name="studname" placeholder=
                            "Student Name" type="text" value="<?php echo (isset($cur)) ? $cur->STUDENTNAME : 'Fullname' ;?>">
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-sm-12">
                      <label class="col-md-4 control-label" for=
                      "Status">Status : </label>

                      <div class="col-sm-8">
                      <input class="form-control input-sm" id="studname" readonly name="Status" placeholder=
                            "Student Name" type="text" value="<?php echo (isset($cur)) ? $cur->STATUS : 'Status' ;?>">
                         
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <label class="col-sm-4 control-label" for=
                      "grdlvl">Course/Yr :</label>

                      <div class="col-sm-8">
                        <?php
                        $course = new Course();
                        $object = $course->single_course($cur->COURSE_ID);
                        ECHO '<input class="form-control input-sm" id="studname" readonly name="grdlvl" placeholder=
                                                    "Student Name" type="text" value="'. $object->COURSE_NAME .'- '. $object->COURSE_LEVEL .'">';
                        ?>

                        
                         
                      </div>
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <div class="col-sm-12">
                      <label class="col-sm-4 control-label" for=
                      "section">Semester : </label>

                      <div class="col-sm-8">
                      <input class="form-control input-sm" id="section" readonly name="SEMESTER" placeholder=
                            "Semester" type="text" value="<?php echo (isset($cur)) ? $cur->SEMESTER : 'SEMESTER' ;?>">
                         
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <label class="col-sm-4 control-label" for=
                      "ay">A.Y :</label>

                      <div class="col-sm-8">
                        <input class="form-control input-sm" id="ay" readonly name="ay" placeholder=
                            "Academic Year" type="text" value="<?php echo (isset($cur)) ? $cur->AY : 'AY' ;?>">
                      
                      </div>
                    </div>
                  </div>   
            
          
   
      </div>

      <div class="col-md-8">
               <div class="table-responsive">     
                <table id="examples" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
                
                  <thead>
                    <tr>
                      <th>
                         <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> 
                      ID</th>
                      <th>Code</th>
                      <th>Description</th>
                      <th>Level</th>
                       <th>Semester</th>
                   
                 
                    </tr> 
                  </thead> 
                  <tbody>
                  
                    <?php 
                    global $mydb;
                      // `SUBJ_ID`, `SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`, `COURSE_ID`, `AY`, `SEMESTER`
                      $mydb->setQuery("SELECT * 
                              FROM  `subject` where COURSE_ID='". $cur->COURSE_ID."' AND SEMESTER='{$cur->SEMESTER}' AND SUBJ_ID NOT IN(SELECT `SUBJ_ID`FROM `grades` WHERE `IDNO`='{$_GET['id']}' AND `AY`='{$_SESSION['AY']}' AND `SEMESTER`='{$_SESSION['SEMESTER']}')");
                      $rowcount = $mydb->num_rows();
                    //  echo $rowcount;
                      if ($rowcount == 0){
                          echo '<tr>';
                          echo '<td colspan=4 align="center"> All Subjects has been assigned!</td>';
                          echo '</tr>';
                      }else{
                        $SUBJ = $mydb->loadResultList();

                        foreach ($SUBJ as $result) {
                          echo '<tr>';
                          // echo '<td width="5%" align="center"></td>';
                          echo '<td><input type="checkbox" name="selector[]" id="selector[]"  value="' . $result->SUBJ_ID.'"/>' . $result->SUBJ_ID.'</a></td>';
                          echo '<td>' . $result->SUBJ_CODE.'</a></td>';
                          echo '<td>'. $result->SUBJ_DESCRIPTION.'</td>';
                          echo '<td>'. $result->UNIT.'</td>';
                           echo '<td>'. $result->SEMESTER.'</td>';
                          echo '</tr>';
                        } 
                      }
                      
                    ?>
                  </tbody>
                  
                </table>
       </div>
        <div class="btn-group">
      <?php
     /*     $mydb->setQuery("SELECT * FROM `grades` WHERE GRADELEVEL = '". $cur->GRADELEVEL."' AND `IDNO`= '". $cur->IDNO."' AND `AY`= '". $cur->AY."' AND `SECTION` = '". $cur->SECTION."'");
              $intres = $mydb->executeQuery();
              $row_count = $mydb->num_rows($intres);
              if ($row_count > 0){
                echo '<button type="submit" class="btn btn-default" name="Assign" disabled ><span class="glyphicon glyphicon-bookmark"></span> Assign Subjects</button>';
              }else{*/
                 echo '<button type="submit" class="btn btn-default" name="Assign"  ><span class="glyphicon glyphicon-bookmark"></span> Assign Subjects</button>';
            /*  }
*/
            
              ?>
        
          
        </div>
         
      </div>
    </div>
   </div>
       
</form>