# Overview 
Simple package that creates ```module``` structure in root directory like 
```
├── modules
│   └── User
│       ├── Controllers
│       │   └── User.php
│       ├── Models
│       │   └── User.php
│       ├── Requests
│       │   └── User.php
│       ├── Resources
│       │   └── User.php
│       ├── routes
│       │   └── User.php
│       ├── seeders
│       │   └── User.php
│       └── tests
│           └── Unit
│               └── User.php
```

where ```User``` is a module name

# Usage

## Create module
Run artisan command 
```php artisan make:module <name>``` 
where `<name>` is a module name

## Add module routes
You can add module routes using macro  
```Route::module('<name>')```  

If you have several route files in module, you can add it providing second parameter to macro
```Route::module('<name>','<route filename>')```

### Examples

#### Using module name  

```Route::module('User')``` will include file  ```modules/User/routes/User.php```

#### Using module name and route filename

```
Route::module('User','web');
Route::module('User','api');
```

will include files  
```
modules/User/routes/web.php
modules/User/routes/api.php
```

