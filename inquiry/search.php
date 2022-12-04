<?php 
if (!isset($_SESSION['ACCOUNT_ID'])){
 redirect(web_root."admin/index.php");
 }


?> 

<div class="row">
	<div class="col-lg-4">
	</div>	

	<div class="col-lg-4">
		<div class="panel panel-primary">
				<div class="panel-heading">
			    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Search Student Using ID Number</h3>
			  </div>
			  <div class="panel-body">
				<div class="col-lg-12">
					<form class="navbar-form navbar-left" id="lets_search" action="index.php?view=list" method="POST">
			      <div class="form-group">
			        <input type="text"  size="30" name="txtsearch" id="txtsearch" class="form-control" placeholder="Search">
			      </div>
			       <button type="submit" name="search" class="btn btn-default">  <span class="glyphicon glyphicon-search"></span></button></span>
			      
			    </form>
				</div>				  	
			  </div>	
		</div>	
	</div>	

	<div class="col-lg-4">
	</div>	
	

</div>