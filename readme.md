# Home task #
1. Clone this repository [https://github.com/vladkudinov89/proweb](https://github.com/vladkudinov89/proweb)
2. Install & run project locally or in container with [docker-compose](https://dotsandbrackets.com/quick-intro-to-docker-compose-ru/)
Execute commands in docker-compose:
    - Install composer-package `docker-compose exec app composer install`
    - Execute _php artisan_ commands `docker-compose exec app php artisan make:fresh --seed`
3. Execute test run `docker-compose exec app php ./vendor/bin/phpunit`.

Email and notification are send to log file. See `storage/logs`.
