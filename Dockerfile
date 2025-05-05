# Etapa 1: Build de assets con Node.js (Vite)
FROM node:20-alpine AS node_builder

WORKDIR /app

# Copiar archivos necesarios para npm
COPY package*.json ./
COPY vite.config.js ./
COPY tailwind.config.js ./
COPY postcss.config.js ./

# Instalar dependencias y construir assets
RUN npm install --force && npm run build -- --mode=production

# Etapa 2: Entorno PHP
FROM php:8.2-fpm-alpine

# Instalar dependencias del sistema
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
    curl

# Instalar extensiones PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring xml intl gd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www

# Copiar aplicación Laravel
COPY . .

# Copiar assets compilados desde la etapa de Node
COPY --from=node_builder /app/public/build ./public/build

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Ajustar permisos
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Puerto expuesto
EXPOSE 8080

# Comando de inicio
CMD php artisan serve --host=0.0.0.0 --port=8080
