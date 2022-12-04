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
          $mydb->setQuery("SELECT * FROM `tblstudent` WHERE `IDNO`='{$_POST['txtsearch']}' AND IDNO NOT IN (SELECT `IDNO` FROM `schoolyr` WHERE `SEMESTER`='{$_SESSION['SEMESTER']}' AND  `AY`='{$_SESSION['AY']}')");
          $rowcount = $mydb->num_rows();
         if ($rowcount==1){

          $student = new Student();
          $cur = $student->single_student($_POST['txtsearch']);
         } else{
           message("ID Number not found!","error");
           redirect("index.php?view=add");
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
      <form class="navbar-form navbar-left" id="lets_search" action="index.php?view=add" method="POST">
      <div class="form-group">
        <input type="text" name="txtsearch" id="txtsearch" class="form-control" placeholder="Search">
      </div>
       <button type="submit" name="search"class="btn btn-default">  <span class="glyphicon glyphicon-search"></span></button></span>
      
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><?php
       $created =  strftime("%Y-%m-%d %H:%M:%S", time()); 


      echo date_toText($created); ?></a></li>
      <li class="dropdown">
       
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>

 <form class="form-horizontal span6" action="controller.php?action=add" method="POST">

      <fieldset>
            <legend>Add Enrollment</legend>
                              
                  
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Idnum">ID Number:</label>

                      <div class="col-md-8">
                        <input name="Idnum" type="hidden" value="">
                         <input class="form-control input-sm" id="Idnum" readonly name="Idnum" placeholder=
                            "ID Number" type="text" value="<?php echo (isset($cur)) ? $cur->IDNO : 'IDNO' ;?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "studname">Student Name:</label>

                      <div class="col-md-8">
                        <input class="form-control input-sm" id="studname" readonly name="studname" placeholder=
                            "Student Name" type="text" value="<?php echo (isset($cur)) ? $cur->LNAME.', '.$cur->FNAME : 'Fullname' ;?>">
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Status">Status : </label>

                      <div class="col-md-8">
                         <select class="form-control input-sm" name="Status" id="Status">
                            <option value="New">New Student</option>
                            <option value="Continuing">Continuing</option>  
                            <option value="Trasferee">Trasferee</option>  
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "grdlvl">Grade Level</label>

                      <div class="col-md-8">
                          <select class="form-control input-sm" name="grdlvl" id="grdlvl">
                            <?php
                            global $mydb;
                             $mydb->setQuery("SELECT `COURSE_ID`, CONCAT(`COURSE_NAME`,'-', `COURSE_LEVEL`, `COURSE_MAJOR`) as 'COURSE' FROM `course`"); 
                             $cur = $mydb->loadResultList();
                            foreach ($cur as $Department) {
                              echo '<option value="'. $Department->COURSE_ID.'">'.$Department->COURSE .'</option>';
                            }

                            ?>
                    
                           </select> 
                      </div>
                    </div>
                  </div>
                 <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for="sem" >Semester :</label>

                      <div class="col-md-8">

                        <input type="text" class="form-control input-sm" name="sem" id="sem" value="<?php echo $_SESSION['SEMESTER']; ?>" readonly >
                       
                      </div>
                    </div>
                  </div>   
                 
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "ay">Academic Year :</label>

                      <div class="col-md-8">
                        <input type="text" class="form-control input-sm" name="ay" id="ay" value="<?php echo $_SESSION['AY']; ?>" readonly>
                        
                      </div>
                    </div>
                  </div>   
            
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                        <button class="btn btn-default" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
                      </div>
                    </div>
                  </div>


              
          </fieldset> 


              
        </form>
       