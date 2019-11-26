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
    }else if(Session::get('email') && isset($_POST['like'])){
        // echo json_encode(array('data'=>$_GET['blogid']));
        $val = $_POST['like'];
        if($val>0)
            $res = $bloger->incLike($_POST['blogid'],Session::get('email'));
        else 
            $res = $bloger->decLike($_POST['blogid'],Session::get('email'));

            $res = json_encode($res);

        echo $res;
        exit;
    }else if(Session::get('email') && isset($_POST['content'])){
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