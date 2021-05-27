<?php

    use Core\Csrf;
    use Core\Session;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.ico" type="image/x-icon"> 
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta name="csrf-token" content="<?php echo (new Csrf(new Session()))->generate();?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo config('app.name');?></title>
    <link rel="shortcut icon" href="#" />
    <link rel="stylesheet" href="<?php echo assets('css/index.css')?>">
</head>
<body>
<h1 class="text-center">
    Home page
</h1>

<script src="<?php echo assets('js/index.js')?>"></script>
</body>
</html>
