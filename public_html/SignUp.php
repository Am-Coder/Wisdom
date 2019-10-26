<?php
    require 'includes/Authentication.php';

    $auth = new Authenticate();
    
    if( !empty($_POST('signinSub')) ){
        $fname = $_POST['field4'];
        $lname = $_POST['field3']."";
        $email = $_POST['field2'];
        $psw= $_POST['field1'];
        
        if($auth->signup($fname,$lname,$email,$psw))
            echo 1;
        else echo -1;
    }

    if( !empty($_POST('forgotSub')) ){
        $email = $_POST['field1'];
        
        if($auth->forgotPassword($email))
            echo 1;
        else echo -1;
    }

?>