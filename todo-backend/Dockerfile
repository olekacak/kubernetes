FROM php:8.4-cli
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql
WORKDIR /app
COPY index.php .
CMD ["php", "-S", "0.0.0.0:3000", "index.php"]
