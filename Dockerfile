FROM php:8.2-fpm

# Устанавливает необходимые пакеты
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Устанавливает composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Устанавливает зависимости laravel и node
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Настройка прав на storage
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www/storage

# Прослушивает порт приложения(вынести в env)
EXPOSE 9000

CMD ["php-fpm"]
