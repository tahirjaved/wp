#!/bin/bash
# Script to copy theme from source to applications directory
# Run this on the server after Coolify pulls from Git

SOURCE_DIR="/data/coolify/source/jkgck0w8ww4kwws0gk8kg0wc/wp-content/themes/custom-theme"
APP_DIR="/data/coolify/applications/fkc08k04okos0sswo080sg0o/wp-content/themes"

echo "Copying custom theme to applications directory..."

# Create themes directory if it doesn't exist
mkdir -p "$APP_DIR"

# Copy theme
if [ -d "$SOURCE_DIR" ]; then
    cp -r "$SOURCE_DIR" "$APP_DIR/"
    chown -R www-data:www-data "$APP_DIR/custom-theme"
    echo "Theme copied successfully!"
    ls -la "$APP_DIR/custom-theme/"
else
    echo "ERROR: Theme not found in source directory: $SOURCE_DIR"
    echo "Make sure you've pushed to Git and Coolify has pulled the latest code."
fi

