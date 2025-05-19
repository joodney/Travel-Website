# Use the official PHP 8.1 image with Apache pre-installed
FROM php:8.1-apache

# Copy all project files to the Apache web root
COPY . /var/www/html/

# Set correct permissions for the project files
RUN chown -R www-data:www-data /var/www/html

# Enable Apache rewrite module (required for routing and clean URLs)
RUN a2enmod rewrite

# Add custom Apache configuration to allow .htaccess overrides
RUN echo '<Directory /var/www/html/>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/custom.conf \
    && a2enconf custom

# Expose port 80 (default HTTP port)
EXPOSE 80
