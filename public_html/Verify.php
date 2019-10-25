<?php 
    require 'includes/AuthenticationService.php';

    $auth = new AuthService();
    $email = $_GET['email'];
    $token = $_GET['token'];
    if( $auth->verifyAccount($token,$email) ){
        echo "<h1>Account Verified Successfully</h1>";
    }else{
        echo "<h1>Account Verification Failed</h1>";
        echo "<h3>Try Recreating your account</h3>";
        
    }

?>