
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo $title; ?></title>
 

 <!-- Bootstrap Core CSS -->
    <link href="<?php echo WEB_ROOT; ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo WEB_ROOT; ?>/css/sb-admin.css" rel="stylesheet">


    <link href="<?php echo WEB_ROOT; ?>/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

    <link href="<?php echo WEB_ROOT; ?>/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"> 

    <!-- Custom Fonts -->
    <link href="<?php echo WEB_ROOT; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> 

    <!-- light box -->
    <link href="<?php echo WEB_ROOT; ?>/css/ekko-lightbox.css" rel="stylesheet">


    <link rel="icon" href="<?php echo WEB_ROOT; ?>favicon-1.ico" type="image/x-icon">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> 


</head>


  <?php
   //admin_confirm_logged_in();
  if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(WEB_ROOT."/login.php");
     } 
?>
      
<body>
 
 
<div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo WEB_ROOT;?>">RMMCM Inc. Online Enrollment System</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
 
                <!-- account -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['ACCOUNT_NAME']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo WEB_ROOT; ?>/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
                <!-- end account -->
            </ul> 
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav"> 
<?php if ($_SESSION['ACCOUNT_TYPE']=='Administrator') { ?> 
                   <li data-toggle="collapse" class="collapsed  <?php echo (currentpage() == 'user') ? "active" : false;?>" data-target="#entry" >
                      <a href="#"><span class="glyphicon glyphicon-pencil"> </span>      Entry</a>
                        <ul class="sub-menu collapse" id="entry">
                          <li class="<?php echo (currentpage() == 'user') ? "active" : false;?>"> <a href="<?php echo WEB_ROOT; ?>student/">Student</a></li>
                          <li class="<?php echo (currentpage() == 'user') ? "active" : false;?>"><a href="<?php echo WEB_ROOT; ?>subject/">Subject</a></li>
                          <li class="<?php echo (currentpage() == 'user') ? "active" : false;?>"><a href="<?php echo WEB_ROOT; ?>course/">Course</a></li>
                          <li class="<?php echo (currentpage() == 'user') ? "active" : false;?>"><a href="<?php echo WEB_ROOT; ?>faculty/">Faculty</a></li>
                         
                        </ul>  

                    </li>
                   
                   <li class="<?php echo (currentpage() == 'category') ? "active" : false;?>">
                        <a href="<?php echo WEB_ROOT; ?>inquiry/"><i class="fa fa-fw fa-table"></i> Student Inquiry</a>
                    </li>
                    <li class="<?php echo (currentpage() == 'category') ? "active" : false;?>">
                        <a href="<?php echo WEB_ROOT; ?>enrollment/"><i class="fa fa-fw fa-table"></i> Enrollment</a>
                    </li>
                      <li class="<?php echo (currentpage() == 'category') ? "active" : false;?>">
                        <a href="<?php echo WEB_ROOT; ?>facultyloading/"><i class="fa fa-fw fa-table"></i> Faculty Subject Loading</a>
                    </li>
                   
                      <li class="<?php echo (currentpage() == 'category') ? "active" : false;?>">
                        <a href="<?php echo WEB_ROOT; ?>soa/"><i class="fa fa-fw fa-table"></i> Statement of Account</a>
                    </li>
                      <li class="<?php echo (currentpage() == 'category') ? "active" : false;?>">
                        <a href="<?php echo WEB_ROOT; ?>defaultcharges/"><i class="fa fa-fw fa-table"></i> Settings for Charges</a>
                    </li>
                      <li class="<?php echo (currentpage() == 'category') ? "active" : false;?>">
                        <a href="<?php echo WEB_ROOT; ?>billing/"><i class="fa fa-fw fa-table"></i> Billing</a>
                    </li>
<?php } ?>
<?php if ($_SESSION['ACCOUNT_TYPE']=='Cashier') { ?> 
                    <li class="<?php echo (currentpage() == 'category') ? "active" : false;?>">
                        <a href="<?php echo WEB_ROOT; ?>enrollment/"><i class="fa fa-fw fa-table"></i> Assessment</a>
                    </li>
                     <li class="<?php echo (currentpage() == 'category') ? "active" : false;?>">
                        <a href="<?php echo WEB_ROOT; ?>defaultcharges/"><i class="fa fa-fw fa-table"></i> Settings for Charges</a>
                    </li>
                      <li class="<?php echo (currentpage() == 'category') ? "active" : false;?>">
                        <a href="<?php echo WEB_ROOT; ?>soa/"><i class="fa fa-fw fa-table"></i> Statement of Account</a>
                    </li>
                     <li class="<?php echo (currentpage() == 'category') ? "active" : false;?>">
                        <a href="<?php echo WEB_ROOT; ?>billing/"><i class="fa fa-fw fa-table"></i> Billing</a>
                    </li>
<?php } ?>                    
<?php if ($_SESSION['ACCOUNT_TYPE']=='Administrator') { ?> 
                    <li class="<?php echo (currentpage() == 'user') ? "active" : false;?>">
                        <a href="<?php echo WEB_ROOT; ?>user/"><i class="fa fa-fw fa-user"></i> Manage Users</a>
                    </li>
                    <li data-toggle="collapse" class="collapsed  <?php echo (currentpage() == 'user') ? "active" : false;?>" data-target="#settings" >
                        <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        <ul class="sub-menu collapse" id="settings">
                          <li class="<?php echo (currentpage() == 'user') ? "active" : false;?>"> <a href="<?php echo WEB_ROOT; ?>settings/">Defaults</a></li>
                            <li class="<?php echo (currentpage() == 'user') ? "active" : false;?>"> <a href="<?php echo WEB_ROOT; ?>room/">Rooms</a></li>
                          
                        </ul>  
                    </li>
<?php } ?>
<?php if ($_SESSION['ACCOUNT_TYPE']=='Administrator' || $_SESSION['ACCOUNT_TYPE']=='Cashier') { ?>
                    <li class="<?php echo (currentpage() == 'report') ? "active" : false;?>">
                        <a href="<?php echo WEB_ROOT; ?>report"><i class="fa fa-fw fa-bar-chart-o"></i> Report</a>
                    </li>  
<?php } ?>
<?php if ($_SESSION['ACCOUNT_TYPE']=='Encoder') { ?> 
                    <li data-toggle="collapse" class="collapsed  <?php echo (currentpage() == 'user') ? "active" : false;?>" data-target="#entry" >
                      <a href="#"><span class="glyphicon glyphicon-pencil"> </span>      Entry</a>
                        <ul class="sub-menu collapse" id="entry">
                          <li class="<?php echo (currentpage() == 'user') ? "active" : false;?>"> <a href="<?php echo WEB_ROOT; ?>student/">Student</a></li>
                          <li class="<?php echo (currentpage() == 'user') ? "active" : false;?>"><a href="<?php echo WEB_ROOT; ?>subject/">Subject</a></li>
                          <li class="<?php echo (currentpage() == 'user') ? "active" : false;?>"><a href="<?php echo WEB_ROOT; ?>course/">Course</a></li>
                          <li class="<?php echo (currentpage() == 'user') ? "active" : false;?>"><a href="<?php echo WEB_ROOT; ?>faculty/">Faculty</a></li>
                         
                        </ul>  

                    </li>
                     <li class="<?php echo (currentpage() == 'category') ? "active" : false;?>">
                        <a href="<?php echo WEB_ROOT; ?>enrollment/"><i class="fa fa-fw fa-table"></i> Enrollment</a>
                    </li>
<?php } ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
               <div class="row" > 

                   <?php   check_message();  ?>   

                  <?php require_once $content; ?> 
              </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


<!-- jQuery --> 
<script src="<?php echo WEB_ROOT; ?>/jquery/jquery.min.js"></script> 
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo WEB_ROOT; ?>/js/bootstrap.min.js"></script>

<script src="<?php echo WEB_ROOT; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo WEB_ROOT; ?>/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo WEB_ROOT; ?>/js/bootstrap-datepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo WEB_ROOT; ?>/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo WEB_ROOT; ?>/js/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>

<script type="text/javascript" src="<?php echo WEB_ROOT; ?>/js/janobe.js" charset="UTF-8"></script> 

<script src="<?php echo WEB_ROOT; ?>/js/ekko-lightbox.js"></script>
<script src="<?php echo WEB_ROOT; ?>/js/lightboxfunction.js"></script> 
<script>
  function checkall(selector)
  {
    if(document.getElementById('chkall').checked==true)
    {
      var chkelement=document.getElementsByName(selector);
      for(var i=0;i<chkelement.length;i++)
      {
        chkelement.item(i).checked=true;
      }
    }
    else
    {
      var chkelement=document.getElementsByName(selector);
      for(var i=0;i<chkelement.length;i++)
      {
        chkelement.item(i).checked=false;
      }
    }
  }
   function checkNumber(textBox){
        while (textBox.value.length > 0 && isNaN(textBox.value)) {
          textBox.value = textBox.value.substring(0, textBox.value.length - 1)
        }
        textBox.value = trim(textBox.value);
      }
  function calculate(){  

     var noofunits = document.getElementById('noofunits').value; 
     var perunit = document.getElementById('perunit').value; 
     var NoofLabor = document.getElementById('nooflab').value; 
     var AmountPerLab = document.getElementById('amountlab').value; 
   
    var TotPertunit = parseInt(noofunits) * parseInt(perunit);
     var TotamountLab = parseInt(NoofLabor) * parseInt(AmountPerLab);

     var Totamounts = parseInt(TotPertunit) + parseInt(TotamountLab);

    document.getElementById('Totamount').value = Totamounts;
     document.getElementById('Totamount').value = Math.round((parseInt(Totamounts)));  
  }
  function calculateCashier(){  

     var totpayables = document.getElementById('totalpayables').value; 
     var amountRecieved = document.getElementById('amountrecieved').value; 
   //  var Change = document.getElementById('Change').value; 
    
    var TotChange =  parseInt(amountRecieved) - parseInt(totpayables);
    
    document.getElementById('Change').value = TotChange;
     document.getElementById('Change').value = Math.round((parseInt(TotChange)));  
  }
   function checkText(textBox)
      {
        var alphaExp = /^[a-zA-Z]+$/;
        while (textBox.value.length > 0 && !textBox.value.match(alphaExp)) {
          textBox.value = textBox.value.substring(0, textBox.value.length - 1)
        }
        textBox.value = trim(textBox.value);
      }
  function calculate(){  

     var first = document.getElementById('first').value; 
     var second = document.getElementById('second').value; 
     var third = document.getElementById('third').value;  

    var totalVal = parseInt(first) + parseInt(second) + parseInt(third)  ;
    document.getElementById('finalave').value = totalVal;
     document.getElementById('finalave').value = Math.round((parseInt(totalVal)/3));  
        }
  </script>   
</body>
</html>