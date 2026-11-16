FROM php:8.3-cli

# Instala dependências do sistema e extensões do PHP (SQLite, MySQL, PostgreSQL, Zip)
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    libsqlite3-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite pdo_pgsql zip

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

# Instala as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Garante permissões nas pastas de cache e armazenamento
RUN chmod -R 775 storage bootstrap/cache

# Prepara o .env, gera a chave, cria o SQLite (se usado), roda migrations e inicia o servidor
CMD cp -n .env.example .env || true && \
    php artisan key:generate --force && \
    touch database/database.sqlite && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}