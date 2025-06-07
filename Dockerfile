# Use PHP CLI as the base image
FROM php:8.2-cli

# Install Additional System Dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    inotify-tools \
    lsof \
    git \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs   

# Set the working directory
WORKDIR /var/www/html

# Copy composer files first
COPY composer.json composer.lock ./

# Set COMPOSER_ALLOW_SUPERUSER environment variable
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install project dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Copy the rest of the application code
COPY . .

# Install npm packages
RUN npm install

# Give execute permissions to watch.sh
RUN chmod +x watch.sh

# Expose port 8000 for php artisan serve
EXPOSE 8000