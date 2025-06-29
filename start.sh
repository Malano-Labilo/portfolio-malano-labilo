#!/bin/sh

echo "📦 Running migrations..."
php artisan migrate --force || true

php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "🚀 Starting Laravel server..."
exec php artisan serve --host=0.0.0.0 --port=8080
