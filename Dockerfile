FROM wordpress:latest

# Copy custom theme to WordPress themes directory
# WordPress uses /var/www/html as the web root
COPY wp-content/themes/ /var/www/html/wp-content/themes/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/wp-content/themes/

