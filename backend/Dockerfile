FROM wordpress:6.8.1-php8.2-apache

# Set PHP memory limit
RUN echo "memory_limit = 512M" > /usr/local/etc/php/conf.d/memory-limit.ini

# Install necessary extensions
RUN apt-get update && apt-get install -y \
    less \
    default-mysql-client \
    libjpeg-dev \
    libpng-dev \
    libfreetype-dev \
    zlib1g-dev \
    libcurl4-openssl-dev \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/* # Clean up apt cache

# Install WP-CLI (optional, but good for debugging later if needed)
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

# Install PHP extensions
RUN docker-php-ext-install gd curl zip mysqli

# --- Critical Change: Remove dependency on /var/www/html being empty ---
# This step explicitly copies the WordPress core files from the base image's source
# to the web root, ensuring they are always present.
# The `wordpress` image usually extracts its files to /usr/src/wordpress.
COPY --from=wordpress:6.8.1-php8.2-apache /usr/src/wordpress/ /var/www/html/

# Ensure proper permissions for WordPress files (especially wp-content)
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/wp-content 
#Or 755/644, depends on plugins/themes, but 775 is often needed for Azure storage

EXPOSE 80