# Laravel 5.5 Lumen 5.5 RESTful API with OAuth2

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

This is a RESTful API with OAuth2 authentication/security developed using Laravel Lumen 5.5.0.
You can use this if you want to quick start developing your own custom RESTful API by skipping 95% of your scratch works.
Hopefully this will save lot of your time as this API includes all the basic stuffs you need to get started.

This API also includes a developer dashboard with the API documentation which is developed in Laravel 5.5. This will be useful to manage your developers access to the API documentation.

[DEMO](http://laravel-lumen-rest.dockerboxes.us)
-------------------
```
http://laravel-lumen-rest.dockerboxes.us
Login: developer/developer
```

## Official Documentation

Documentation for this RESTful API can be found on the [Lumen RESTful API with OAuth2 Documenation](http://laravel-lumen-rest.dockerboxes.us).

INSTALLATION
-------------------
```
Step1. cd /var/www
git clone -b master https://github.com/sirinibin/laravel-5.5-lumen-5.5-with-OAuth2.git laravel-api

Note:Make sure you have  at least php7.1  or php7.0  or else you may face some issues while installing laravel lumen.

Step2. cd laravel-api
       composer install

Step3.Create a database named "laravel_api" in your mysql or any other database software.

Step4.cp .env.example .env

Step5. vim .env and update the db details

Step6.php artisan key:generate

Step7.php artisan migrate

Step8. cd developers & run composer install then repeat step4,5 & 6.

Step9. Point API end point URL to /var/www/laravel-api/public

      eg: http://laravel-lumen-rest-api.dockerboxes.us

Step10. Point API developers Dashboard URL to /var/www/laravel-api/developers/public

       eg:http://laravel-lumen-rest.dockerboxes.us

Step11. cd /var/www/laravel-api && sudo chmod -R 777 storage

Step12. cd /var/www/laravel-api/developers && sudo chmod -R 777 storage

Step13. vim /var/www/laravel-api/developers/.env

    API_HOST_LOCAL=localhost:8004

    API_HOST_PRODUCTION=laravel-lumen-rest-api.dockerboxes.us

```

## Security Vulnerabilities

If you discover a security vulnerability within this template, please send an e-mail to Sirin k at sirin@nintriva.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

