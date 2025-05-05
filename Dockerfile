# Etapa 1: Construcción
FROM composer:2.7 AS build

WORKDIR /app

# Copiamos dependencias y archivo de configuración
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader
# Copia primero composer para aprovechar el cache

COPY . .

# Ahora sí puedes ejecutar composer install sin errores
RUN composer install --no-dev --optimize-autoloader


# Etapa 2: Producción con Apache + PHP
FROM php:8.2-apache

# Instalamos extensiones necesarias de Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev unzip libpng-dev libonig-dev libxml2-dev zip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Habilitamos mod_rewrite de Apache
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copiamos código desde el stage anterior
COPY --from=build /app ./

# Copiamos .env.example como .env (para entorno de producción en contenedor)
COPY .env.example .env

# Generamos APP_KEY y cacheamos configuración
RUN php artisan key:generate --ansi && php artisan config:cache

# Permisos necesarios
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Cambiamos DocumentRoot a /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
CMD ["apache2-foreground"]
