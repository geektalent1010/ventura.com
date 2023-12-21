echo 'Starting deployment ... ';

BRANCH="${FORGE_VAR_BRANCH:=$FORGE_SITE_BRANCH}"
echo "Using $BRANCH";

git config remote.origin.fetch "+refs/heads/*:refs/remotes/origin/*" && git fetch origin
git switch master --discard-changes

if [ $BRANCH != 'master' ]; then
    git branch -D $BRANCH &>/dev/null || true
    git switch $BRANCH --discard-changes
else
    git pull origin master
fi

echo 'Running composer & npm';

$FORGE_COMPOSER install --no-dev --no-interaction --prefer-dist --optimize-autoloader

( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9>/tmp/fpmlock

npm ci && npm run production

echo 'Running artisan commands';
if [ -f artisan ]; then
    # Migrations
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

    # Clear the old boostrap/cache/compiled.php
    $FORGE_PHP artisan clear-compiled

    # Recreate boostrap/cache/compiled.php
    $FORGE_PHP artisan optimize
fi

echo 'Deployment done. ';
