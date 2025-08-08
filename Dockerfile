# 1. استخدم صورة PHP الرسمية مع Apache
FROM php:8.2-apache

# 2. تثبيت امتدادات PHP المطلوبة للـ Laravel
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath

# 3. تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. نسخ ملفات المشروع إلى مجلد الويب في الحاوية
COPY . /var/www/html/

# 5. تعيين صلاحيات المجلدات المطلوبة
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 6. تثبيت الحزم
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# إذا كان عندك Vite أو Laravel Mix
RUN apt-get update && apt-get install -y nodejs npm
RUN npm install && npm run build || echo "Skipping npm build"

# 7. تعيين DocumentRoot إلى public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf
RUN a2enmod rewrite

# 8. أوامر Laravel الأساسية
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan cache:clear \
    && php artisan key:generate --force || true

# 9. فتح المنفذ
EXPOSE 80

# 10. تشغيل Apache
CMD ["apache2-foreground"]