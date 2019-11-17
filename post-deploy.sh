#!/bin/bash
git checkout -f
git clean -fd
composer install
npm install
npm run prod
php artisan migrate --force
php artisan cache:clear
php artisan view:clear
php artisan config:cache

