<?php

    require '../includes/Blog.php';
    require '../includes/Session.php';

    Session::start();
    Session::destroy();
    // header("Location: ../Index.html");
    exit;
?>