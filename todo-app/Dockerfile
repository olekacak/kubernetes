FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application
COPY . .

# Install PHP dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader

# Start the application

EXPOSE 8000

CMD ["sh", "-c", "echo \"Server started in port ${PORT:-8000}\" && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]