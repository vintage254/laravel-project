#!/bin/sh
set -e

# Run migrations
php artisan migrate --force

# Start Laravel
exec php artisan serve --host=0.0.0.0 --port=$PORT 