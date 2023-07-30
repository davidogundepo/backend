# Use the official PHP image as the base image
FROM php:8.2.0-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the backend code into the container's working directory
COPY . .

# Install dependencies and enable required PHP extensions
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql && \
    a2enmod rewrite

# Expose port 80 to allow incoming HTTP requests
EXPOSE 80

# Start the Apache web server when the container starts
CMD ["apache2-foreground"]
