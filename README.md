# Laravel CURD

## Project setup

1. Create Database

  Default
    DB_name: laravel_diamond
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_USERNAME=root
    DB_PASSWORD=

2. Migrate DB tables

  Running Migrations
  ```
  php artisan migrate
  ```

3. Seeding DB

  Running Seeders

  ```
  php artisan db:seed
  ```

## Project run

```
php artisan serve
```

## Use laravel mix vue

### Setup

```
npm install
```

### Compiles for laravel-mix

```
npm run dev
```

### Use mix

Use mix files in you view

  ```
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <div id="app"></div>

    <script src="{{ mix('js/app.js') }}"></script>
  ```
    