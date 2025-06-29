#!/bin/sh

echo "📦 Running migrations..."
php artisan migrate --force || true

echo "🚀 Starting Laravel server..."
exec php artisan serve --host=0.0.0.0 --port=8080
