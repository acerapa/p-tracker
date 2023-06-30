# Base image
FROM php:8.1-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath

# Enable Apache rewrite module
RUN a2enmod rewrite

# # Copy the Apache configuration file
# COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

# Remove hidden characters from the Apache configuration file
RUN sed -i -e 's/\xc2\xa0/ /g' /etc/apache2/sites-available/000-default.conf

# Copy application files
COPY ./ /var/www/html

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install application dependencies
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground", "--cpus=4"]
