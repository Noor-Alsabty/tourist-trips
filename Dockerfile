FROM php:8.2-apache

# تثبيت Composer وامتدادات PHP المطلوبة
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl \
    && docker-php-ext-install zip pdo pdo_mysql

# نسخ ملفات المشروع
COPY . /var/www/html/
WORKDIR /var/www/html/

# تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# إعداد Laravel
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 80
