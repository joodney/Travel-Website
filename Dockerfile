# Use official PHP image with Apache
FROM php:8.1-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy all project files into Apache default root
COPY . /var/www/html/

# Set working directory (optional but useful)
WORKDIR /var/www/html/

# Give Apache access to all files
RUN chown -R www-data:www-data /var/www/html

# Enable .htaccess override if you plan to use it
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Expose Apache default port
EXPOSE 80
