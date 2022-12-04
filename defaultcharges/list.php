<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Charges </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=add" Method="POST">  
			    
            <table id="examples" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
        
          <thead>
            <tr>

             
              <th>AY</th>
              <th>SEMESTER</th>
              <th>PARTICULARS</th>
              <th>AMOUNT</th>
               <th>COURSENAME</th>
              <th>ACTION</th>
               <?php 
              // `DEFID`, `COURSE_ID`, `COURSENAME`, `AY`, `SEMESTER`, `PARTICULARS`, `AMOUNT`
              $mydb->setQuery("SELECT `DEFID`, D.`COURSE_ID`, `AY`, `SEMESTER`, `PARTICULARS`, `AMOUNT`,CONCAT(`COURSE_NAME`,'-', `COURSE_LEVEL`, `COURSE_MAJOR`) as 'COURSE' FROM `tbldefaultcharges` d LEFT JOIN course c ON d.COURSE_ID = C.COURSE_ID");
              $cur = $mydb->loadResultList();

            foreach ($cur as $result) {
              echo '<tr>';
              // echo '<td width="5%" align="center"></td>';
            
              echo '<td>' . $result->AY.'</a></td>';
              echo '<td>'. $result->SEMESTER.'</td>';
              echo '<td>'. $result->PARTICULARS.'</td>';
              echo '<td>'. $result->AMOUNT.'</td>';
                echo '<td>' . $result->COURSE.'</a></td>';
                          echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$result->DEFID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
                    
                     </td>';
              echo '</tr>';
            } 
            ?>
         
            </tr> 
            
          </thead> 
          <tbody>
          
           
          </tbody>
        
        </table>


<a href="index.php?view=add&flag=0" class="btn btn-primary btn-xs  "> <i class="fa fa-plus-circle fw-fa"></i> Create Individual Chrages</a>
<a href="index.php?view=add&flag=1" class="btn btn-primary btn-xs  "> <i class="fa fa-plus-circle fw-fa"></i>Add Charges to Group</a>
			
				</form>
	

</div> <!---End of container-->

<script type="text/javascript">
  function Addrow(){
    $('#examples').append('<tr><td><input lass="form-control input-sm" type="text" size="100%" name="charges"></td><td><input lass="form-control input-sm" type="text" name="charges"></td></tr>')
  }
</script>