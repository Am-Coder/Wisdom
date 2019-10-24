
<?php

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome to Land of Wisdom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <style>

        body{
            background-attachment: fixed;
            background-image: url('img/Index2.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .form-style{
          position: relative;
          max-width: 300px;
          padding: 10px 20px;
          background: #f4f7f8;
          margin: 50px auto;
          padding: 20px;
          background: #f4f7f8;
          border-radius: 8px;
          font-family: Georgia, "Times New Roman", Times, serif;
          opacity: 0.75;
        }
        .form-style fieldset{
          border: none;
        }
        .form-style legend {
          font-size: 1.4em;
          margin-bottom: 10px;
        }
        .form-style label {
          display: block;
          margin-bottom: 8px;
        }
        .form-style input[type="text"],
        .form-style input[type="date"],
        .form-style input[type="datetime"],
        .form-style input[type="email"],
        .form-style input[type="number"],
        .form-style input[type="search"],
        .form-style input[type="time"],
        .form-style input[type="url"],
        .form-style input[type="password"],
        .form-style textarea,
        .form-style select {
          font-family: Georgia, "Times New Roman", Times, serif;
          background: rgba(255,255,255,.1);
          border: none;
          border-radius: 4px;
          font-size: 15px;
          margin: 0;
          outline: 0;
          padding: 10px;
          width: 100%;
          box-sizing: border-box; 
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box; 
          background-color: #e8eeef;
          color:#8a97a0;
          -webkit-box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
          box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
          margin-bottom: 30px;
        }
        .form-style input[type="text"]:focus,
        .form-style input[type="date"]:focus,
        .form-style input[type="datetime"]:focus,
        .form-style input[type="email"]:focus,
        .form-style input[type="number"]:focus,
        .form-style input[type="search"]:focus,
        .form-style input[type="time"]:focus,
        .form-style input[type="url"]:focus,
        .form-style input[type="password"]:focus,
        .form-style textarea:focus,
        .form-style select:focus{
          background: #d2d9dd;
        }
        .form-style select{
          -webkit-appearance: menulist-button;
          height:35px;
        }
        .form-style .number {
          background: #1abc9c;
          color: #fff;
          height: 30px;
          width: 30px;
          display: inline-block;
          font-size: 0.8em;
          margin-right: 4px;
          line-height: 30px;
          text-align: center;
          text-shadow: 0 1px 0 rgba(255,255,255,0.2);
          border-radius: 15px 15px 15px 0px;
        }

        .form-style input[type="submit"],
        .form-style input[type="button"]
        {
          position: relative;
          display: block;
          padding: 19px 39px 18px 39px;
          color: #FFF;
          margin: 0 auto;
          background: #1abc9c;
          font-size: 18px;
          text-align: center;
          font-style: normal;
          width: 100%;
          border: 1px solid #16a085;
          border-width: 1px 1px 3px;
          margin-bottom: 10px;
        }
        .form-style input[type="submit"]:hover,
        .form-style input[type="button"]:hover
        {
          background: #109177;
        }


        /* Forgot Password */

          a,a:visited,a:hover,a:active{
            -webkit-backface-visibility:hidden;
                    backface-visibility:hidden;
            position:relative;
            transition:0.5s color ease;
            text-decoration:none;
            color:black;
            font-size:0.7em;
          }

          a:hover{
            color:#d78b34;
          }
          a.before:before,a.after:after{
            content: "";
            transition:0.5s all ease;
            -webkit-backface-visibility:hidden;
                    backface-visibility:hidden;
            position:absolute;
          }
          a.before:before{
            top:-0.25em;
          }
          a.after:after{
            bottom:-0.25em;
          }
          a.before:before,a.after:after{
            height:1px;
            width:0;
            background:#d78b34;
          }

          a.third:after{
            left:50%;
            -webkit-transform:translateX(-50%);
                    transform:translateX(-50%);
          }

          a.before:hover:before,a.after:hover:after{
            width:100%;
          }

          #signup,#forgotpassword{
            display: none;
          }
    </style>
</head>
<body>
  <div id = 'signin'>
      <div class="form-style">
          <form method="POST">
            <fieldset>
              <legend><span class="number">1</span>  Sign In </legend>
              <input type="email" name="field2" placeholder="Your Email *" required>
              <input type="password" name="field1" placeholder="Your Password *" required>

              <div class="wrapper">
                  <a class="third after forgot-password" href="#!">Forgot Password</a>
                  <br><br>
                  <a class="third after newhere" href="#!">New here ...</a>
              </div>

            </fieldset>
            <br>
            <br>
            <!-- <br>
            <fieldset>
            <legend><span class="number">2</span> Additional Info</legend>
            <textarea name="field3" placeholder="Your Interests"></textarea>
            </fieldset> -->
            <input type="submit" value="Let's Jump In" />
          </form>
      </div>
  </div>

  <div id = 'signup'>
        
      <div class="form-style">
          <form method="POST">
          <fieldset>
            <legend><span class="number">1</span>  Sign Up </legend>
            <input type="email" name="field2" placeholder="Your Email *" required>
            <input type="text" name="field1" placeholder="Your Password *" required>

            <div class="wrapper">
                <a class="third after gotosignin" href="#!">Already a Member..</a>
            </div>
          </fieldset>
          <input type="submit" value="Let's Get Started" />
          </form>
      </div>

  </div>

  <div id = 'forgotpassword'>
      <div class="form-style">
          <form method="POST">

          <fieldset>
            <legend><span class="number">1</span>  Forgot Password </legend>
            <input type="email" name="field2" placeholder="Give Your Email *" required>
          </fieldset>

          <input type="submit" value="Send Mail" />
          </form>
          <div class="wrapper">
              <a class="third after gotosignin" href="#!">Go To Sign In</a>
          </div>
      </div>

  </div>


    <script >
    $(document).ready(function(){
        $('.form-style').on( 'mouseenter' ,function(){
          $('.form-style').animate({opacity:'1'},100);
        })
        $('.form-style').on( 'mouseleave' ,function(){
          $('.form-style').animate({opacity:'0.75'},100);
        })

        $('.forgot-password').click(function(){
          $('#signin,#signup').hide();
          $('#forgotpassword').show();
        })

        $('.newhere').click(function(){
          $('#signin,#forgotpassword').hide();
          $('#signup').show();
        })

        $('.gotosignin').click(function(){
          $('#forgotpassword,#signup').hide();
          $('#signin').show();
        })
    });


    </script>

</body>
</html>

?>

<!-- <div class="form-style">
    <form>
    <fieldset>
      <legend><span class="number">1</span>  Log In </legend>
      <input type="text" name="field1" placeholder="Your Name *">
      <input type="email" name="field2" placeholder="Your Email *">
      <textarea name="field3" placeholder="About yourself"></textarea>
      <label for="job">Interests:</label>
      <select id="job" name="field4">
        <optgroup label="Indoors">
          <option value="fishkeeping">Fishkeeping</option>
          <option value="reading">Reading</option>
          <option value="boxing">Boxing</option>
          <option value="debate">Debate</option>
          <option value="gaming">Gaming</option>
          <option value="snooker">Snooker</option>
          <option value="other_indoor">Other</option>
        </optgroup>
        <optgroup label="Outdoors">
          <option value="football">Football</option>
          <option value="swimming">Swimming</option>
          <option value="fishing">Fishing</option>
          <option value="climbing">Climbing</option>
          <option value="cycling">Cycling</option>
          <option value="other_outdoor">Other</option>
        </optgroup>
      </select>      
    </fieldset>
    <fieldset>
    <legend><span class="number">2</span> Additional Info</legend>
    <textarea name="field3" placeholder="About Your School"></textarea>
    </fieldset>
    <input type="submit" value="Apply" />
    </form>
</div> -->