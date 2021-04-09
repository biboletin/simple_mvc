<?php
use Core\Csrf;
use Core\Session;

//Session::start();
//if (!Session::has('loggedIn') || boolval(Session::get('loggedIn')) !== true) {
//    \Core\Redirect::to('admin/login');
//}
var_dump($_SESSION);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo assets('css/lib/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo assets('css/navbar.css')?>">
    <title>About</title>
</head>
<body>
<?php include __DIR__ . '/../navbar.php';?>
<div class="content-container">
<h1 class="text-center">About</h1>
    <div class="container-fluid">
        <form role="form" action="/about/addEditInfo" method="post">
            <input type="hidden" name="token" id="token" value="<?php echo Csrf::generate();?>">
            <div class="form-group">
                <textarea name="about" id="about" class="form-control" rows="3" placeholder="About"><?php echo trim($data['about']);?></textarea>
            </div>

            <input type="submit" class="btn btn-success" value="Add/Edit">
        </form>
    </div>
</div>
</body>
</html>