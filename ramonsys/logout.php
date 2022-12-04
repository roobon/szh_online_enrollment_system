<?php 
require_once 'include/initialize.php';
// Four steps to closing a session
// (i.e. logging out)

// 1. Find the session
@session_start();

// 2. Unset all the session variables
// unset( $_SESSION['USERID'] );
// unset( $_SESSION['FULLNAME'] );
// unset( $_SESSION['USERNAME'] );
// unset( $_SESSION['PASS'] );
// unset( $_SESSION['ROLE'] );
 

unset( $_SESSION['ACCOUNT_ID'] );
unset( $_SESSION['ACCOUNT_NAME'] );
unset( $_SESSION['ACCOUNT_USERNAME'] );
unset( $_SESSION['ACCOUNT_PASSWORD'] );
unset( $_SESSION['ACCOUNT_TYPE'] );
// 4. Destroy the session
// session_destroy();
redirect(WEB_ROOT."login.php?logout=1");
?>