#!/bin/bash

echo "Clearing compiled files"
php artisan clear-compiled

echo "Generating IDE Helper"
php artisan ide-helper:generate

echo "Optimizing"
php artisan optimize