#!/bin/bash

# Pull the latest changes
git pull origin main

# Install/update dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Run database migrations
php artisan migrate --force

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Restart queue workers
php artisan queue:restart

# Optimize
php artisan optimize

echo "Deployment completed!"