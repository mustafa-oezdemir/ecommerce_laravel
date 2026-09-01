#!/usr/bin/env sh
set -eu

composer_hash="$(sha256sum composer.lock | awk '{print $1}')"
npm_hash="$(sha256sum package-lock.json | awk '{print $1}')"

if [ ! -f vendor/.composer-lock.sha256 ] || [ "$(cat vendor/.composer-lock.sha256)" != "$composer_hash" ]; then
    composer install --no-interaction --no-progress --prefer-dist
    printf '%s' "$composer_hash" > vendor/.composer-lock.sha256
fi

if [ ! -f node_modules/.package-lock.sha256 ] || [ "$(cat node_modules/.package-lock.sha256)" != "$npm_hash" ]; then
    npm ci --no-audit --no-fund
    printf '%s' "$npm_hash" > node_modules/.package-lock.sha256
fi
