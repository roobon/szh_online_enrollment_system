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

global $mydb;
                $mydb->setQuery("SELECT * FROM `tblcashier` WHERE CASHID=". $_GET['lastid']);
              $cur = $mydb->loadSingleResult();
     ?>
      
        
    
          <div class="row">

            <div class="col-lg-5">
                 <div class="panel panel-success">
              <form class="form-horizontal span4" action="" method="POST">
                <table class="tables" align="center" border="0">  
                  
                  <tbody>           
                    <tr>
                      <td colspan="3" align="center"><b>Ramon Magsaysay Memorial Colleges</b></td>
                    </tr>
                    <tr>
                      <td colspan="3" align="center">AY: <?php echo (isset($cur)) ? $cur->AY : 'AY' ;?> , Semester: <?php echo (isset($cur)) ? $cur->SEM : 'SEMESTER' ;?></td>

                    </tr>
                    <tr>
                      <td colspan="3" align="Right"><b>OR:<?php echo (isset($cur)) ? $cur->ORNO : 'ORNO' ;?></b></td>
                    </tr>
                    <tr>
                      <td><U><B>Student Name:</B><?php echo (isset($cur)) ? $cur->STUDENTNAME : 'STUDENT NAME' ;?></U></td><td><U>Date: <?php echo (isset($cur)) ? $cur->DATEPAY : 'DATEPAY' ;?></U></td><td></td>
                    </tr>
                    <tr>
                      <?php 
                         if (isset($cur)) {
                       $pay =round($cur->AMOUNTPAY, 2) ;

                         }else{   
                       $bal = 'AMOUNTPAY' ;
                       }
                         ?>
                      <td colspan="2"><B>Tuition:</B></td><td><?php echo $pay;?></td>
                    </tr>
                    <tr>
                       <?php 
                         if (isset($cur)) {
                       $pay =round($cur->AMOUNTPAY, 2) ;

                         }else{   
                       $bal = 'AMOUNTPAY' ;
                       }
                         ?>
                      <td></td><td>Total Pay:</td><td><?php echo $pay;?></td>

                    </tr>
                    <tr>
                      <?php 
                         if (isset($cur)) {
                       $bal =round($cur->AMOUNTBAL, 2) ;

                         }else{   
                       $bal = 'AMOUNTBAL' ;
                       }
                         ?>
                      <td></td><td>Balance:</td><td><?php echo $bal; ?></td>
                    </tr>
                    <tr>
                       <td></td><td></td><td></td>
                    </tr>
                    <tr>
                      <td colspan="3">Cashier:<?php echo (isset($cur)) ? $cur->CASHIER : 'CASHIER' ;?>
                    </tr>
                  </tbody>
                </table>
            </form>
            </div>
          </div>
             </DIV>
      

    
      </div>  
    </div>
      <!-- /.col-lg-12 -->
</div>
