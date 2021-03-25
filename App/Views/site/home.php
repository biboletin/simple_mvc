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
<form method="post">
    <input type="text" name="index" id="index">
    <input type="button" name="btn" id="btn" value="submit">
</form>

<?php
    echo $data;
    echo '<pre>' . print_r($data, true) . '</pre>';
?>



<script src="<?php echo assets('js/index.js')?>"></script>
</body>
</html>
