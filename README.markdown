# Dead Simple!

Dead Simple! is an easy to use feature poor blogging application.

## Features

* User Authentication
* Create / Edit / Delete Posts
* Publish / Unpublish Posts

## Setup

Go To /Install - enter relevant information.

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