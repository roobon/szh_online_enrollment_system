                      <?php 
                        if (!isset($_SESSION['ACCOUNT_ID'])){
                          redirect(web_root."admin/index.php");
                         }
                         
                         
                 
                       ?> 
 <form class="form-horizontal span6" action="controller.php?action=add" method="POST">

      <fieldset>
            <legend>New Schedule</legend>
                              
        <div class="form-group">
        <div class="col-md-8">
          <label class="col-md-4 control-label" for=
          "subjcode">Subject Code</label>

          <div class="col-md-8">
              <input type="hidden" name="subjid" >
           
                   <select class="form-control input-sm" name="subjcode" id="subjcode">
                          <?php

                         
                global $mydb;
                      $mydb->setQuery("SELECT * 
                              FROM subject where COURSE_ID=".$_GET['cid']);

                      $s = $mydb->loadResultList();

                          foreach ($s as $sbj) {
                            echo '<option value="'. $sbj->SUBJ_ID.'">'.$sbj->SUBJ_CODE.'</option>';
                          }

                          ?>
                    
                  </select> 
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-8">
          <label class="col-md-4 control-label" for=
          "day">Day</label>

          <div class="col-md-8">
             <select class="form-control input-sm" name="day" id="day">
                          <?php
                                                   
                    $room = new Room();
                    $day = $room->listOfDay();
                        
                          foreach ($day as $d) {
                            echo '<option value="'. $d->DAYDESC.'">'.$d->DAYDESC.'</option>';
                          }

                          ?>
                    
                  </select> 
          </div>
        </div>
      </div>

       <div class="form-group">
        <div class="col-md-8">
          <label class="col-md-4 control-label" for=
          "time">Time</label>

          <div class="col-md-8">
              <select class="form-control input-sm" name="time" id="time">
                          <?php
                                                   
                    $room = new Room();
                    $time = $room->listOfTime();
                        
                          foreach ($time as $t) {
                            echo '<option value="'. $t->TIMEDESC.'">'.$t->TIMEDESC.'</option>';
                          }

                          ?>
                    
                  </select> 
          </div>
        </div>
      </div>
       <div class="form-group">
        <div class="col-md-8">
          <label class="col-md-4 control-label" for=
          "room">Room</label>

          <div class="col-md-8">
                <select class="form-control input-sm" name="room" id="room">
                          <?php
                                                   
                    $room = new Room();
                    $rm = $room->listOfroom();
                        
                          foreach ($rm as $r) {
                            echo '<option value="'. $r->ROOM_NAME.'">'.$r->ROOM_NAME.'</option>';
                          }

                          ?>
                    
                  </select> 
          </div>
        </div>
      </div>
      
       <div class="form-group">
        <div class="col-md-8">
          <label class="col-md-4 control-label" for=
          "instructor">Instructor</label>

          <div class="col-md-8">
             <select class="form-control input-sm" name="instructor" id="instructor">
                          <?php
                                                   
                    $singleinstructor = new Instructor();
                    $inst = $singleinstructor->listOfinstructor();
                        
                          foreach ($inst as $i) {
                            echo '<option value="'. $i->INST_ID.'">'.$i->INST_FULLNAME.'</option>';
                          }

                          ?>
                    
                  </select> 
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
       </div><!--End of container-->