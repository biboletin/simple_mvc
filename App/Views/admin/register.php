<?php

use Core\Csrf;
use Core\Session;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="#" />
    <link rel="stylesheet" href="<?php echo assets('css/lib/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo assets('css/register.css'); ?>">
    <title>Register</title>
</head>
<body>


<div class="container register-form">
    <form action="/admin/registerUser" method="post">
        <input type="hidden" name="token" value="<?php echo (new Csrf(new Session()))->generate();?>">
        <div class="form">
            <div class="note">
                <p>Register</p>
            </div>

            <div class="form-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="username"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" name="email"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password"/>
                        </div>
                    </div>
                </div>
                <input type="submit" id="subform" class="btn btnSubmit" value="Register">
            </div>
        </div>

    </form>
</div>

</body>
</html>
