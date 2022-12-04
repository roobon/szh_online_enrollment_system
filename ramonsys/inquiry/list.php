                      <?php 
                        if (!isset($_SESSION['ACCOUNT_ID'])){
                         redirect(web_root."admin/index.php");
                         }

                 
                       ?> 
<?php
        if (isset($_POST['search'])){
        if ($_POST['txtsearch']==""){
          message("ID Number is required!","error");
          
        }else{
          $mydb->setQuery("SELECT * FROM `tblstudent` WHERE `IDNO`='{$_POST['txtsearch']}' AND IDNO IN (SELECT `IDNO` FROM `schoolyr` WHERE `SEMESTER`='{$_SESSION['SEMESTER']}' AND  `AY`='{$_SESSION['AY']}')");
          $rowcount = $mydb->num_rows();
         if ($rowcount==1){

          $student = new Student();
          $cur = $student->single_student($_POST['txtsearch']);

	         $shoy = new Schoolyr();
	          $SYCOUNT = $shoy->findsy($_POST['txtsearch']);
	         $SYCOUNT = $mydb->num_rows();
	         if ($SYCOUNT==1){
	         	 $mydb->setQuery("SELECT `SYID`, `AY`,`SEMESTER`, schoolyr.`COURSE_ID`, `IDNO`, `CATEGORY`, `DATE_RESERVED`, `DATE_ENROLLED`, `STATUS`, `STUDENTNAME`,CONCAT(`COURSE_NAME`,'- ', `COURSE_LEVEL`) as 'COURSENAME' FROM `schoolyr` LEFT JOIN course ON schoolyr.COURSE_ID = course.COURSE_ID WHERE `AY`='{$_SESSION['AY']}' AND SEMESTER='{$_SESSION['SEMESTER']}' AND IDNO={$_POST['txtsearch']}");
	         	 	$sy = $mydb->loadSingleResult();
	
	         }

         } else{
           message("ID Number not found!","error");
           redirect("index.php?view=list");
         }

       
        }
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
    <a class="navbar-brand" href="#"> Student ID Number:</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <form class="navbar-form navbar-left" id="lets_search" action="index.php?view=list" method="POST">
      <div class="form-group">
        <input type="text" name="txtsearch" id="txtsearch" class="form-control" placeholder="Search">
      </div>
       <button type="submit" name="search"class="btn btn-default">  <span class="glyphicon glyphicon-search"></span></button></span>
      
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><?php
       date_default_timezone_set('Asia/Manila'); 
        
     //   $date  = date("Y-m-d");
     //   $time = date(' g:i:a  ');
       $created =  strftime("%Y-%m-%d %H:%M:%S", time()); 


      echo date_toText($created); ?></a></li>
      <li class="dropdown">
       
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>

 <form class="form-horizontal span6" action="controller.php?action=add" method="POST">

<div class="panel panel-primary">
   			<div class="panel-heading">
			    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Student Information Inquiry </h3>
			  </div>
			  <div class="panel-body">

			  	<div class="row">
			  		<div class="col-lg-6">
			  			<H4>Student details</H4>
			  				<table class="table" align="center" >	 
				    			
								  <tbody>				    
							     	<tr>
							     		<td><strong>Student Name:</strong> <?php echo (isset($cur)) ? $cur->LNAME.', '.$cur->FNAME.', '.$cur->MNAME : 'Student name' ;?><br/>
							     		<?php
							     			if (isset($cur->SEX) == 'F'){
							     				echo '<strong>Gender:</strong>Female<br/>';

							     			}else{
							     				echo '<strong>Gender:</strong>Male<br/>';
							     			}

							     		?>
							     		
							     		<strong>Age:</strong> <?php echo (isset($cur)) ? $cur->AGE : 'AGE' ;?><br/>
							       		<strong>BIRTH DATE:</strong> <?php echo (isset($cur)) ? $cur->BDAY : 'BIRTH DATE' ;?><br/>
							     	<strong>STATUS:</strong> <?php echo (isset($cur)) ? $cur->STATUS : 'STATUS' ;?><br/>
							     	<strong>EMAIL:</strong> <?php echo (isset($cur)) ? $cur->EMAIL : 'EMAIL' ;?></td>
							     	 
							     	</tr>
						    	</tbody>
						    </table>
						
			  		</div>
			  		<div class="col-lg-6">
			  			<H4>Enrollment details</H4>
				    		<table class="table" align="center" >	 
				    			
								  <tbody>				    
							     	<tr>
							     		<td><strong>Course/Yr:</strong> <?php echo (isset($sy)) ? $sy->COURSENAME : 'COURSENAME' ;?><br/>
							     		<strong>Academic Year:</strong> <?php echo (isset($sy)) ? $sy->AY : 'AY' ;?><br/>
							       		<strong>Semester:</strong> <?php echo (isset($sy)) ? $sy->SEMESTER : 'SEMESTER' ;?><br/>
							     	<strong>Category:</strong> <?php echo (isset($sy)) ? $sy->CATEGORY : 'CATEGORY' ;?><br/>
							     	<strong>STATUS:</strong> <?php echo (isset($sy)) ? $cur->STATUS : 'STATUS' ;?></td>
							     	 
							     	</tr>
						    	</tbody>
						    </table>
						
			  		</div>
			  	</div>
			  		<div class="row">
				  		<div class="col-lg-12">
				  		<h3 align="left">Student Subject and Schedules</h3>
						   <form action="" Method="POST">  					
							<table id="example" class="table table-striped table-bordered table-hover table-responsive" cellspacing="0">
							
							  <thead>
							  	<tr id="table" >
							  		<tr>
							  		<th>No.</th>
							  	
							  		<th>Subject Description</th>
							  		<th>Day</th>
							  		<th>Time</th>
							  		<th>Room</th>
							  		<th>Section</th>		
							  		<th>Instructor</th>				  		
							  		
							  	</tr>	
							  </thead>
							  <tbody>
							  	<?php 

							  	global $mydb;
							
							  	if (isset($cur)){

							  

							  		$mydb->setQuery("SELECT g.`IDNO`, `STUDENTNAME`, `DESCRIPTION`,`DAY`, `C_TIME`, `ROOM`, c.`SECTION`,C.INST_NAME FROM  class c RIGHT JOIN grades g  ON g.SUBJ_ID=c.SUBJ_ID WHERE g.IDNO={$cur->IDNO}");
							  	
								  	$rowcountss = $mydb->num_rows();

							         if ($rowcountss > 0){

								  		$curS = $mydb->loadResultList();
									  		$i = 0;
											foreach ($curS as $student) {
									  		$i = $i + 1;
									  		echo '<tr>';

									  		echo '<td width="5%" align="center">'.$i .'</td>';
									  		echo '<td>'. $student->DESCRIPTION.'</td>';
									  		echo '<td>'. $student->DAY.'</td>';
									  		echo '<td>'. $student->C_TIME.'</td>';
									  		echo '<td>'. $student->ROOM.'</td>';
									  		echo '<td>'. $student->SECTION.'</td>';
									  		echo '<td>'. $student->INST_NAME.'</td>';
									  		echo '</tr>';
									  		}
								  	}else{
								  		echo '<tr>';
								  		echo '<td colspan="7">No subjects assigned!</td>';
								  		echo '</tr>';
								  	}

								  		
							  	}
							  	?>

			 
							  </tbody>
							 
							</table>
							<div class="btn-group">
							
							  <!--  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button> -->
							</div>
							</form>
				  		</div>
			  		</div>	
			  		<div class="row">
				  		<div class="col-lg-12">
				  		<h3 align="left">Student Subject and Grades</h3>
						   <form action="" Method="POST">  					
							<table id="example" class="table table-striped table-bordered table-hover table-responsive" cellspacing="0">
							
							  <thead>
							  	<tr id="table" >
							  		<tr>
							  		<th>No.</th>
							  		<th>Subject Description</th>
							  	
							  		<th>Prelim</th>
							  		<th>Midterm</th>
							  		<th>Final</th>		
							  		<th>Final Average</th>				  		
							  		<th>Remarks</th>				  		
							  		
							  	</tr>	
							  </thead>
							  <tbody>
							  	<?php 

							  	global $mydb;
							
							  	if (isset($cur)){

							  

							  		$mydb->setQuery("SELECT `IDNO`, `SUBJ_ID`, `DESCRIPTION`, `INST_ID`, `INST_NAME`, `PRE`, `MID`, `FIN`, `FIN_AVE`, `REMARKS` FROM `grades` WHERE IDNO={$cur->IDNO} AND `AY`='{$_SESSION['AY']}' AND SEMESTER='{$_SESSION['SEMESTER']}'");
							  	
								  	$GRADESCOUNT = $mydb->num_rows();

							         if ($GRADESCOUNT > 0){

								  		$curSSS = $mydb->loadResultList();
									  		$i = 0;
											foreach ($curSSS as $grade) {
									  		$i = $i + 1;
									  		echo '<tr>';

									  		echo '<td width="5%" align="center">'.$i .'</td>';
									  		echo '<td>'. $grade->DESCRIPTION.'</td>';
									  	//	echo '<td>'. $grade->INST_NAME.'</td>';
									  		echo '<td>'. $grade->PRE.'</td>';
									  		echo '<td>'. $grade->MID.'</td>';
									  		echo '<td>'. $grade->FIN.'</td>';
									  		echo '<td>'. $grade->FIN_AVE.'</td>';
									  		echo '<td>'. $grade->REMARKS.'</td>';
									  		echo '</tr>';
									  		}
								  	}else{
								  		echo '<tr>';
								  		echo '<td colspan="7">No subjects assigned!</td>';
								  		echo '</tr>';
								  	}

								  		
							  	}
							  	?>

			 
							  </tbody>
							 
							</table>
							<div class="btn-group">
							
							  <!--  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button> -->
							</div>
							</form>
				  		</div>
			  		</div>	
			  		<div class="row">
			  		
			  			<div class="col-lg-6">
				  			<h3 align="left">Student Statement of Account</h3>
						   <form action="" Method="POST">  					
							<table id="example" class="table table-striped table-bordered table-hover table-responsive" cellspacing="0">
							
							  <thead>
							  	<tr id="table" >
							  		<tr>
							  		<th>No.</th>
							  		<th>Particulars</th>
							  		<th>Amount</th>
							  				  		
							  		
							  	</tr>	
							  </thead>
							  <tbody>
							  	<?php 

							  	global $mydb;
							
							  	if (isset($cur)){

							  

							  		$mydb->setQuery("SELECT * FROM `tblstudpayables` WHERE IDNO={$cur->IDNO} AND `AY`='{$_SESSION['AY']}' AND SEMESTER='{$_SESSION['SEMESTER']}'");
							  	
								  	$payablescount = $mydb->num_rows();

							         if ($payablescount > 0){

								  		$curpay = $mydb->loadResultList();
									  		$i = 0;
											foreach ($curpay as $payable) {
									  		$i = $i + 1;
									  		echo '<tr>';

									  		echo '<td width="5%" align="center">'.$i .'</td>';
									  		echo '<td>'. $payable->PARTICULARS.'</td>';
									  		echo '<td>'. $payable->AMOUNT.'</td>';
									  		
									  		echo '</tr>';
									  		}
								  	}else{
								  		echo '<tr>';
								  		echo '<td colspan="3">No Payables has been assigned!</td>';
								  		echo '</tr>';
								  	}

								  		
							  	}
							  	?>

			 
							  </tbody>
							 
							</table>
							<div class="btn-group">
							
							  <!--  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button> -->
							</div>
							</form>
				  		</div>
				  		<h3 align="left">Schedule of Charges</h3>
				  		<div class="col-lg-6">
				  		
						   <form action="" Method="POST">  					
							<table id="example" class="table table-striped table-bordered table-hover table-responsive" cellspacing="0">
							
							  <thead>
							  	<tr id="table" >
							  		<tr>
							  		<th>No.</th>
							  		<th>Term</th>
							  		<th>Due Date</th>
							  		<th>Amount Due</th>
							  		<th>Paid</th>
							  		<th>Balance</th>		
							  			  		
							  		
							  	</tr>	
							  </thead>
							  <tbody>
							  	<?php 

							  	global $mydb;
							
							  	if (isset($cur)){

							  

							  	$mydb->setQuery("SELECT * FROM `tblschedcharges` WHERE IDNO={$cur->IDNO} AND `AY`='{$_SESSION['AY']}' AND SEM='{$_SESSION['SEMESTER']}'");
							  	
								  	$CHARGECOUNT = $mydb->num_rows();

							         if ($CHARGECOUNT > 0){

								  		$CHARre = $mydb->loadResultList();
									  		$i = 0;
											foreach ($CHARre as $Charges) {
									  		$i = $i + 1;
									  		echo '<tr>';

									  		echo '<td width="5%" align="center">'.$i .'</td>';
									  		echo '<td>'. $Charges->TERM.'</td>';
									  		echo '<td>'. $Charges->DUEDATE.'</td>';
									  		echo '<td>'. $Charges->AMOUNTDUE.'</td>';
									  		echo '<td>'. $Charges->PAID.'</td>';
									  		echo '<td>'. $Charges->BALANCE.'</td>';
									  		
									  		echo '</tr>';
									  		}
								  	}else{
								  		echo '<tr>';
								  		echo '<td colspan="6">No Schedule of Charges has been assigned!</td>';
								  		echo '</tr>';
								  	}

								  		
							  	}
							  	?>

			 
							  </tbody>
							 
							</table>
							<div class="btn-group">
							
							  <!--  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button> -->
							</div>
							</form>
				  		</div>
			  		</div>	
			  		<div class="row">
				  		<div class="col-lg-12">
				  		<h3 align="left">Payment History</h3>
						   <form action="" Method="POST">  					
							<table id="example" class="table table-striped table-bordered table-hover table-responsive" cellspacing="0">
							
							  <thead>
							  	<tr id="table" >
							  		<tr>
							  		<th>No.</th>
							  		<th>ORNO</th>
							  		<th>STUDENT NAME</th>
							  		<th>DATE PAY</th>
							  		<th>AMOUNTPAY</th>
							  		<th>AMOUNTBAL</th>		
							  		<th>CASHIER</th>				  		
							  			  		
							  		
							  	</tr>	
							  </thead>
							  <tbody>
							  	<?php 

							  	global $mydb;
							
							  	if (isset($cur)){

							  

							  		$mydb->setQuery("SELECT * FROM `tblcashier` WHERE STUDENTID={$cur->IDNO} AND `AY`='{$_SESSION['AY']}' AND SEM='{$_SESSION['SEMESTER']}'");
							  	
								  	$PAYCOUNT = $mydb->num_rows();

							         if ($PAYCOUNT > 0){

								  		$curPAY = $mydb->loadResultList();
									  		$i = 0;
											foreach ($curPAY as $PAYMENT) {
									  		$i = $i + 1;
									  		echo '<tr>';

									  		echo '<td width="5%" align="center">'.$i .'</td>';
									  		echo '<td>'. $PAYMENT->ORNO.'</td>';
									  		echo '<td>'. $PAYMENT->STUDENTNAME.'</td>';
									  		echo '<td>'. $PAYMENT->DATEPAY.'</td>';
									  		echo '<td>'. $PAYMENT->AMOUNTPAY.'</td>';
									  		echo '<td>'. $PAYMENT->AMOUNTBAL.'</td>';
									  		echo '<td>'. $PAYMENT->CASHIER.'</td>';
									  		
									  		echo '</tr>';
									  		}
								  	}else{
								  		echo '<tr>';
								  		echo '<td colspan="7">No Payment(s) has been made!</td>';
								  		echo '</tr>';
								  	}

								  		
							  	}
							  	?>

			 
							  </tbody>
							 
							</table>
							<div class="btn-group">
							
							  <!--  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button> -->
							</div>
							</form>
				  		</div>
			  		</div>	
			  </div>

			  </div>	
        </form>
       