<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Small Laravel Project

This is a simple Laravel project just for learning!

## Installation 

Install the dependencies and setup your .env file.
```
composer install 
cp .env.example .env 
```
## .env
- DB_HOST=mysql
- MAIL_MAILER=log
- FILESYSTEM_DISK=public
- QUEUE_CONNECTION=database

Then create the necessary database.
```
php artisan db
create database laravelTask
```
And run the initial migrations and seeders.
```
php artisan migrate --seed 
php artisan queue:listen
```

In this project has only manager and user roles\
Manager email: email@company.com, password: 111111

Database Structure
![DB Structure](image_2022-12-28_23-12-17.png "DB")
