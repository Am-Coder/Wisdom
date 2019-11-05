<?php
    require 'includes/Authentication.php';
    require 'includes/Session.php';

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
    }else if( !empty($_POST['field2']) ){
        $email = $_POST['field2'];
        $psw = $_POST['field1'];
        $user = $auth->signin($email,$psw);
        if($user){
            Session::start();
            Session::set('firstname',$user['firstname']);
            Session::set('lastname',$user['lastname']);
            Session::set('email',$user['email']);
            // header("Location: mainsite/index.php");
            echo Session::display();
        }
        else{
            Session::destroy(); 
            // print "<script> alert('Username or Password incorrect')</script>";
            // header("Location: index.html");
            echo -1;
        }
    }else if( !empty($_POST['field1']) ){
        $email = $_POST['field1'];
        
        if($auth->forgotPassword($email))
            echo 1;
        else echo -1;
    }
?>