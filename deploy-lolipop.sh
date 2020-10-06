#!/bin/sh

/usr/local/php/7.4/bin/php ../../composer.phar install --no-dev

/usr/local/php/7.4/bin/php artisan migrate

/usr/local/php/7.4/bin/php artisan config:cache

/usr/local/php/7.4/bin/php artisan view:clear

rm -f storage/logs/*.log
