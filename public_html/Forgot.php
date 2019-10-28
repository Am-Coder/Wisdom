<?php 


    require 'includes/AuthenticationService.php';
    $auth = new AuthService();
    
    $email = $_POST['field3'];
    $token = $_POST['field2'];
    $psw = $_POST['field1'];

    if( $auth->resetPasswordByEmail($psw,$token,$email) ){
        echo 'Password Reset Done';
        echo $email;
        echo $token;
        echo $psw;
    }
    else{
        echo 'Password Reset Failed';
        echo $email;
        echo $token;
        echo $psw;
    }
?>