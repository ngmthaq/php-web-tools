PROD_FILE=/var/www/html/.prod

composer install

yarn install

yarn dev

if [ -f "$PROD_FILE" ]; then
    rm $PROD_FILE
fi
