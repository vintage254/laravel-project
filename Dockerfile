FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_sqlite \
    mbstring \
    xml \
    fileinfo \
    zip \
    curl

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy composer files first
COPY composer.json composer.lock ./

# Create required directories
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/testing \
    bootstrap/cache

# Set permissions
RUN chmod -R 777 storage bootstrap/cache

# Install composer dependencies with verbose output
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts \
    --verbose

# Copy package files
COPY package.json ./
RUN npm install

# Copy the rest of the application
COPY . .

# Run composer scripts now that the full application is available
RUN composer dump-autoload --optimize

# Build assets
RUN npm run build

# Prepare the application
RUN touch database/database.sqlite
RUN chmod -R 777 database
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Add better logging
RUN ln -sf /dev/stdout /app/storage/logs/laravel.log

# Modify healthcheck to be more basic
HEALTHCHECK --interval=10s --timeout=5s --start-period=30s --retries=3 \
    CMD curl -f https://laravel-project-production-d7ba.up.railway.app/ || exit 1

# Make sure PORT is explicitly set
ENV PORT=8000

EXPOSE ${PORT:-8000}

CMD ["sh", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT} --verbose"]

RUN chmod +x /usr/local/bin/docker-entrypoint.sh