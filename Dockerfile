# Use the official PHP image as base
FROM php:latest

# Set working directory
WORKDIR /var/www/html

# Copy source code to container
COPY . .

# Install PHP dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set entrypoint for the container
ENTRYPOINT ["php", "-S", "0.0.0.0:8000"]

# Expose port
EXPOSE 80
