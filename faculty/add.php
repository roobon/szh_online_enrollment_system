                      <?php 
                        if (!isset($_SESSION['ACCOUNT_ID'])){
                          redirect(web_root."admin/index.php");
                         }

                 
                       ?> 
 <form class="form-horizontal span6" action="controller.php?action=add" method="POST">

      <fieldset>
            <legend>New Faculty</legend>
                              
            <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno">Employee ID NO.:</label>

                      <div class="col-md-8">
                     
                         <input class="form-control input-sm" id="idno" name="idno" placeholder=
                            "Employee ID Number" type="text" value="">
                      </div>
                    </div>
                  </div>
              <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "name">Fullname:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="name" name="name" placeholder=
                            "Account Name" type="text" value="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "address">Current Address:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="address" name="address" placeholder=
                            "Current Address" type="text" value="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Gender">Gender:</label>

                      <div class="col-md-8">
                       <select class="form-control input-sm" name="Gender" id="Gender">
                          <option value="M">Male</option>
                          <option value="F">Female</option>
                          
                        </select> 
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "civilstats">Civil Status:</label>

                      <div class="col-md-8">
                       <select class="form-control input-sm" name="civilstats" id="civilstats">
                          <option value="Single">Single</option>
                          <option value="Married">Married</option>
                          
                        </select> 
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "specialization">Specialization:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="specialization" name="specialization" placeholder=
                            "Specialization" type="text" value="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "empStats">Employment Status:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="empStats" name="empStats" placeholder=
                            "Employment Status" type="text" value="">
                      </div>
                    </div>
                  </div>
                  


            <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "email">Email Address:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="email" name="email" placeholder=
                            "Email Address" type="email" value="">
                      </div>
                    </div>
                  </div>

            
             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                        <button class="btn btn-primary" name="save" type="submit" >Save</button>
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
       