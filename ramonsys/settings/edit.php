<?php  
      if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }
$dft = $_GET['id'];
$singledft = new Defaults();
$object = $singledft->single_default($dft);

?> 

 <form class="form-horizontal span6" action="controller.php?action=edit" method="POST">

          <fieldset>
            <legend> Update Grade Level</legend>
                     <div class="form-group">
                  <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "category">Category</label>

                      <div class="col-md-8">
                      <input name="dftid" type="hidden" value="<?php echo $object->COMMON_ID;?>">
                         <input class="form-control input-sm" id="category" name="category" placeholder=
                            "Category" type="text" value="<?php echo $object->CATEGORY;?>">
                      </div>
                    </div>
                  </div>

             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "item">Item</label>

                      <div class="col-md-8">
                           <input class="form-control input-sm" id="item" name="item" placeholder=
                            "Item" type="text" value="<?php echo $object->LISTNAME;?>">
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "default">Set Default?</label>

                      <div class="col-md-8">
                          <select class="form-control input-sm" name="default" id="default">
                          <?php
                            if ($object->ISDEFAULT == 'YES'){
                               echo '<option value="YES" selected="selected">YES</option>';
                               echo '<option value="NO" >NO</option>';
                            }else{
                                echo '<option value="YES" >YES</option>';
                               echo '<option value="NO" selected="selected">NO</option>';
                            }

                            ?>
                          </select>
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