FROM php:8.1-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath xml

# Install SQLite
RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files first to leverage Docker cache
COPY composer.json composer.lock ./
COPY package.json package-lock.json ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN npm ci

# Copy the rest of the application
COPY . .

# Create SQLite database and set permissions
RUN touch database/database.sqlite
RUN chmod -R 777 storage bootstrap/cache database

# Generate application cache
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Build assets
RUN npm run build

EXPOSE 8000

CMD ["sh", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]