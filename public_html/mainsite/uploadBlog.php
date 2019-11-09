<?php

    require '../includes/Blog.php';
    require_once '../includes/Session.php';

    Session::start();
    $bloger = new Blog();
    if(isset($_POST['data'])){
        $data = json_decode($_POST['data']);

        echo json_encode($data);
    }
?>