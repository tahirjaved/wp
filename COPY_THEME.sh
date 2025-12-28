#!/bin/bash
# Script to copy theme from source to applications directory
# Run this on the server after Coolify pulls from Git and deploys

SOURCE_DIR="/data/coolify/source/jkgck0w8ww4kwws0gk8kg0wc/wp-content/themes/custom-theme"
APP_DIR="/data/coolify/applications/fkc08k04okos0sswo080sg0o/wp-content/themes"

echo "=== Copying custom theme to applications directory ==="

# Create themes directory if it doesn't exist
mkdir -p "$APP_DIR"

# Check if source directory exists
if [ ! -d "$SOURCE_DIR" ]; then
    echo "ERROR: Theme not found in source directory: $SOURCE_DIR"
    echo "Checking what's in source directory..."
    ls -la /data/coolify/source/jkgck0w8ww4kwws0gk8kg0wc/wp-content/themes/ 2>&1 || echo "wp-content/themes doesn't exist in source"
    echo ""
    echo "SOLUTION:"
    echo "1. Make sure you've pushed theme files to Git: git push origin main"
    echo "2. In Coolify, click 'Deploy' to pull latest code"
    exit 1
fi

# Remove old theme if it exists
if [ -d "$APP_DIR/custom-theme" ]; then
    echo "Removing old theme..."
    rm -rf "$APP_DIR/custom-theme"
fi

# Copy theme
echo "Copying theme from source to applications..."
cp -r "$SOURCE_DIR" "$APP_DIR/"
chown -R www-data:www-data "$APP_DIR/custom-theme"
chmod -R 755 "$APP_DIR/custom-theme"

echo ""
echo "✓ Theme copied successfully!"
echo ""
echo "Theme location: $APP_DIR/custom-theme/"
ls -la "$APP_DIR/custom-theme/"
echo ""
echo "Now restart the WordPress container to see the theme:"
CONTAINER_NAME=$(docker ps --filter "ancestor=wordpress:latest" --format "{{.Names}}" | head -1)
if [ -n "$CONTAINER_NAME" ]; then
    echo "Found container: $CONTAINER_NAME"
    echo "Run: docker restart $CONTAINER_NAME"
else
    echo "Run: docker restart <wordpress-container-name>"
fi
