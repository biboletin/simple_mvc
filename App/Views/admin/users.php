
<h1>User:</h1>
Id: <?php

use Core\Csrf;

echo $data['id']; ?>
<br/>
Name: <?php echo $data['name']; ?>

<form action="/admin/users/" method="post">
    <input type="hidden" name="token" id="token" value="<?php echo (new Csrf())->generate(); ?>" />
    <input type="text" name="username" />
    <input type="text" name="age" />
    <input type="button" value="Log" id="log" />
</form>

<script src="<?php echo assets('js/index.js') ?>"></script>
<script>
document.getElementById('log').onclick = function () {
    ajax({
        method: 'post',
        url: '/admin/users/',
        data: {
            id: 73,
            token: document.getElementById('token').value
        }
    }, function (response) {
        console.log(response);
    });

};
</script>
