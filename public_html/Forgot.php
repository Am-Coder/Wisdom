<?php 


    require 'includes/AuthenticationService.php';

    $auth = new AuthService();
    
    $email = $_POST['field3'];
    $token = $_POST['field2'];
    $psw = $_POST['field1'];

    if( auth.resetPasswordByEmail($psw,$token,$email) ){
        echo 'Password Reset Done';
    }
    else
        echo 'Password Reset Failed';

?>