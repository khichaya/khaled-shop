FROM php:8.2-apache

# تثبيت حزم النظام وامتدادات PHP (أضفنا pgsql لدعم PostgreSQL)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تعيين مجلد العمل
WORKDIR /var/www/html

# نسخ ملفات المشروع
COPY . .

# تثبيت حزم Laravel
RUN composer install --no-dev --optimize-autoloader

# تغيير مسار الـ Document Root إلى مجلد public
RUN sed -i -e "s/\/var\/www\/html/\/var\/www\/html\/public/g" /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# إعطاء صلاحيات لمجلدات التخزين
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# تشغيل أوامر Laravel الأساسية عند الإقلاع
CMD php artisan migrate --force && php artisan config:cache && php artisan route:cache && apache2-foreground