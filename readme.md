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
│       ├── seeders
│       │   └── User.php
│       └── tests
│           └── Unit
│               └── User.php
```

where ```User``` is a module name

# Usage
```php artisan make:module <name>```
