<?php  
      if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }
$deptid = $_GET['id'];
$singledept = new DefaultCharges();
$object = $singledept->single_defaultCharges($deptid);

?> 

 <form class="form-horizontal span6" action="controller.php?action=edit" method="POST">

          <fieldset>
            <legend>Update Charges</legend>
                              
                  
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "particulars">Particulars</label>

                      <div class="col-md-8">
                        <input name="PartID" type="hidden" value="<?php echo $object->DEFID;?>">
                         <input class="form-control input-sm" id="Particulars" name="Particulars" placeholder=
                            "Particulars" type="text" value="<?php echo $object->PARTICULARS;?>">
                      </div>
                    </div>
                  </div>

                <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "amount">Amount</label>

                      <div class="col-md-8">
                           <input class="form-control input-sm" id="amount" name="amount" placeholder=
                            "Amount" type="text" value="<?php echo $object->AMOUNT;?>">
                      </div>
                    </div>
                 </div>

                

                <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "grdlvl">Grade Level</label>

                      <div class="col-md-8">
                       <select class="form-control input-sm" name="grdlvl" id="grdlvl">
                        <option value=""></option>
                           <?php
                            global $mydb;
                             $mydb->setQuery("SELECT `COURSE_ID`, CONCAT(`COURSE_NAME`,'-', `COURSE_LEVEL`, `COURSE_MAJOR`) as 'COURSE' FROM `course`"); 
                             $cur = $mydb->loadResultList();
                            foreach ($cur as $Department) {
                              if($object->COURSE_ID == $Department->COURSE_ID){
                              echo '<option selected value="'. $Department->COURSE_ID.'">'.$Department->COURSE .'</option>';
                              }
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

                        <input type="text" class="form-control input-sm" name="sem" id="sem" value="<?php echo $object->SEMESTER;?>" readonly >
                       
                      </div>
                    </div>
                  </div>   
                 
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "ay">Academic Year :</label>

                      <div class="col-md-8">
                        <input type="text" class="form-control input-sm" name="ay" id="ay" value="<?php echo $object->AY;?>" readonly>
                        
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