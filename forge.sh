$FORGE_COMPOSER install --no-dev --no-interaction --prefer-dist --optimize-autoloader

( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9>/tmp/fpmlock

npm ci && npm run production

echo 'Clearing caches';

if [ -f artisan ]; then
    $FORGE_PHP artisan migrate --force

    # Clear caches
    $FORGE_PHP artisan cache:clear

    # Clear expired password reset tokens
    $FORGE_PHP artisan auth:clear-resets

    # Clear and cache routes
    $FORGE_PHP artisan route:cache

    # Clear and cache config
    $FORGE_PHP artisan config:cache

    # Clear and cache views
    $FORGE_PHP artisan view:cache
fi
