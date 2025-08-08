# استخدم صورة PHP الرسمية مع Apache
FROM php:8.2-apache

# تثبيت امتدادات PHP المطلوبة
RUN docker-php-ext-install pdo pdo_mysql

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# نسخ ملفات المشروع إلى مجلد الويب في الحاوية
COPY . /var/www/html/

# تعيين صلاحيات
RUN chown -R www-data:www-data /var/www/html

# تشغيل أوامر composer وnpm داخل الحاوية
RUN composer install --no-dev --optimize-autoloader
RUN apt-get update && apt-get install -y npm
RUN npm install
RUN npm run build

# تعيين DocumentRoot إلى public (مجلد Laravel)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]