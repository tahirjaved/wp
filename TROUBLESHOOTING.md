# Troubleshooting Database Connection Error

If you're getting "Error establishing a database connection" on localhost, follow these steps:

## Quick Fix Steps

### 1. Check if containers are running
```bash
docker-compose ps
```

Both `wordpress` and `wordpress_db` should be in "Up" status.

### 2. Check database logs
```bash
docker-compose logs db
```

Look for any errors or "ready for connections" message.

### 3. Verify .env file exists
```bash
cat .env
```

Make sure it contains:
```
MYSQL_DATABASE=wordpress
MYSQL_USER=wordpress
MYSQL_PASSWORD=your_password_here
MYSQL_ROOT_PASSWORD=your_root_password_here
```

### 4. Restart containers
```bash
docker-compose down
docker-compose up -d
```

Wait a few seconds for the database to initialize, then check logs:
```bash
docker-compose logs -f db
```

You should see "ready for connections" when it's ready.

### 5. Test database connection from WordPress container
```bash
docker exec -it wordpress bash
```

Then inside the container:
```bash
# Test if database is reachable
ping db

# Test MySQL connection (if mysql client is installed)
mysql -h db -u wordpress -p
```

### 6. Check WordPress configuration
```bash
docker exec -it wordpress cat /var/www/html/wp-config.php | grep DB_
```

Verify the database credentials match your .env file.

## Common Issues

### Issue: Database container not starting
**Solution**: Check logs with `docker-compose logs db` and ensure ports 3306 aren't already in use.

### Issue: Environment variables not set
**Solution**: Create a `.env` file with all required variables, or the docker-compose.yaml now has defaults.

### Issue: Database not ready when WordPress starts
**Solution**: The updated docker-compose.yaml now includes a healthcheck that waits for the database to be ready.

### Issue: Wrong database credentials
**Solution**: Make sure `MYSQL_PASSWORD` in .env matches `WORDPRESS_DB_PASSWORD` in docker-compose.yaml.

## Reset Everything

If nothing works, you can reset:

```bash
# Stop and remove containers and volumes
docker-compose down -v

# Remove the .env file and recreate it
rm .env
# Then create a new .env with your passwords

# Start fresh
docker-compose up -d
```

## Verify Connection

After starting, wait 10-20 seconds, then:
1. Check database is ready: `docker-compose logs db | grep "ready for connections"`
2. Access WordPress at http://localhost:8090
3. You should see the WordPress installation screen, not a database error

