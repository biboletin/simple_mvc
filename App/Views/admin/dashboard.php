<?php
use Core\Session;

Session::start();

var_dump($_SESSION);
if (Session::has('loggedIn') && boolval(Session::get('loggedIn')) === true) {
    echo 'User is logged in!';
} else {
    echo 'User is not logged in! need to redirect!';
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>

</body>
</html>
