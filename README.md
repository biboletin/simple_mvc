# Simple(maybe) MVC framework

Easy and simple for usage 

## Installation


```bash
git clone https://github.com/biboletin/mvc.git
```

```bash
cd /path/to/project
```

```bash
composer update
```

```bash
copy/paste/rename config.sample.php to config.php
```

```bash
cd /path/to/project/public
```

**Variant 1**  
Use ```php``` built-in server
```bash
php -S localhost:8000
```
**Variant 2**  
Create virtual host and go to 
```bash
http://hostname
```
## Create/Configure Migrations
Examples:
* Create migrations in Database/Migrations  
Users.php:  

```php
use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('users', function ($table) {
    $table->increments('id');
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->timestamps();
});
```
* Create Users Model in App/Models  
Users.php
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Users extends Eloquent
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'name',
        'email',
        'password',
    ];
}
```
* If not exist create install.php in public directory, else edit it:
```php
include_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../bootstrap.php';
include_once __DIR__ . '/../Database/Migrations/Users.php';

use App\Models\Users;
use Core\Config;

Users::Create([
    'name' => 'username',
    'email' => 'name@example.com',
    'password' => password_hash('password', Config::get('security.algorithm'), [
        'cost' => Config::get('security.cost')
        ]),
]);
```

Now go to http://site-name/install.php

## Notes
Works without hardcoded routes.  
* URL: https://localhost/ControllerName/MethodName/params  
* If URL is https://localhost/ControllerName redirects to 404 page with "ControllerName not found!"
* If URL is https://localhost/ControllerName/MethodName:
    * If MethodName doesn`t exist redirects to 404 page with "MethodName not found!"

## Important!
Use https!  

```php
        /**
         * Set base url
         * Change to https for better use
         */
        'url' => 'https://localhost/',
```
For proper loading javascript and css.


Create if not exists **mvc/tmp/sessions**

## License
[MIT](https://choosealicense.com/licenses/mit/)