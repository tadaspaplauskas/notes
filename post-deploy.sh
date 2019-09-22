#!/bin/bash
composer install
php artisan migrate --force
php artisan route:cache
php artisan cache:clear
php artisan view:clear
php artisan config:cache

