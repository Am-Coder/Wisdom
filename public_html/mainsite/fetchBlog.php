<?php

    require '../includes/Blog.php';

    $bloger = new Blog();
    $page = (int)$_GET['page'];
    $genre = $_GET['type'];
    if( $page == 0 && $genre == 'all' ){
        $res = $bloger->fetchAll($page);

    }else {
        $res= $bloger->fetchByGenre($page,$genre);
    }
    // print_r($res);
    // header('Content-Type: application/json');
    $res = json_encode($res);
    echo $res;
    exit;
?>