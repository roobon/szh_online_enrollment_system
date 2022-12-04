                      <?php 
                        if (!isset($_SESSION['ACCOUNT_ID'])){
                          redirect(web_root."admin/index.php");
                         }

                 
                       ?> 
 <form class="form-horizontal span6" action="controller.php?action=add1" method="POST">

      <fieldset>
            <legend>New Default Charges</legend>
                              
                  
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "particulars">Particulars</label>

                      <div class="col-md-8">
                        <input name="Particulars" type="hidden" value="">
                         <input class="form-control input-sm" id="Particulars" name="Particulars" placeholder=
                            "Particulars" type="text" value="">
                      </div>
                    </div>
                  </div>

                <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "amount">Amount</label>

                      <div class="col-md-8">
                           <input class="form-control input-sm" id="amount" name="amount" placeholder=
                            "Amount" type="text" value="">
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
       