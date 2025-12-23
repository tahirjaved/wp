# WordPress Deployment with Coolify

This repository contains a WordPress site configured for deployment with Coolify.

## Quick Start with Coolify UI

Coolify provides a built-in WordPress resource type that makes deployment easy:

1. **Access Coolify Dashboard**: Log in to your Coolify instance
2. **Create a New Project**: Navigate to "Projects" → "Create New Project"
3. **Add WordPress Resource**: 
   - Click "Add Resource" → Select "WordPress"
   - Configure:
     - **Name**: Your WordPress instance name
     - **Domain**: Your domain name (ensure DNS A record points to your server)
     - **Database Password**: Set a secure password
4. **Deploy**: Click "Create" and Coolify will handle the rest

## Manual Deployment with Docker Compose

If you prefer to use the docker-compose.yml file directly:

1. **Copy environment file**:
   ```bash
   cp .env.example .env
   ```

2. **Edit `.env` file** with your secure passwords:
   ```bash
   nano .env
   ```

3. **Start the services**:
   ```bash
   docker-compose up -d
   ```

4. **Access WordPress**:
   - Open your browser and navigate to your domain
   - Complete the WordPress installation wizard

## Configuration

### Environment Variables

- `MYSQL_DATABASE`: Database name (default: wordpress)
- `MYSQL_USER`: Database user (default: wordpress)
- `MYSQL_PASSWORD`: Database password (required)
- `MYSQL_ROOT_PASSWORD`: MySQL root password (required)
- `WORDPRESS_TABLE_PREFIX`: Table prefix (default: wp_)

### Upload Size Limit

To increase upload size limits, you can modify the `.htaccess` file or add PHP configuration:

```apache
php_value upload_max_filesize 256M
php_value post_max_size 256M
php_value max_execution_time 300
php_value max_input_time 300
```

## SSL/HTTPS

Coolify automatically handles SSL certificates via Let's Encrypt when you configure a domain. No additional setup required!

## Backup

Consider setting up regular backups for:
- WordPress files (`wp-content` directory)
- Database (MySQL/MariaDB)

## Support

For Coolify-specific issues, refer to the [Coolify documentation](https://coolify.io/docs).

