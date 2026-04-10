# Используем официальный образ PHP 8.3 с FPM (FastCGI Process Manager)
FROM php:8.3-fpm

# Устанавливаем системные зависимости и расширения PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    unzip \
    libpq-dev \  # Для PostgreSQL
    && docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создаем пользователя для запуска (безопасность)
RUN usermod -u 1000 www-data

# Рабочая директория
WORKDIR /var/www/symfony

# Копируем файлы проекта (исключая то, что в .dockerignore, если создадим)
COPY . .

# Устанавливаем зависимости (без дев-пакетов для прода, но для обучения оставим)
# --ignore-platform-reqs нужен, если локальный композер и докерный не совпадают по версиям
RUN composer install --no-interaction --optimize-autoloader

# Права доступа для кэша и логов
RUN chown -R www-data:www-data var/
RUN chmod -R 775 var/

# Переключаемся на пользователя www-data
USER www-data

# Экспонируем порт 9000 для PHP-FPM
EXPOSE 9000

# Команда запуска (FPM сам запустится)
CMD ["php-fpm"]