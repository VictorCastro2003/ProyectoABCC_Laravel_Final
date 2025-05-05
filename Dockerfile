# Etapa 1: Construcción
FROM composer:2.7 AS build

WORKDIR /app

COPY . .

# Instalar dependencias sin las de desarrollo
RUN composer install --no-dev --optimize-autoloader


# Etapa 2: Producción
FROM php:8.2-apache

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev unzip libpng-dev libonig-dev libxml2-dev zip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar el código desde la etapa de construcción
COPY --from=build /app ./

# ⚠️ COPIAR EL .env REAL DESDE LA MÁQUINA LOCAL O USAR VARIABLES DE ENTORNO EN RENDER
# NO copiar .env.example
# COPY .env.example .env ❌

# Generar APP_KEY si no existe
RUN php artisan config:clear \
 && php artisan cache:clear \
 && php artisan config:cache \
 && php artisan route:cache

# Asignar permisos correctos
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 775 storage bootstrap/cache

# Cambiar DocumentRoot a /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
CMD ["apache2-foreground"]
