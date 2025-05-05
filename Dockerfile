# Etapa 1: Build de assets con Node.js
FROM node:20-alpine AS node_builder

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY resources/ resources/
COPY vite.config.js ./
COPY tailwind.config.js ./
COPY postcss.config.js ./

# Solo los assets necesarios
RUN npm run build


# Etapa 2: App PHP con Composer
FROM php:8.2-fpm-alpine

# Instala extensiones y herramientas necesarias
RUN apk add --no-cache \
    bash \
    zip \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    mysql-client \
    icu-dev \
    libxml2-dev \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring xml intl gd


# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www

# Copia app Laravel
COPY . .

# Instala dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Copia assets generados desde la etapa Node
COPY --from=node_builder /app/public/build ./public/build

# Asigna permisos
RUN chown -R www-data:www-data . \
    && chmod -R 755 .
RUN php artisan config:clear 
RUN php artisan cache:clear 
RUN php artisan config:cache
# Corre migraciones automáticamente al iniciar
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080
