#!/bin/bash
# Run these commands on your server to debug the theme issue

echo "=== 1. Check if theme exists in source directory ==="
ls -la /data/coolify/source/jkgck0w8ww4kwws0gk8kg0wc/wp-content/themes/custom-theme/ 2>&1

echo -e "\n=== 2. Find WordPress container ==="
CONTAINER_NAME=$(docker ps --filter "ancestor=wordpress:latest" --format "{{.Names}}" | head -1)
if [ -z "$CONTAINER_NAME" ]; then
    echo "ERROR: WordPress container not found!"
    echo "Available containers:"
    docker ps --format "{{.Names}}"
    exit 1
fi
echo "Using container: $CONTAINER_NAME"

echo -e "\n=== 3. Check container volume mounts ==="
docker inspect "$CONTAINER_NAME" | grep -A 20 '"Mounts"'

echo -e "\n=== 4. Check if theme is in container ==="
docker exec "$CONTAINER_NAME" ls -la /var/www/html/wp-content/themes/ 2>&1

echo -e "\n=== 5. Check WordPress theme list ==="
docker exec "$CONTAINER_NAME" wp theme list --allow-root 2>&1 || echo "WP-CLI not available in container"

echo -e "\n=== 6. Check docker-compose working directory ==="
docker inspect "$CONTAINER_NAME" | grep -i "workingdir\|pwd" 

echo -e "\n=== 6. Check if wp-content directory exists in source ==="
find /data/coolify/source/jkgck0w8ww4kwws0gk8kg0wc -name "wp-content" -type d 2>/dev/null

echo -e "\n=== 7. List all files in wp-content/themes in source ==="
find /data/coolify/source/jkgck0w8ww4kwws0gk8kg0wc/wp-content/themes -type f 2>/dev/null | head -20

