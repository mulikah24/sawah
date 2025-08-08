# 1. استخدم صورة PHP الرسمية مع Apache
FROM php:8.2-apache

# 2. تثبيت الأدوات الأساسية المطلوبة لبناء امتدادات PHP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libonig-dev \
    libxml2-dev \
    autoconf \
    gcc \
    make \
    g++ \
    nodejs \
    npm \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath zip

# 3. تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. نسخ ملفات المشروع إلى مجلد الويب في الحاوية
COPY . /var/www/html/

# 5. تعيين صلاحيات المجلدات المطلوبة
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 6. العمل داخل مجلد المشروع
WORKDIR /var/www/html

# 7. تثبيت الحزم الخاصة بالـ PHP (Composer) والـ Node.js (npm) وبناء ملفات الواجهة
RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build || echo "Skipping npm build"

# 8. تعيين DocumentRoot إلى public (مجلد Laravel)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf
RUN a2enmod rewrite

# 9. أوامر Laravel الأساسية
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan cache:clear \
    && php artisan key:generate --force || true

# 10. فتح المنفذ 80
EXPOSE 80

# 11. تشغيل Apache
CMD ["apache2-foreground"]