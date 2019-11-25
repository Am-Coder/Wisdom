<?php

    require '../../includes/Blog.php';
    require_once '../../includes/Session.php';

    Session::start();
    $bloger = new Blog();
    Session::start();

    if(Session::get('email') && isset($_GET['com'])){
        // echo json_encode(array('data'=>$_GET['blogid']));
        $res = $bloger->fetchCommentsById($_GET['blogid']);
        $res = json_encode($res);
        echo $res;
        exit;
    }if(Session::get('email') && isset($_POST['content'])){
        // echo json_encode(array('data'=>$_GET['blogid']));
        $res = $bloger->addCommentById($_POST['blogid'],Session::get('email'),$_POST['content']);
        exit;
    }else if(Session::get('email') && isset($_GET['blogid'])){
        // echo json_encode(array('data'=>$_GET['blogid']));
        $res = $bloger->fetchById($_GET['blogid']);
        $res = json_encode($res);
        echo $res;
        exit;
    }
    // echo (array(['YES'=>"NO"]));
    echo -1;
?>