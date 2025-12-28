#!/bin/bash
# Run these commands on your server to debug the theme issue

echo "=== 1. Check if theme exists in source directory ==="
ls -la /data/coolify/source/jkgck0w8ww4kwws0gk8kg0wc/wp-content/themes/custom-theme/ 2>&1

echo -e "\n=== 2. Check container volume mounts ==="
docker inspect wordpress-fkc08k04okos0sswo080sg0o-163732317117 | grep -A 20 '"Mounts"'

echo -e "\n=== 3. Check if theme is in container ==="
docker exec wordpress-fkc08k04okos0sswo080sg0o-163732317117 ls -la /var/www/html/wp-content/themes/ 2>&1

echo -e "\n=== 4. Check WordPress theme list ==="
docker exec wordpress-fkc08k04okos0sswo080sg0o-163732317117 wp theme list --allow-root 2>&1

echo -e "\n=== 5. Check docker-compose working directory ==="
docker inspect wordpress-fkc08k04okos0sswo080sg0o-163732317117 | grep -i "workingdir\|pwd" 

echo -e "\n=== 6. Check if wp-content directory exists in source ==="
find /data/coolify/source/jkgck0w8ww4kwws0gk8kg0wc -name "wp-content" -type d 2>/dev/null

echo -e "\n=== 7. List all files in wp-content/themes in source ==="
find /data/coolify/source/jkgck0w8ww4kwws0gk8kg0wc/wp-content/themes -type f 2>/dev/null | head -20

