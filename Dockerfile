# Use official PHP image with Apache
FROM php:8.1-apache

# Install required PHP extensions (if needed)
RUN docker-php-ext-install mysqli

# Copy all project files to Apache root
COPY . /var/www/html/

# Change working directory to /var/www/html/
WORKDIR /var/www/html/

# Change Apache default DocumentRoot to /var/www/html/pages
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/pages|g' /etc/apache2/sites-available/000-default.conf

# Give Apache access to all files
RUN chown -R www-data:www-data /var/www/html

# Enable .htaccess override if needed
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Expose port 80 (already default in Apache image)
EXPOSE 80
