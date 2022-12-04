                      <?php 
                        if (!isset($_SESSION['ACCOUNT_ID'])){
                         redirect(web_root."admin/index.php");
                         }
$student = new Student();
$cur = $student->single_student($_GET['id']);
                 
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
    <a class="navbar-brand" href="#"> Pay Entrance Fee:</a>
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

 <form class="form-horizontal span6" action="controller.php?action=EntranceFee" method="POST">
<div class="col-sm-12">
   <div class="col-sm-4 "> 

   
      <fieldset>
                             
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="col-md-6 control-label" for=
                      "Idnum">ID Number:</label>

                      <div class="col-md-6">
                        <input name="Idnum" type="hidden" value="">
                         <input class="form-control input-sm" id="Idnum" readonly name="Idnum" placeholder=
                            "ID Number" type="text" value="<?php echo (isset($cur)) ? $cur->IDNO : 'IDNO' ;?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="col-md-6 control-label" for=
                      "studname">Student Name:</label>

                      <div class="col-md-6">
                        <input class="form-control input-sm" id="studname" readonly name="studname" placeholder=
                            "Student Name" type="text" value="<?php echo (isset($cur)) ? $cur->LNAME.', '.$cur->FNAME : 'Fullname' ;?>">
                      </div>
                    </div>
                  </div>
                                   
                 <div class="form-group">
                    <div class="col-md-12">
                      <label class="col-md-6 control-label" for="sem" >Semester :</label>

                      <div class="col-md-6">

                        <input type="text" class="form-control input-sm" name="sem" id="sem" value="<?php echo $_SESSION['SEMESTER']; ?>" readonly >
                       
                      </div>
                    </div>
                  </div>   
                 
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="col-md-6 control-label" for=
                      "ay">Academic Year :</label>

                      <div class="col-md-6">
                        <input type="text" class="form-control input-sm" name="ay" id="ay" value="<?php echo $_SESSION['AY']; ?>" readonly>
                        
                      </div>
                    </div>
                  </div>   
      </fieldset> 

   </div>
         <div class="col-sm-8 "> 
              <div class="panel panel-success">
                 <div class="form-group">
                    <div class="col-md-12">
                      <label class="col-md-8 control-label" for=
                      "studname">Official Reciept:</label>
                      <?php
                      $singledft = new Defaults();
                      $assignedtuition = $singledft->single_default_OR();

                     ?>
                      <div class="col-md-4">
                        <input class="form-control input-sm" id="OR" readonly name="OR" placeholder=
                            "OR NO." type="text" value="<?php echo $assignedtuition->LISTNAME + 1 ;?>">
                      </div>
                    </div>
                  </div>      
      <h2>Recieved Payment For Entrance Fee</h2> 

         <div class="panel-body"> 
          <table id="examples" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
      
          <thead>
           
           <td colspan="5"></td>
                  
           </tr>
             <tr>
              <td align="right" colspan="4"><h3>Total Payables</h3></td><th colspan="3"><h5><input type="text" class="form-control input-bg" name="totalpayables" id="totalpayables" value="1500" readonly></h5></th>    
           </tr>
           <tr>
              <td align="right" colspan="4"><h3>Recieved Amount</h3></td><th colspan="3"><h5><input type="text" class="form-control input-bg" name="amountrecieved" id="amountrecieved" value="" onkeyup="calculateCashier();javascript:checkNumber(this);"></h5></th>    
           </tr>
            <tr>
              <td align="right" colspan="4"><h3>Change</h3></td><th colspan="3"><h5><input type="text" class="form-control input-bg" name="Change" id="Change" value="" readonly></h5></th>    
           </tr>
           <tr>
           <td colspan="4"></td>
           
           <td colspan="2"><button type="submit" class="btn btn-primary" name="SaveCashier"  ><span class="glyphicon glyphicon-calc"></span>Save</button>

           </tr>
         </tfoot>     
             

        </table>
        </div>
        </div>
         </div>

          </div>    
        </form>
        