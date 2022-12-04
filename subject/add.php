                      <?php 
                        if (!isset($_SESSION['ACCOUNT_ID'])){
                          redirect(web_root."admin/index.php");
                         }

                 
                       ?> 
 <form class="form-horizontal span6" action="controller.php?action=add" method="POST">

      <fieldset>
            <legend>New Subject</legend>
                              
        <div class="form-group">
        <div class="col-md-8">
          <label class="col-md-4 control-label" for=
          "subjcode">Subject Code</label>

          <div class="col-md-8">
              <input type="hidden" name="subjid" >
             <input class="form-control input-sm" id="subjcode" name="subjcode" placeholder=
                  "Subject Code" type="text">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-8">
          <label class="col-md-4 control-label" for=
          "subjdesc">Subject Description</label>

          <div class="col-md-8">
             <input class="form-control input-sm" id="subjdesc" name="subjdesc" placeholder=
                  "Subject Description" type="text" >
          </div>
        </div>
      </div>

       <div class="form-group">
        <div class="col-md-8">
          <label class="col-md-4 control-label" for=
          "unit">No of units</label>

          <div class="col-md-8">
             <input class="form-control input-sm" id="unit" name="unit" placeholder=
                  "No of units" type="number" >
          </div>
        </div>
      </div>
       <div class="form-group">
        <div class="col-md-8">
          <label class="col-md-4 control-label" for=
          "pre">Prerequisite</label>

          <div class="col-md-8">
           <input class="form-control input-sm" id="pre" name="pre" placeholder=
                  "Prerequisite" type="text" value="">
          </div>
        </div>
      </div>
       <div class="form-group">
        <div class="col-md-8">
          <label class="col-md-4 control-label" for=
          "course">Course/Yr</label>

          <div class="col-md-8">
           <select class="form-control input-sm" name="course" id="course">
                <?php
                $course = new Course();
                $cur = $course->listOfcourse(); 
                foreach ($cur as $course) {
                  echo '<option value="'. $course->COURSE_ID.'">'.$course->COURSE_NAME. '-' .$course->COURSE_LEVEL.'</option>';
                }

                ?>
          
        </select> 
          </div>
        </div>
      </div>
       <div class="form-group">
        <div class="col-md-8">
          <label class="col-md-4 control-label" for=
          "ay">Academic Year</label>

          <div class="col-md-8">
            <select class="form-control input-sm" name="ay" id="ay">
        <option value="2013-2014">2013-2014</option>
        <option value="2014-2015">2014-2015</option>
        <option value="2015-2016">2015-2016</option>
        <option value="2016-2017">2016-2017</option>
        <option value="2017-2018">2017-2018</option>
        <option value="2018-2019">2018-2019</option>
        <option value="2019-2020">2019-2020</option>  
      </select> 
          </div>
        </div>
      </div>
    <div class="form-group">
        <div class="col-md-8">
          <label class="col-md-4 control-label" for=
          "Semester">Semester</label>

          <div class="col-md-8">
             <select class="form-control input-sm" name="Semester" id="Semester">
                <option value="First">First</option>
                <option value="Second">Second</option>  
                <option value="Second">Summer</option>  
              </select>
        <!--    <input class="form-control input-sm" id="Semester" name="Semester" placeholder=
                      "Prerequisite" type="hidden" value="First">-->
           </div>
        </div>
      </div>
  <?php
                          if($_SESSION['ACCOUNT_TYPE']=='Administrator'){
            echo '
   <div class="form-group">
        <div class="col-md-8">
          <label class="col-md-4 control-label" for=
          "idno"></label>

          <div class="col-md-8">
            <button class="btn btn-primary" name="savecourse" type="submit" >Save</button>
          </div>
        </div>
      </div>';
    }
    ?>

    
</fieldset> 

        </form>
       