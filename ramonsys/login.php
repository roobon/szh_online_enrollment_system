<?php
require_once("include/initialize.php");

 ?>
  <?php
 // login confirmation
  if(isset($_SESSION['ACCOUNT_ID'])){
    redirect(WEB_ROOT."index.php");
  }
  ?>
  


 <!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Admin Panel Login</title>
  
  
    <link rel="icon" href="<?php echo WEB_ROOT; ?>favicon-1.ico" type="image/x-icon">
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <body>
<div class="container">
  <section id="content">
  <?php check_message(); ?>
    <form action="" method="POST">
      <h1>Login</h1>
      <div>
        <input type="text" placeholder="Username" required="" id="username"  name="user_email" />
      </div>
      <div>
        <input type="password" placeholder="Password" required="" id="password" name="user_pass" />
      </div>
      <div>
        <input type="submit" name="btnLogin" value="Log in" />
      
      </div>
    </form><!-- form -->
    <div class="button">
     
    </div><!-- button -->
  </section><!-- content -->
</div><!-- container -->
</body>
  
    <script src="js/index.js"></script>

</body>
</html>



 <?php 

if(isset($_POST['btnLogin'])){
  $email = trim($_POST['user_email']);
  $upass  = trim($_POST['user_pass']);
  $h_upass = sha1($upass);
  
   if ($email == '' OR $upass == '') {

      message("Invalid Username and Password!", "error");
      redirect("login.php");
         
    } else {  
  //it creates a new objects of member
    $user = new User();
    //make use of the static function, and we passed to parameters
    $res = $user::AuthenticateUser($email, $h_upass);
    if ($res==true) { 
       message("You logon as ".$_SESSION['ACCOUNT_TYPE'].".","success");
      if ($_SESSION['ACCOUNT_TYPE']=='Administrator' || $_SESSION['ACCOUNT_TYPE']=='Cashier'){

        $_SESSION['ACCOUNT_ID']       = $_SESSION['ACCOUNT_ID'];
        $_SESSION['ACCOUNT_NAME']     = $_SESSION['ACCOUNT_NAME'] ;
        $_SESSION['ACCOUNT_USERNAME'] = $_SESSION['ACCOUNT_USERNAME'];
        $_SESSION['ACCOUNT_TYPE']     = $_SESSION['ACCOUNT_TYPE'];

          $singledft = new Defaults();
          $assignedSEM = $singledft->single_default_sem();
          $assignedAY = $singledft->single_default_ay();

          $_SESSION['SEMESTER']      =    $assignedSEM->LISTNAME;
          $_SESSION['AY']            =    $assignedAY->LISTNAME;
 
    //    unset( $_SESSION['ACCOUNT_ID'] );
     //   unset( $_SESSION['ACCOUNT_NAME'] );
     //   unset( $_SESSION['ACCOUNT_USERNAME'] );
      //  unset( $_SESSION['ACCOUNT_PASSWORD'] );
      //  unset( $_SESSION['ACCOUNT_TYPE'] );

         redirect(WEB_ROOT."index.php");
      } 
    }else{
      message("Account does not exist! Please contact Administrator.", "error");
       redirect(WEB_ROOT."login.php"); 
    }
 }
 } 
 ?> 
 


