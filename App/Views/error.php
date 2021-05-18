<?php
    $error = '';
switch (http_response_code()) {
    case 400:
        $error = 'Bad Request!';
        break;
    case 404:
        $error = 'The page you are looking for was not found!';
        break;
    case 500:
        $error = 'Server error!';
        break;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="#" />
    <link rel="stylesheet" href="<?php echo assets('css/lib/bootstrap.min.css');?>">
    <title>Error</title>
</head>
<body>
<div class="page-wrap d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block">
                    <?php echo http_response_code(); ?>
                </span>
                <div class="mb-4 lead">
                    <?php echo $error; ?>
                </div>
                <a href="/" class="btn btn-link">Back to Home</a>

            </div>
        </div>
    </div>
</div>
</body>
</html>
