# Use an official PHP image with necessary extensions
FROM php:8.2-cli

# Set environment variables for non-interactive apt-get installs
ENV DEBIAN_FRONTEND=noninteractive

# Install system dependencies and PHP extensions required for Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory to /var/www
WORKDIR /var/www

# Copy composer.json and composer.lock to the container
COPY composer.json composer.lock ./

# Install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Copy the rest of the Laravel application files into the container
COPY . .

# Set the appropriate file permissions for Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 8000 for PHP's built-in server
EXPOSE 8000

# Start Laravel's development server using php artisan serve
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
