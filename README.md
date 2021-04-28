# Contacts: list, add, update, delete

## Docker env
docker-compose -d up

## App install and data preload
composer install

php bin/console make:migration

php bin/console doctrine:migrations:migrate

## App start
php -q -S localhost:9200 -t public
