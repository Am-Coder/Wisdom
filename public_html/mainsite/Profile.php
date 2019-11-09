<?php 
    require '../includes/Blog.php';
    require_once '../includes/Session.php';

    Session::start();
    $bloger = new Blog();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Me</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/layout/scripts/jquery.min.js"></script>

    <style>

        body{
            background-color: gray; /*  */
        }
        .grid-container{
            width:400px;
            margin:auto auto;


        }

        /* .ProfilePic{
            box-shadow: 10px 10px 10px gray;
        } */

        .ProfileData{
            background-color: white; /* Green */
            box-shadow: 0px 0px 10px 10px white;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            color: #2A1B3D;

        }

        .ProfileData div{
            margin:20px;
        }
        .button {
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 10px;
            margin: 4px 2px;
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }
        .buttonPsw {
            background-color: white;
            color: #2A1B3D;
            /* border: 2px solid #555555; */
            border-radius: 50%;
        }

        .buttonPsw:hover {
            background-color: #555555;
            color: white;
        }

        .info{
            text-align: left;
        }

        .rename{
            text-decoration:none;
            color:
        }

    </style>
</head>

<body>
    
<div class='grid-container'>

    
    <div class="ProfileData">
            <div class='ProfilePic'>
                    <img src="../img/images/defaultProfile.png">
                </div >     
        <div id='name'>
            <span style='font-weight:bold; font-size:30px'>
                <span id='fname'><?php echo Session::get('firstname')." "?></span> 
                
                <span id='lname'><?php echo Session::get('lastname') ?></span>
            </span>
            <!-- <small><a href='#' class='rename'>Rename</a></small> -->
            <small>
                <button class='button buttonPsw'>Rename</button>
            </small>
            <br>
            <br>

            <small><?php echo Session::get('email') ?></small>
        </div>
        <div class='info'>
            <!-- <div> Followers: <span></span></div> -->
            <!-- <div> Following: <span></span></div> -->
            <div> Blogs:<span > <?php echo $bloger->fetchTotalBlogsByEmail(Session::get('email')) ?> </span></div>
            <div> Likes: <span > <?php echo $bloger->fetchLikesByEmail(Session::get('email')) ?> </span></div>
        </div>    

        <br>
        <br>
    </div>
    
    <div class='RenameForm'>

        
    </div>
    
</div>
    <script>
        $(document).ready(function(){
            $('.buttonPsw').click(function(){
                // alert($('.buttonPsw').text());
                // $('.buttonPsw').html('Done');

                if($('.buttonPsw').text() == 'Rename'){
                    alert('hi');
                    $('#fname').attr('contentEditable', true);
                    $('#lname').attr('contentEditable', true);
                    $('.buttonPsw').html('Done');
                    $('#fname').focus();
                }else if($('.buttonPsw').text() == 'Done'){
                    alert('Done');
                    $('#fname').attr('contentEditable', false);
                    $('#lname').attr('contentEditable', false);
                    $('.buttonPsw').html('Rename');
                    var fname = $('#fname').text();
                    var lname = $('#lname').text();
                    $.ajax({
                        type : "GET",
                        cache: false,
                        // contentType : "application/json",//type of data being send to server
                        url : "Rename.php?fname=" + fname+ "&lname="+ lname,
                        // data : JSON.stringify({email: $("#email").val()}),
                        
                        dataType : "json",//result expected from server
                                        //with json return type we can return java objects
                                        //With text we can return String from java conroller
                        timeout : 100000,
                        success : function(data) {

                            console.log(data);
                            $('#fname').html(data.fname);
                            $('#lname').html(data.lname);
                        },
                        error : function(e) {
                            console.log("ERROR: ", e);
                        },
                        complete : function(e) {
                            
                        }
                    });
                }else{
                    $('#fname').attr('contentEditable', false);
                    $('#lname').attr('contentEditable', false);

                }


            })
        })
    </script>
</body>
</html>