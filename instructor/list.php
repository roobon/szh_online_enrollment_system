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
          $mydb->setQuery("SELECT * FROM `class` WHERE `INST_ID`='{$_POST['txtsearch']}' AND `AY`='{$_SESSION['AY']}' AND SEMESTER='{$_SESSION['SEMESTER']}'");
          $rowcount = $mydb->num_rows();
         if ($rowcount>0){

          $student = new Instructor();
          $cur = $student->single_instructor1($_POST['txtsearch']);


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
    <a class="navbar-brand" href="#"> Instructor ID Number/Lastname:</a>
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
			    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Instructor Inquiry of their Subject Classes </h3>
			  </div>
			  <div class="panel-body">

			  	
			  	<div class="row">
			  		<div class="col-lg-6">
			  			<H4>Instructor details</H4>
			  				<table class="table" align="center" >	 
				    			
								  <tbody>				    
							     	<tr>
							     		<td><strong>Instrunctor Name:</strong> <?php echo (isset($cur)) ? $cur->INST_FULLNAME : 'Instructor name' ;?><br/>
							     		<?php
							     			if (isset($cur->INSTR_SEX) == 'F'){
							     				echo '<strong>Gender:</strong>Female<br/>';

							     			}else{
							     				echo '<strong>Gender:</strong>Male<br/>';
							     			}

							     		?>
							     		
							     		<strong>Address:</strong> <?php echo (isset($cur)) ? $cur->INST_ADDRESS : 'Address' ;?><br/>
							       		<strong>Employmetn Status:</strong> <?php echo (isset($cur)) ? $cur->INST_STATUS : 'Status' ;?><br/>
							     	<strong>STATUS:</strong> <?php echo (isset($cur)) ? $cur->EMPLOYMENT_STATUS : 'STATUS' ;?><br/>
							     	<strong>Specialization:</strong> <?php echo (isset($cur)) ? $cur->SPECIALIZATION : 'Specialization' ;?></td>
							     	 
							     	</tr>
						    	</tbody>
						    </table>
						
			  		</div>
			  		<div class="col-lg-6">
			  			
			  		</div>
			  	</div>
			  		
			  		<div class="row">
				  		<div class="col-lg-12">
				  		<h3 align="left">Instructor Subject Loads</h3>
						   <form action="" Method="POST">  					
							<table id="example" class="table table-striped table-bordered table-hover table-responsive" cellspacing="0">
							
							  <thead>
							  	<tr id="table" >
							  		<tr>
							  		<th>No.</th>
							  		<th>Subject Code</th>
							  		<th>Description</th>
							  		<th>Unit</th>
							  		<th>Room</th>
							  		<th>Day</th>		
							  		<th>Time</th>				  		
							  		<th>No. of Student</th>				  		
							  			  		
							  		
							  	</tr>	
							  </thead>
							  <tbody>
							  	<?php 

							  	global $mydb;
							
							  	if (isset($cur)){

							  

							  		$mydb->setQuery("SELECT `CLASS_CODE`, DESCRIPTION,`UNIT`,`ROOM`,`DAY`,`C_TIME`,COUNT(g.IDNO) AS 'NOS' FROM subject s, `grades` g RIGHT JOIN `class` c  on g.`SUBJ_ID`=c.`SUBJ_ID` WHERE  g.`AY`='{$_SESSION['AY']}' AND g.`SEMESTER`='{$_SESSION['SEMESTER']}' AND c.`INST_ID`='{$cur->IDNO}' AND g.`SUBJ_ID`=s.SUBJ_ID GROUP BY g.`SUBJ_ID`");

							  	
								  	$PAYCOUNT = $mydb->num_rows();

							         if ($PAYCOUNT > 0){

								  		$curPAY = $mydb->loadResultList();
									  		$i = 0;
											foreach ($curPAY as $PAYMENT) {
									  		$i = $i + 1;
									  		echo '<tr>';

									  		echo '<td width="5%" align="center">'.$i .'</td>';
									  		echo '<td>'. $PAYMENT->CLASS_CODE.'</td>';
									  		echo '<td>'. $PAYMENT->DESCRIPTION.'</td>';
									  		echo '<td>'. $PAYMENT->UNIT.'</td>';
									  		echo '<td>'. $PAYMENT->ROOM.'</td>';
									  		echo '<td>'. $PAYMENT->DAY.'</td>';
									  		echo '<td>'. $PAYMENT->C_TIME.'</td>';
									  			echo '<td>'. $PAYMENT->NOS.'</td>';
									  		
									  		echo '</tr>';
									  		}
								  	}else{
								  		echo '<tr>';
								  		echo '<td colspan="7">No Subject(s) has been assigned!</td>';
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
       