# Dead Simple!

Dead Simple! is an easy to use feature poor blogging application.

## Features

* User Authentication
* Create / Edit / Delete Posts
* Publish / Unpublish Posts

## Setup

Open up index.php

Change the SITE_URL constant to the url of your blog
```php
    define('SITE_URL', 'http://path/to/your/blog/');
```

Create a database and run App/config/schema.sql

Open up App/config/database.php and modify database information to match your database.

## Login

test@test.com / 123123

Dead Simple! currently does not support email / password changes.

Modify database. To make a valid hash. At the bottom of index.php add the following code.

```php
    echo Bcrypt::hash('password');
```

Copy hash into users table.


## If blog doesn't load

* Check the APP_PATH constant
* File a bug on github or fix it yourself