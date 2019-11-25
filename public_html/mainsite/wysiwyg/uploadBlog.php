<?php

    require '../../includes/Blog.php';
    require_once '../../includes/Session.php';

    // Session::start();
    $bloger = new Blog();
    Session::start();
    if(isset($_POST['info']) && Session::get('email')){
        // $data = json_decode($_POST['name']);
        // print_r($data);
        echo json_encode(array('data'=>$_POST['info']));
        $bloger->addBlog($_POST['title'],$_POST['url'],$_POST['info'],$_POST['genre'],Session::get('email'));
        exit;
    }
    // echo (array(['YES'=>"NO"]));
    echo -1;
?>