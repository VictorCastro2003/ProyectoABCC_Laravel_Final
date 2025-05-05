# Etapa 1: Construcción de assets con Node.js
FROM node:18 AS node-build

WORKDIR /app

# Copia solo los archivos necesarios para instalar dependencias de frontend
COPY package*.json vite.config.js ./
COPY resources ./resources
COPY tailwind.config.js postcss.config.js ./

RUN npm install && npm run build

# Etapa 2: Configuración de PHP con Apache
FROM php:8.1-apache

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl

# Habilita mod_rewrite en Apache
RUN a2enmod rewrite

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establece directorio de trabajo
WORKDIR /var/www/html

# Copia el resto del proyecto Laravel
COPY . .

# Copia los assets generados desde la etapa de Node.js
COPY --from=node-build /app/public/build public/build

# Instala dependencias PHP (sin las de desarrollo)
RUN composer install --no-dev --optimize-autoloader

# Permisos correctos para Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Configura Apache para servir desde /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Expone el puerto 80
EXPOSE 80

# Comando por defecto
CMD ["apache2-foreground"]
