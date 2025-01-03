FROM php:7.0-apache

COPY . /var/www/html
COPY my_apache_config.conf /etc/apache2/conf-available/my_apache_config.conf
RUN a2enconf my_apache_config.conf

EXPOSE 80
