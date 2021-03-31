<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo assets('css/lib/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo assets('css/register.css'); ?>">
    <title>Register</title>
</head>
<body>


<div class="container register-form">
    <div class="form">
        <div class="note">
            <p>This is a simpleRegister Form made using Boostrap.</p>
        </div>

        <div class="form-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Name *" value=""/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone Number *" value=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Password *" value=""/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Confirm Password *" value=""/>
                    </div>
                </div>
            </div>
            <button type="button" class="btnSubmit">Submit</button>
        </div>
    </div>
</div>

</body>
</html>