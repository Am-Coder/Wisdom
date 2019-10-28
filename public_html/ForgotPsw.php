
<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/Index.css">

</head>


<body>

    <div class="form-style">
            <form method="POST" action='Forgot.php' >
            <fieldset>
                <legend><span class="number">1</span> Reset Password </legend>
                <input type='hidden' name='field3' value="<?php echo isset($_GET['email'])?$_GET['email']:''; ?>" >
                <input type='hidden' name='field2' value="<?php echo isset($_GET['token'])?$_GET['token']:''; ?>" >
                <input type="password" name='field1' placeholder="New Passoword" required>
            </fieldset>
                <br><br>
                <input type="submit" value="Reset Password" />
            </form>
    </div>

</body>
</html>