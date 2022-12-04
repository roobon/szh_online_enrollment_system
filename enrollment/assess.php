                      <?php 
                        if (!isset($_SESSION['ACCOUNT_ID'])){
                         redirect(web_root."admin/index.php");
                         }

                 
                       ?> 
<?php
     $syid = $_GET['id'];
      $sy = new Schoolyr();
      $cur = $sy->single_sy($syid);

      $syid = $_GET['id'];
      $ass = new Assessment();
      $assresult = $ass->single_assessment($syid);
      
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
    <a class="navbar-brand" href="#">Subjects Assessment:</a>
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
 <form class="form-horizontal" action="controller.php?action=Assess" method="POST">       
   <div class="col-sm-12">

      <div class="col-sm-12 "> 
        
        <div class="col-sm-4 "> 

            <div class="form-group">
                    <div class="col-sm-12">
                       <label class="col-sm-4 control-label" for=
                      "Idnum">ID Number:</label>

                      <div class="col-sm-8">
                         <input type="text" hidden name="selector" value="">
                        <input name="syid" type="hidden" value="<?php echo $syid; ?>">
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
    <input name="courseid" type="hidden" value="<?php echo $cur->COURSE_ID; ?>">   
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
                      <input class="form-control input-sm" id="section" readonly name="sem" placeholder=
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
              <th>ID</th>
              <th>Description</th>
            <th width="10%" align="center" class="bottom">Unit</th>
           
         
            </tr> 
          </thead> 
          <tbody>
          
            <?php 
            global $mydb;
              // $mydb->setQuery("SELECT * 
                //      FROM  `tblusers` WHERE TYPE != 'Customer'");
            /*  $mydb->setQuery("SELECT g.`SUBJ_ID`, g.`DESCRIPTION`, `INSTNAME` FROM `grades` g  LEFT JOIN `instructorssubjects` i ON g.`AY`=i.`AY` and g.`SEMESTER`=i.`SEMESTER` AND g.SUBJ_ID=i.SUBJ_ID WHERE IDNO ='{$cur->IDNO}' AND g.`AY`='{$_SESSION['AY']}' AND g.`SEMESTER`='{$_SESSION['SEMESTER']}' GROUP BY g.`SUBJ_ID` ");
*/
            $totunit = 0;
            $mydb->setQuery("SELECT * 
                      FROM  `subject` s
                      WHERE SUBJ_ID IN (SELECT SUBJ_ID FROM `grades` WHERE `AY`='{$cur->AY}' and `SEMESTER`='{$cur->SEMESTER}' AND IDNO='{$cur->IDNO}') ");
                $rowcount = $mydb->num_rows();
                   //   echo $rowcount;
                      if ($rowcount == 0){
                          echo '<tr>';
                          echo '<td colspan=3 align="center"> No Subjects has been assigned!</td>';
                          echo '</tr>';
                      }else{
                          $cur = $mydb->loadResultList();
                          foreach ($cur as $result) {
                            echo '<tr>';
                            // echo '<td width="5%" align="center"></td>';
                            echo '<td>' . $result->SUBJ_ID.'</td>';
                            echo '<td>' . $result->SUBJ_DESCRIPTION.'</td>';
                            echo '<td>' . $result->UNIT.'</td>';
                            echo '</tr>';
                            $totunit =$totunit + $result->UNIT; 
                          } 
                          echo '
                            <tr>
                            <input type="hidden" name="noofunits" value='. $totunit . '>
                              <td colspan="2">Total Unit</td><td >'. $totunit.'  </td>
                            </tr>';
                      }
            ?>
          </tbody>
         
        
        </table>
                 
                  
   <button type="submit" class="btn btn-default" name="Assign"  ><span class="glyphicon glyphicon-bookmark"></span> Asssess Subjects</button>
      
 
      </div>

       
         
      </div>
    </div>
   </div>
       
</form>