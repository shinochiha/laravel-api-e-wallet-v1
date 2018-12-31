# Laravel Simple E-Wallet Restfull Api
<p align="center">
<a href="https://api-simplewallet-v1.herokuapp.com"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

Simple E-Wallet Restful API using Laravel API Resource (Laravel Version 5.7, PHP version 7.2).

### Requirements
- PHP >= 7.1.3
- Composer
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- php-pgsql Extension
- Text Editor
- Postman Tool

## Features
- Validation
- JWT Authentication
- Models with proper relationships
- API Response with [Fractal](http://github.com/spatie/laravel-fractal)
- Seeding Database
- Error Handling
- [CORS](https://github.com/barryvdh/laravel-cors) Support
- Custom respond function
- PostgreSQL Database
- smtp gmail

## Installation

```sh
$ git clone https://github.com/shinochiha/laravel-api-e-wallet-v1.git
$ cd laravel-api-e-wallet-v1
$ cp .env.example .env
```

Open your favourite text editor.

Open .env file, edit with your database credentials and smtp gmail if you want use smtp.
```sh
$ composer install
$ php artisan key:generate
$ php artisan jwt:secret
$ php artisan migrate
$ php artisan db:seed
$ php artisan serve
```
type localhost:8000

open your terminal type php artisan route:list to show list route API Endpoint

## Site Endpoint
URL: https://api-simplewallet-v1.herokuapp.com

Use Postman tool for performing integration testing with your API. Postman Colletion link: 
- https://www.getpostman.com/collections/3ec6f2042b2767c0c99b
- https://documenter.getpostman.com/view/5830116/RznBMzgz

Note: You can change environment Postman type Online URL or Local URL

