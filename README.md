<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Test aplication with laravel 8, vue2 and vuetify
This app has a frontend registration form and a backend that validates data, saves data in DB, and triggers a Laravel event named UserRegistered

## Deployment

Copy env.example and rename new one to .env
create database and put to env file database credentials
```
composer install
php artisan key:generate
php artisan migrate
npm install
npm run dev

php artisan serve

and go to localhost
```
## Screenshots

![Screenshot](/example_images/form1.png)
![Screenshot](/example_images/form.png)
![Screenshot](/example_images/errorExample.png)
![Screenshot](/example_images/tables.png)
