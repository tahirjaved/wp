FROM wordpress:latest

# Copy custom theme to WordPress themes directory
COPY wp-content/themes/ /usr/src/wordpress/wp-content/themes/

# Set proper permissions
RUN chown -R www-data:www-data /usr/src/wordpress/wp-content/themes/

