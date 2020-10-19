# Laravel Simple E-Wallet Restfull Api / Api Elektronik uang yang sederhana
<p align="center">
<a href="https://api-simplewallet-v1.herokuapp.com"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

Simple E-Wallet Restful API using Laravel API Resource (Laravel Version 5.7, PHP version 7.2).

### Requirements / Apa saja yang di butuhkan untuk menjalankannya
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

## Features / Fitur apa saja yang tersedia
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

## Installation / Cara Instalasi nya

```sh
git clone https://github.com/shinochiha/laravel-api-e-wallet-v1.git 
&& laravel-api-e-wallet-v1 
&& cp .env.example .env
```

Open your favourite text editor. / Buka editor teks favorit anda

Open .env file, edit with your database credentials and smtp gmail:

setting .env database
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_username
DB_PASSWORD=db_passwor
```


setting .env smtp gmail
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=yourgmail
MAIL_PASSWORD=yourpasswordgmail
MAIL_ENCRYPTION=tls
```

```sh
composer install
&& php artisan key:generate
&& php artisan jwt:secret
&& php artisan migrate
&& php artisan db:seed
&& php artisan serve
```
type localhost:8000

open your terminal type php artisan route:list to show list route API Endpoint

Note: if jwt:secret not working go to <a href="https://github.com/tymondesigns/jwt-auth/issues/1298">here</a> for fixing. 

## Site Endpoint
URL: <a href="https://api-simplewallet-v1.herokuapp.com" target="_blank">https://api-simplewallet-v1.herokuapp.com</a>

Use Postman tool for performing integration testing with your API. Postman Colletion link: 
- https://www.getpostman.com/collections/3ec6f2042b2767c0c99b

## Document Postman Collections
- https://documenter.getpostman.com/view/5830116/RznBMzgz

Note: You can change environment Postman type Online URL or Local URL

