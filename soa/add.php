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
    <a class="navbar-brand" href="#">Create Statement of Account:</a>
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

 <form class="form-horizontal" action="controller.php?action=assign&id=<?php echo $_GET['id'];?>&ay=<?php echo $_GET['ay'];?>&sem=<?php echo $_GET['sem'];?>" method="POST">       
   <div class="col-sm-12">

      <div class="col-sm-12 "> 
        
        <div class="col-sm-4 "> 

            <div class="form-group">
                    <div class="col-sm-12">
                       <label class="col-sm-5 control-label" for=
                      "Idnum">ID Number:</label>

                      <div class="col-sm-7">
                         <input type="text" hidden name="selector" value="">
                        <input name="syid" type="hidden" value="<?php echo $syid; ?>">
                         <input class="form-control input-sm" id="Idnum" readonly name="Idnum" placeholder=
                            "ID Number" type="text" value="<?php echo (isset($cur)) ? $cur->IDNO : 'IDNO' ;?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <label class="col-sm-5 control-label" for=
                      "studname">Student Name:</label>

                      <div class="col-sm-7">
                        <input class="form-control input-sm" id="studname" readonly name="studname" placeholder=
                            "Student Name" type="text" value="<?php echo (isset($cur)) ? $cur->STUDENTNAME : 'Fullname' ;?>">
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-sm-12">
                      <label class="col-md-5 control-label" for=
                      "Status">Status : </label>

                      <div class="col-sm-7">
                      <input class="form-control input-sm" id="studname" readonly name="Status" placeholder=
                            "Student Name" type="text" value="<?php echo (isset($cur)) ? $cur->STATUS : 'Status' ;?>">
                         
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <label class="col-sm-5 control-label" for=
                      "grdlvl">Course/Yr :</label>
                    <input name="courseid" type="hidden" value="<?php echo $cur->COURSE_ID; ?>">
                      <div class="col-sm-7">
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
                      <label class="col-sm-5 control-label" for=
                      "section">Semester : </label>

                      <div class="col-sm-7">
                      <input class="form-control input-sm" id="section" readonly name="sem" placeholder=
                            "Semester" type="text" value="<?php echo (isset($cur)) ? $cur->SEMESTER : 'SEMESTER' ;?>">
                            
                      
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <label class="col-sm-5 control-label" for=
                      "ay">A.Y :</label>

                      <div class="col-sm-7">
                        <input class="form-control input-sm" id="ay" readonly name="ay" placeholder=
                            "Academic Year" type="text" value="<?php echo (isset($cur)) ? $cur->AY : 'AY' ;?>">
                      
                      </div>
                    </div>
                  </div>   
            
          
   
      </div>

      <div class="col-md-8">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home">Student Charges</a></li>
     <!--      <li><a data-toggle="tab" href="#tuition">Tuition and Laboratories</a></li> -->
     <!--      <li><a data-toggle="tab" href="#menu1">List of all charges</a></li> -->
     <!--      <li><a data-toggle="tab" href="#menu2">List of Charges By Group</a></li> -->
     
        </ul> 
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Students Payables</h3>
       <div class="panel panel-success">
          
             <div class="panel-body"> 
              <table id="examples" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
        
              <thead>
                <tr>

                  <th>PARTICULARS</th>
               <!--   <th>AY</th>   
                  <th>SEMESTER</th>
                  --><th>AMOUNT</th>
                
                   <?php 
                  // `DEFID`, `COURSE_ID`, `COURSENAME`, `AY`, `SEMESTER`, `PARTICULARS`, `AMOUNT`
                  $mydb->setQuery("SELECT * FROM `tblstudpayables` WHERE `IDNO`='{$cur->IDNO}'");
                  $payrowcount = $mydb->num_rows();
                  if ($payrowcount > 0){
                  $soa = $mydb->loadResultList();
                  $totalpayables = 0;
                foreach ($soa as $soaresult) {
                  echo '<tr>';
                  // echo '<td width="5%" align="center"></td>';
                   echo '<td>' . $soaresult->PARTICULARS.'</a></td>';
                //  echo '<td>' . $soaresult->AY.'</a></td>';
                //  echo '<td>'. $soaresult->SEMESTER.'</td>';
                  echo '<td>'. $soaresult->AMOUNT.'</td>';
                  echo '</tr>';
                  $totalpayables = $totalpayables + $soaresult->AMOUNT;
                }
                echo '</tbody>';   
             echo '<tfoot>
           <tr>
              <td align="right" ><h5>Total Payables</h5></td><th><h5><input type="hidden" name="totalpayables" value="'. $totalpayables .'" >'. $totalpayables .'</h5></th>    
           </tr>
           <tr>
           <td colspan="2"><button type="submit" class="btn btn-primary" name="scedCharges"  ><span class="glyphicon glyphicon-calc"></span>Compute Schedule of Charges</button>
           </td>
           </tr>
         </tfoot>';      
                } else{
                  echo '<tr>
              <td>Total Payables<td>0.00</td></td>    
           </tr>'   ;      
                }

                  
            ?>

        </table>
            </div>
        </div>
    </div>
    <div id="tuition" class="tab-pane fade in">
      <h3>Tuition and Laboratories</h3>
       <div class="panel panel-success">
          
             <div class="panel-body"> 
              <table id="examples" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
        
              <thead>
                <tr>

                  <th>No. of Unit(s)</th>
                  <th>Per Unit</th>  
                  <th>Total</th>
                 
                   <?php 
                  // `ASSESSID`, `NOOFUNIT`, `PERUNIT`, `NOOFLAB`, `AMOUNTPERLAB`, `TOTALAMOUNT`, `IDNO`, `AY`, `SEMESTER`
         /*         $mydb->setQuery("SELECT * FROM `tblassessment` WHERE `IDNO`={$_GET['id']} AND AY= '{$_GET['ay']}' and SEMESTER='{$_GET['sem']}'");
         */          $mydb->setQuery("SELECT * FROM `tblassessment` WHERE `IDNO` NOT IN(SELECT `IDNO` tblstudpayables WHERE AY= '{$_GET['ay']}' and SEMESTER='{$_GET['sem']}' AND `IDNO`={$_GET['id']})");

                   $Tuirowcount = $mydb->num_rows();
                  if ($Tuirowcount > 0){

                  $Tui = $mydb->loadResultList();

                foreach ($Tui as $Tresult) {
                  echo '<tr>';
                  // echo '<td width="5%" align="center"></td>';
                   echo '<td>' . $Tresult->NOOFUNIT.'</a></td>';
                  echo '<td>' . $Tresult->PERUNIT.'</a></td>';
                   echo '<td>'. $Tresult->TOTALAMOUNT.'</td>';
                  echo '</tr>';
                } 
                 echo '</tbody>';   
             echo '<tfoot>
           <tr>
              <td colspan="8"> <button type="submit" class="btn btn-primary" name="addtuition"  ><span class="glyphicon glyphicon-bookmark"></span> Add Tuition</button></td>    
           </tr>
         </tfoot>';      
                } else{
                  echo '<tr><td colspan="8" align="center">No Results found!</td></tr>'   ;      
                }

                  
            ?>

        </table>

                
             
            </div>
        </div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>List of Charges for all</h3>
    
        <div class="panel panel-success">
          
       
             <div class="panel-body"> 
              <table id="examples" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
        
          <thead>
            <tr>

              <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">
              PARTICULARS</th>
         <!--     <th>AY</th>
              <th>SEMESTER</th>
             --> <th>AMOUNT</th>

            </tr> 
          </thead> 
          <tbody>
               <?php 
               global $mydb;
              // `DEFID`, `COURSE_ID`, `COURSENAME`, `AY`, `SEMESTER`, `PARTICULARS`, `AMOUNT`
              $mydb->setQuery("SELECT * FROM `tbldefaultcharges` WHERE `COURSE_ID`=0 AND DEFID NOT IN(SELECT `PAYABLESID` FROM `tblstudpayables` WHERE `IDNO`={$_GET['id']} AND AY= '{$_GET['ay']}' and SEMESTER='{$_GET['sem']}')");

               $DEFCHARGErowcount = $mydb->num_rows();
              if ($DEFCHARGErowcount > 0){

                  $curs = $mydb->loadResultList();

                   foreach ($curs as $results) {
                      echo '<tr>';
                      // echo '<td width="5%" align="center"></td>';
                      echo '<td><input type="checkbox" name="selector[]" id="selector[]"  value="' .  $results->DEFID.'"/>'. $results->PARTICULARS.'</a></td>';
                //      echo '<td>' . $results->AY.'</a></td>';
                //      echo '<td>'. $results->SEMESTER.'</td>';
                      echo '<td>'. $results->AMOUNT.'</td>';
                      echo '</tr>';
                    } 
             echo '</tbody>';   
             echo '<tfoot>
           <tr>
              <td colspan="4"> <button type="submit" class="btn btn-primary" name="assignall"  ><span class="glyphicon glyphicon-bookmark"></span> Assign Item(s)</button></td>    
           </tr>
         </tfoot>';      
                } else{
                  echo '<tr><td colspan="4" align="center">No Results found!</td></tr>'   ;      
                }

                  
            ?>

        </table>

       
            </div>
        </div>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>List of Charges By Group</h3>
      
        <div class="panel panel-success">
          
            
             <div class="panel-body"> 
               <table id="examples" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
        
              <thead>
                <tr>

                  <th>PARTICULARS</th>
                <!--  <th>AY</th>
                  <th>SEMESTER</th>
                  --><th>AMOUNT</th>
                   <?php 
                   //
                  // `DEFID`, `COURSE_ID`, `COURSENAME`, `AY`, `SEMESTER`, `PARTICULARS`, `AMOUNT`
                  $mydb->setQuery("SELECT * FROM `tbldefaultcharges` WHERE `COURSE_ID`='{$cur->COURSE_ID}' AND DEFID NOT IN(SELECT `PAYABLESID` FROM `tblstudpayables` WHERE `IDNO`='{$_GET['id']}' AND AY= '{$_GET['ay']}' and SEMESTER='{$_GET['sem']}')");
                  $grouprowcount = $mydb->num_rows();
                  if ($grouprowcount > 0){

                        $cur = $mydb->loadResultList();

                        foreach ($cur as $result) {
                          echo '<tr>';
                          // echo '<td width="5%" align="center"></td>';
                          echo '<td>'. $result->PARTICULARS.'</a></td>';
                     //     echo '<td>' . $result->AY.'</a></td>';
                     //     echo '<td>'. $result->SEMESTER.'</td>';
                          echo '<td>'. $result->AMOUNT.'</td>';
                                      
                          echo '</tr>';
                        } 
                   echo '</tbody>';   
             echo '<tfoot>
           <tr>
              <td colspan="4"> <button type="submit" class="btn btn-primary" name="assigGroup"  ><span class="glyphicon glyphicon-bookmark"></span> Assign Item(s)</button></td>    
           </tr>
         </tfoot>';      
                } else{
                  echo '<tr><td colspan="4" align="center">No Results found!</td></tr>'   ;      
                }

                  
            ?>

        </table>

            </div>
        </div>
    </div>
   
  </div>

 <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#sced">Schedule of Charges</a></li>
          <li><a data-toggle="tab" href="#history">Payment History</a></li>
        
     
        </ul> 
<div class="tab-content">
    <div id="sced" class="tab-pane fade in active">

    <div class="panel panel-success">
      <h2>Schedule of Charges</h2>        
             <div class="panel-body"> 
              <table id="examples" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
        
              <thead>
                <tr>

                  <th>TERM</th>
                  <th>DUEDATE</th>   
                  <th>AMOUNTDUE</th>
                  <th>PAID</th>
                  <th>Remaining BAL.</th>
                    <th>Overall BAL.</th>
              
                  
                   <?php 
                  // `DEFID`, `COURSE_ID`, `COURSENAME`, `AY`, `SEMESTER`, `PARTICULARS`, `AMOUNT`
                  $mydb->setQuery("SELECT * FROM `tblschedcharges` WHERE `IDNO`='{$_GET['id']}' AND AY= '{$_GET['ay']}' and SEM='{$_GET['sem']}'");
                  $srowcount = $mydb->num_rows();
                  if ($srowcount > 0){
                  $sCEDC = $mydb->loadResultList();
                 
                foreach ($sCEDC as $Sresult) {
                  echo '<tr>';
                  // echo '<td width="5%" align="center"></td>';
                  echo '<td>' . $Sresult->TERM.'</a></td>';
                  echo '<td>' . $Sresult->DUEDATE.'</a></td>';
                  echo '<td>'.round($Sresult->AMOUNTDUE, 2).'</td>';
                  echo '<td>'. round($Sresult->PAID,2).'</td>';
                     echo '<td>'. round($Sresult->BALANCE,2).'</td>';
                      echo '<td>'. round($Sresult->OVERALLBAL,2).'</td>';
                  echo '</tr>';
              
                }
                echo '</tbody>';   
                } else{
                  echo '<tr>
                          <td colspan="5" align="center">No Results found!</td>    
                       </tr>'   ;      
                }

                  
            ?>

        </table>
            </div>
        </div>
</div>

<div id="history" class="tab-pane fade in active">

    <div class="panel panel-success">
      <h2>Payment History</h2>        
             <div class="panel-body"> 
              <table id="examples" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
        
              <thead>
                <tr>

                  <th>OR NO.</th>
                  <th>DATE PAY</th>   
                  <th>AMOUNT PAY</th>
                  <th>BALANCE</th>
                  <th>CASHIER</th>
              
                  
                   <?php 
                  // `CASHID`, `ORNO`, `STUDENTID`, `STUDENTNAME`, `AY`, `SEM`, `DATEPAY`, `AMOUNTPAY`, `AMOUNTBAL`, `CASHIER`
                  $mydb->setQuery("SELECT * FROM `tblcashier` WHERE `STUDENTID`='{$_GET['id']}'");
                  $srowcount = $mydb->num_rows();
                  if ($srowcount > 0){
                  $sCEDC = $mydb->loadResultList();
                 
                foreach ($sCEDC as $Sresult) {
                  echo '<tr>';
                  // echo '<td width="5%" align="center"></td>';
                  echo '<td>' . $Sresult->ORNO.'</a></td>';
                  echo '<td>' . $Sresult->DATEPAY.'</a></td>';
                  echo '<td>'. $Sresult->AMOUNTPAY.'</td>';
                  echo '<td>'. $Sresult->AMOUNTBAL.'</td>';
                     echo '<td>'. $Sresult->CASHIER.'</td>';
                  echo '</tr>';
              
                }
                echo '</tbody>';   
                } else{
                  echo '<tr>
                          <td colspan="5" align="center">No Results found!</td>    
                       </tr>'   ;      
                }

                  
            ?>

        </table>
            </div>
        </div>
</div>
    </div>
       

      </div>
      </div>    
    </div>
   </div>
       
</form>