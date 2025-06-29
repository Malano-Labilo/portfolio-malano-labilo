#!/bin/sh

echo "📦 Running migrations..."
php artisan migrate --force || true

npm install && npm run build

echo "🚀 Starting Laravel server..."
exec php artisan serve --host=0.0.0.0 --port=8080
