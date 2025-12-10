FROM php:8.2-fpm

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar proyecto
WORKDIR /var/www/html
COPY . .

# Instalar dependencias Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permisos
RUN chmod -R 775 storage bootstrap/cache

# Render NO usa puertos fijos, así que quitamos el EXPOSE
# EXPOSE 8000  <-- ELIMINADO

# Comando para arrancar Laravel usando el puerto dinámico
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=10000"]
