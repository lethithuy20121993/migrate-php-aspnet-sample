FROM php:7.0-apache

# Install dependencies and configure PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy your source code into the container
COPY . /var/www/html

# Copy Apache configuration
COPY my_apache_config.conf /etc/apache2/conf-available/my_apache_config.conf

# Enable Apache configuration
RUN a2enconf my_apache_config.conf

# Change ownership of the /var/www/html directory
RUN chown -R www-data:www-data /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 80 for Apache
EXPOSE 80

# CMD to run Apache when the container starts
CMD ["apache2-foreground"]
