<?php
    require 'includes/Authentication.php';

    $auth = new Authenticate();
    // echo $_POST['signupSubBut'];
    if( !empty( $_POST['field4'] ) ){
        $fname = $_POST['field4'];
        $lname = $_POST['field3']."";
        $email = $_POST['field2'];
        $psw= $_POST['field1'];
        
        if($auth->signup($fname,$lname,$email,$psw))
            echo 1;
        else echo -1;
    }else if( !empty($_POST['field1']) ){
        $email = $_POST['field1'];
        
        if($auth->forgotPassword($email))
            echo 1;
        else echo -1;
    }

?>