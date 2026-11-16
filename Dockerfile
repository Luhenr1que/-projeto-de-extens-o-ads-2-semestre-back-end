FROM php:8.4-cli
RUN apt-get update && apt-get install -y unzip git libzip-dev libsqlite3-dev libpq-dev && docker-php-ext-install pdo pdo_mysql pdo_sqlite pdo_pgsql zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY . /app
RUN composer install --no-dev --optimize-autoloader
RUN chmod -R 775 storage bootstrap/cache
CMD cp -n .env.example .env || true && touch /app/database/database.sqlite && php artisan config:clear && php artisan key:generate --force && php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
