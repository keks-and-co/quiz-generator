# Quiz Generator

## Requirement

* PHP 7+
* MySQL 5

## Instalation

* git clone https://github.com/keks-and-co/quiz-generator.git
* `cd quiz-generator`
* `composer install`
* `cp .env.example .env`
* `php artisan key:generate`
* populate your db info in the .env file
* `php artisan migrate --seed`

For local development, it is recomended to use [homestead](https://laravel.com/docs/5.5/homestead), which will create a local dev domain for you and safe you the trouble of configuring the correct env.