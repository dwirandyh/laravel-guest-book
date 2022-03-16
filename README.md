# Laravel Guest Book

## Prerequisite
- Laradock

## Installation

### Install Laradock
Laradock is used for development environment
- Clone laradock in root directory
```git clone https://github.com/laradock/laradock.git```

- Edit website configuration
```cp .env.example .env```

- Change the APP_CODE_PATH_HOST variable to your project path.
```APP_CODE_PATH_HOST=../guest_book/```

- Run Laradock
```docker-compose up -d nginx mysql phpmyadmin redis workspace ```

### Setup Laravel Project

- Change `env` configuration
    ```sh
    DB_CONNECTION=mysql
    DB_HOST=MYSQL
    DB_PORT=3306
    DB_DATABASE=default
    DB_USERNAME=default
    DB_PASSWORD=secret
    ```

- Go into laradock workspace
```docker-compose exec workspace bash```

- Install project third party library
```composer install```

- Migrate database
```php artisan migrate```

- Seeding database
```php artisan db:seed```

- Generate laravel project key
```php artisan key:generate```

- Open website in browser
```http://localhost/```

## Reference
- Laradock
  https://laradock.io/introduction/
- Laravel database
  https://laravel.com/docs/9.x/migrations