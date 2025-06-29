#!/bin/sh

# Jalankan semua migrate dan seeding sebelum start
php artisan migrate --force

# Start Laravel dengan PHP built-in server
php artisan serve --host=0.0.0.0 --port=8080