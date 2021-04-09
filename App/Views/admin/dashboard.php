<?php

use Core\Session;

//Session::start();
//if (!Session::has('loggedIn') || boolval(Session::get('loggedIn')) !== true) {
//    \Core\Redirect::to('admin/login');
//}
var_dump($_SESSION);
echo Session::get('loggedIn') ? 'true' : 'false';
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
    <title>Dashboard</title>
</head>
<body>
<?php include __DIR__ . '/navbar.php'; ?>
</body>
</html>
