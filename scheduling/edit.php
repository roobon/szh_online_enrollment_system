<?php

$clasid = $_GET['id'];
$class = new InstructorClasses();
$object = $class->single_class($clasid);

?>
<form class="form-horizontal well span4" action="controller.php?action=edit&id=<?php echo $clasid;?>" method="POST">


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

                $singlesubject = new Subject();
                $subj = $singlesubject->single_subject($object->SUBJ_ID);

                global $mydb;
                      $mydb->setQuery("SELECT * 
                              FROM subject where COURSE_ID=".$subj->COURSE_ID);

                      $s = $mydb->loadResultList();

                          foreach ($s as $sbj) {
                            if ($sbj->SUBJ_ID == $object->SUBJ_ID) {
                             echo '<option value="'. $sbj->SUBJ_ID.'" selected="true">'.$sbj->SUBJ_CODE.'</option>';
                            }
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
                             if ($d->DAYDESC == $object->DAY) {
                               echo '<option value="'. $d->DAYDESC.'"  selected="true">'.$d->DAYDESC.'</option>';
                             }
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
                             if ($t->TIMEDESC == $object->C_TIME) {
                                echo '<option value="'. $t->TIMEDESC.'" selected="true">'.$t->TIMEDESC.'</option>';
                             }
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
                               if ($r->ROOM_NAME == $object->ROOM) {
                                 echo '<option value="'. $r->ROOM_NAME.'" selected="true">'.$r->ROOM_NAME.'</option>';
                               }

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
                             if ($i->IDNO == $object->INST_ID) {
                               echo '<option value="'. $i->INST_ID.'" selected="true">'.$i->INST_FULLNAME.'</option>';
                             }
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