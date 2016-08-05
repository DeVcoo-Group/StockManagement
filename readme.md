# Stock Controlling Management

- Using With Laravel Framework version 5.2.26

### Run script on terminal

> $ composer install
>
> $ sudo npm install --global gulp-cli
>
> $ sudo npm install -g bower
>
> $ npm install
>
> $ bower install
>
> $ gulp --production

### PHP
- Active extension redis.so
    > Go to php.ini add extension = redis.so

- Configure
    - .env
    - config/database.php, cofigure database and redis server

    ```
    ...
    'default' => env('DB_CONNECTION', 'pgsql'),
    ...

    'redis' => [

        'cluster' => false,

        'default' => [
            'host' => env('REDIS_HOST', 'localhost'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ]
    ```
