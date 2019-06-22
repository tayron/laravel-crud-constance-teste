#!/bin/sh

cd /var/www/projeto

# aqui pode executar comandos como dar permissão em pastas, comandos auxiliares dos framewors, como php artisan migrate, etc..

# If this is the first time you initialize docker, install the dependencies according to the environment
if [ -z "$(ls -A vendor)" ]; then
    echo "Installing development dependencies..."
    composer install --no-suggest -q -o --no-interaction
fi

php-fpm -D && nginx -g 'daemon off;'
