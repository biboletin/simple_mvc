<?php
    use Core\Csrf;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo assets('css/lib/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo assets('css/login.css');?>">
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
<!--
        <div class="fadeIn first">
            <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
        </div>
-->
        <h3 class="text-center">Login</h3>
        <!-- Login Form -->
        <form name="" action="/admin/auth" method="post">
            <input type="hidden" name="token" id="token" value="<?php echo Csrf::generate();?>">
            <input type="text" id="login" class="fadeIn second" name="username" placeholder="Username">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

    </div>
</div>
</body>
</html>
