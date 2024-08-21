#!/bin/bash

# Update Composer dependencies
composer update

# Run the Laravel install command with the --ready flag
php artisan install --ready

# Seed the database with the specified class
php artisan db:seed --class=Visiosoft\\RestateTheme\\RestateThemeSeeder