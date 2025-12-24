#!/bin/bash
# Script to copy custom theme into running WordPress container
# This can be run via Coolify's terminal or as a post-deployment script

echo "Copying custom theme to WordPress themes directory..."

# Create themes directory if it doesn't exist
mkdir -p /var/www/html/wp-content/themes

# Copy theme (adjust path if needed)
if [ -d "/app/wp-content/themes/custom-theme" ]; then
    cp -r /app/wp-content/themes/custom-theme /var/www/html/wp-content/themes/
    echo "Theme copied from /app/wp-content/themes/custom-theme"
elif [ -d "./wp-content/themes/custom-theme" ]; then
    cp -r ./wp-content/themes/custom-theme /var/www/html/wp-content/themes/
    echo "Theme copied from ./wp-content/themes/custom-theme"
else
    echo "Error: Theme directory not found"
    exit 1
fi

# Set proper permissions
chown -R www-data:www-data /var/www/html/wp-content/themes/custom-theme
chmod -R 755 /var/www/html/wp-content/themes/custom-theme

echo "Theme copied successfully!"
ls -la /var/www/html/wp-content/themes/


