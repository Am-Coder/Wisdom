<?php

    require '../includes/Blog.php';
    require_once '../includes/Session.php';

    $bloger = new Blog();
    $page = (int)$_GET['page'];
    $genre = $_GET['type'];
    if( $page == 0 && $genre == 'all' ){
        $res = $bloger->fetchAll($page);

    }else if($genre == 'me'){
        
        Session::start();
        $email = Session::get('email');
        // print_r($email);
        if($email)
            $res = $bloger->fetchByEmail($email);
        else{    
            echo -1;
            exit;
        }

    }else {
        
        $res= $bloger->fetchByGenre($page,$genre);
    }
    // print_r($email);
    // header('Content-Type: application/json');
    $res = json_encode($res);
    echo $res;
    exit;
?>