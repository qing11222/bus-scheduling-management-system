#!/usr/bin/env bash

# Install PHP
sudo apt-get update
sudo apt-get install -y php-cli php-mbstring php-xml unzip curl

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install project dependencies
composer install --optimize-autoloader --no-dev

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate --force
