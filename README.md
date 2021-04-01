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
## Notes
Works without hardcoded routes.  
* URL: https://localhost/ControllerName/MethodName/params  
* If URL is https://localhost/ControllerName redirects to 404 page with "ControllerName not found!"
* If URL is https://localhost/ControllerName/MethodName:
    * If MethodName doesn`t exist redirects to 404 page with "MethodName not found!"

##Important!
Use https!
```phpregexp
        /**
         * Set base url
         * Change to https for better use
         */
        'url' => 'https://localhost/',
```
For proper loading javascript and css
## License
[MIT](https://choosealicense.com/licenses/mit/)