<?php  
      if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

  @$COURSEID = $_GET['id'];
    if($COURSEID==''){
  redirect("index.php");
}
  $Course = New Course();
  $singleCOURSE = $Course->single_course($COURSEID);

?> 

 <form class="form-horizontal span6" action="controller.php?action=edit&id=<?php echo (isset($singleCOURSE)) ? $singleCOURSE->COURSE_ID : '' ;?>"" method="POST">

          <fieldset>
            <legend> Update User Account</legend>
                   
                     <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "coursename">Course Name:</label>

                      <div class="col-md-8">
                      
                         <input class="form-control input-sm" id="coursename" name="coursename" placeholder=
                            "Course Name" type="text" value="<?php echo $singleCOURSE->COURSE_NAME; ?>">
                      </div>
                    </div>
                  </div>

                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "level">Level:</label>
                       <div class="col-md-8">
                         <input class="form-control input-sm" id="level" name="level" placeholder=
                            "Level" type="text" value="<?php echo $singleCOURSE->COURSE_LEVEL; ?>">
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "major">Major:</label>

                      <div class="col-md-8">
                        <input class="form-control input-sm" id="major" name="major" placeholder=
                            "Major" type="text" value="<?php echo $singleCOURSE->COURSE_MAJOR; ?>">
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "coursedesc">Description:</label>

                      <div class="col-md-8">
                        <input class="form-control input-sm" id="coursedesc" name="coursedesc" placeholder=
                            "Description" type="text" value="<?php echo $singleCOURSE->COURSE_DESC; ?>">
                      </div>
                    </div>
                  </div>
                  

            
             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                         <button class="btn btn-primary " name="savecourse" type="submit" ><span class="fa fa-save fw-fa"></span> Save</button>
                          <!-- <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-circle-left fw-fa"></span>&nbsp;<strong>List of Users</strong></a> -->
                      </div>
                    </div>
                  </div>

              
          </fieldset> 

        <div class="form-group">
                <div class="rows">
                  <div class="col-md-6">
                    <label class="col-md-6 control-label" for=
                    "otherperson"></label>

                    <div class="col-md-6">
                   
                    </div>
                  </div>

                  <div class="col-md-6" align="right">
                   

                   </div>
                  
              </div>
              </div>
          
        </form>
      

        </div><!--End of container-->