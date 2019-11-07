<?php
   
    require_once '../includes/Blog.php';
    require_once '../includes/Session.php';

    $bloger = new Blog();
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    Session::start();
    $email = Session::get('email');

    if($bloger->renameByEmail($email,$fname,$lname)){
        // $bloger->renameByEmail($email,$fname,$lname);
        Session::start();
        $username = array('fname'=>Session::get('firstname'), 'lname'=>Session::get('lastname'));
        echo json_encode($username);
        exit;
    }
    $username = array('fname'=>$email, 'lname'=>'B');
    echo json_encode($username);

?>