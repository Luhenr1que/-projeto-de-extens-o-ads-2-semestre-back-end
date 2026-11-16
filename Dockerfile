FROM php:8.4-cli
RUN apt-get update && apt-get install -y unzip git libzip-dev libsqlite3-dev sqlite3 libpq-dev && docker-php-ext-install pdo pdo_mysql pdo_sqlite pdo_pgsql zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY . /app
RUN composer install --no-dev --optimize-autoloader
RUN chmod -R 775 storage bootstrap/cache
CMD rm -f .env && printf "APP_ENV=production\nAPP_DEBUG=true\nAPP_KEY=\nDB_CONNECTION=sqlite\nDB_DATABASE=/app/database/database.sqlite\n" > .env && touch /app/database/database.sqlite && php artisan config:clear && php artisan key:generate --force && php artisan migrate:fresh --force && sqlite3 /app/database/database.sqlite < /app/database/dados_iniciais.sql && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
