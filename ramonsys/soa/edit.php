<?php  
      if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }
$deptid = $_GET['id'];
$singledept = new Dept();
$object = $singledept->single_dept($deptid);

?> 

 <form class="form-horizontal span6" action="controller.php?action=edit" method="POST">

          <fieldset>
            <legend> Update Grade Level</legend>
                 <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "deptname">Department Name</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="<?php echo $object->DEPT_ID;?>">
                         <input class="form-control input-sm" id="deptname" name="deptname" placeholder=
                            "Department Name" type="text" value="<?php echo $object->DEPARTMENT_NAME;?>">
                      </div>
                    </div>
                  </div>

             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "deptdesc">Department Description</label>

                      <div class="col-md-8">
                           <input class="form-control input-sm" id="deptdesc" name="deptdesc" placeholder=
                            "Department Description" type="text" value="<?php echo $object->DEPARTMENT_DESC;?>">
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
      

        </div><!--End of container-->