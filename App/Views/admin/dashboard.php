<?php

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
    <link rel="stylesheet" href="<?php echo assets('css/navbar.css')?>">
    <title>Dashboard</title>
</head>
<body>
<?php include __DIR__ . '/navbar.php'; ?>
<div class="container">
<?php
if ((new Session())->get('loggedIn')) {
    echo 'user is logged in';
} else {
    echo 'user is not logged';
}
?>
</div>
</body>
</html>
