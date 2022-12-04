                      <?php 
                        if (!isset($_SESSION['ACCOUNT_ID'])){
                          redirect(web_root."admin/index.php");
                         }

                 
                       ?> 
 <form class="form-horizontal well span6" action="controller.php?action=add" method="POST">

    <fieldset>
            <legend>Student Details</legend>
            <fieldset>
            <legend> Primary Details</legend>       

      <div class="form-group" id="idno">
            <div class="col-md-4">
              <label class="col-md-4 control-label" for=
              "idno">ID Number*</label>

              <div class="col-md-8">
                 <input class="form-control input-sm" id="idno" name="idno" placeholder=
                    "ID Number" type="number" value="">
              </div>

            </div>

          </div>
        
         <div class="form-group">
            <div class="rows">
              <div class="col-md-4">
                <label class="col-md-4 control-label" for=
                "lName">LastName:*</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="lName" name="lName" type=
                  "text" placeholder="Last Name">
                </div>
              </div>

              <div class="col-md-4">
                <label class="col-md-4 control-label" for=
                "fName">Firstname:*</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="fName" name="fName" type=
                  "text" placeholder="First Name">
                </div>
              </div>

              <div class="col-md-4">
                <label class="col-md-4 control-label" for=
                "mName">Middlename:*</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="mName" name="mName" type=
                  "text" placeholder="Middle Name">
                </div>
              </div>
            </div>
          </div>
      
      <div class="form-group">
            <div class="rows">
              <div class="col-md-4">
                <label class="col-md-4 control-label" for=
                "gender">Gender </label>

                <div class="col-md-8">
                  <select class="form-control input-sm" name="gender" id="gender">
            <option value="M">Male</option>
            <option value="F">Female</option> 
          </select> 
                </div>
              </div>

              <div class="col-md-4">
                <label class="col-md-4 control-label" for=
                "bday">Birth Date</label>
    
            <div class="col-md-8">
                  <div class="input-group date form_curdate col-md-15" data-date="" data-date-format="yyyy-mm-dd" data-link-field="any" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="11" type="date" value="" data-date-format="yyyy-mm-dd" name="bday" id="bday">
                   
       
                </div>
              </div>
      </div>

              <div class="col-md-4">
                <label class="col-md-4 control-label" for=
                "bplace">Birth place</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="bplace" name="bplace" type=
                  "text" placeholder="Birth Place">
                </div>
              </div>
            </div>
          </div>
                   
            <div class="form-group">
            <div class="rows">
              <div class="col-md-4">
                <label class="col-md-4 control-label" for=
                "status">Civil Status </label>

                <div class="col-md-8">
                  <select class="form-control input-sm" name="status" id="status">
            <option value="Single">Single</option>
            <option value="Married">Married</option>  
          </select> 
                </div>
              </div>

              <div class="col-md-4">
                <label class="col-md-4 control-label" for=
                "age">Age</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="age" name="age" type="number" placeholder="age">
                </div>
              </div>

              <div class="col-md-4">
                <label class="col-md-4 control-label" for=
                "nationality">Nationality</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="nationality" name="nationality" type=
                  "text" placeholder="Nationality">
                </div>
              </div>
            </div>
          </div>
        
      <div class="form-group">
            <div class="rows">
              <div class="col-md-4">
                <label class="col-md-4 control-label" for=
                "religion">Religion </label>

                <div class="col-md-8">
                   <input class="form-control input-sm" id="religion" name="religion" type=
                  "text" placeholder="Religion">
                </div>
              </div>

              <div class="col-md-4">
                <label class="col-md-4 control-label" for=
                "contact">Contact </label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="contact" name="contact" type="text" placeholder="Contact Number">
                </div>
              </div>
               <div class="col-md-4">
                <label class="col-md-4 control-label" for=
                "email">Email*</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="email" name="email" type=
                  "email" placeholder="Email address">
                </div>
              </div>
          </div>
          </div>

            <div class="form-group">
            <div class="rows">
              <div class="col-md-8">
                <label class="col-sm-2 control-label" for=
                "home">Home   </label>

                <div class="col-md-10">
                  <input class="form-control input-sm" id="home" name="home" type=
                  "text" placeholder="Home Address">
                </div>
              </div>

              
            </div>
          </div>
              
          </fieldset> 
          
        <fieldset>
        <legend>Secondary Details</legend>

        <div class="form-group">
                <div class="rows">
                  <div class="col-md-6">
                    <label class="col-md-4 control-label" for=
                    "father">Father </label>

                    <div class="col-md-8">
                       <input class="form-control input-sm" id="father" name="father" type=
                      "text" placeholder="Father">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label class="col-md-4 control-label" for=
                    "fOccu">Occupation </label>

                    <div class="col-md-8">
                      <input class="form-control input-sm" id="fOccu" name="fOccu" type="text" placeholder="Occupation">
                    </div>
                  </div>
                  
              </div>
              </div>

        <div class="form-group">
                <div class="rows">
                  <div class="col-md-6">
                    <label class="col-md-4 control-label" for=
                    "mother">Mother </label>

                    <div class="col-md-8">
                       <input class="form-control input-sm" id="mother" name="mother" type=
                      "text" placeholder="Mother">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label class="col-md-4 control-label" for=
                    "mOccu">Occupation </label>

                    <div class="col-md-8">
                      <input class="form-control input-sm" id="mOccu" name="mOccu" type="text" placeholder="Occupation">
                    </div>
                  </div>
                  
              </div>
              </div>
        <div class="form-group">
                <div class="rows">
                  <div class="col-md-6">
                    <label class="col-md-4 control-label" for=
                    "boarding">Are you Boarding? </label>

                    <div class="col-md-8">
                         <div class="radio">
                               <label><input checked id="boarding"name="boarding" type=
                          "radio" value="Yes">Yes</label>
                             </div>
                        <div class="radio">
                               <label><input checked id="boarding" name="boarding" type=
                          "radio" value="No">No</label>
                             </div>

              
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label class="col-md-4 control-label" for=
                    "withfamily">With Family?</label>

                    <div class="col-md-8">
                  <div class="radio">
                               <label><input checked id="withfamily" name="withfamily" type=
                          "radio" value="Yes">Yes</label>
                             </div>
                        <div class="radio">
                               <label><input checked id="withfamily" name="withfamily" type=
                          "radio" value="No">No</label>
                             </div>
                    </div>
                    </div>
                  </div>


              </div>
        <div class="form-group">
                <div class="rows">
                  <div class="col-md-6">
                    <label class="col-md-4 control-label" for=
                    "guardian">Guardian </label>

                    <div class="col-md-8">
                       <input class="form-control input-sm" id="guardian" name="guardian" type=
                      "text" placeholder="Guardian">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label class="col-md-4 control-label" for=
                    "guardianAdd">Address </label>

                    <div class="col-md-8">
                      <input class="form-control input-sm" id="guardianAdd" name="guardianAdd" type="text" placeholder="Guardian Address">
                    </div>
                  </div>
                  
              </div>
              </div>


        <div class="form-group">
                <div class="rows">
                  <div class="col-md-6">
                    <label class="col-md-6 control-label" for=
                    "otherperson">Other person Supporting </label>

                    <div class="col-md-6">
                       <input class="form-control input-sm" id="otherperson" name="otherperson" type=
                      "text" placeholder="Other Person Supporting">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label class="col-md-4 control-label" for=
                    "otherAddress">Address </label>

                    <div class="col-md-8">
                      <input class="form-control input-sm" id="otherAddress" name="otherAddress" type="text" placeholder="Address">
                    </div>
                  </div>
                  
              </div>
              </div>
              
        </fieldset> 

        <fieldset>
          <legend>Other Details</legend>
          <div class="form-group">
                <div class="rows">
                  <div class="col-md-6">
                    <label class="col-md-4 control-label" for=
                    "boarding">Requirements</label>

                    <div class="col-md-8">
                       <div class="checkbox">
                  <label>
                    <input type="checkbox" name="nso" value="yes"/> NSO
                  </label>
                  
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="baptismal" value="yes"/> Baptismal
                  </label>
                  
                </div>

                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="entrance" value="yes"/> Entrance Test Result
                  </label>
                  
                </div>
                 <div class="checkbox">
                  <label>
                    <input type="checkbox" name="mir_contract" value="yes"/> Marriage Contract
                  </label>
                  
                </div>
                 <div class="checkbox">
                  <label>
                    <input type="checkbox" name="certifcateOfTransfer" value="yes"/> Certificate of Transfer
                  </label>
                  
                </div>

                    </div>
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

                    <div class="col-md-8">
                        <button class="btn btn-primary" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
                      </div>
                  
              </div>
              </div>
        </form>
       