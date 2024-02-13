#!/bin/sh

composer install

yarn install

yarn build

PROD_FILE='/var/www/html/.prod'

if [ -f "$PROD_FILE" ]; then
    rm $PROD_FILE
fi

touch $PROD_FILE