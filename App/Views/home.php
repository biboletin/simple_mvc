<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo config('app.name');?></title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
Home page
<br>
<?php
echo '<pre>' . print_r($data, true) . '</pre>';
echo $data[0];
echo config('app.name');
?>

<script src="js/index.js"></script>
</body>
</html>