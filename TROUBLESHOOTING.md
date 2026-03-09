# TROUBLESHOOTING GUIDE - I3 REALTORS ON HOSTINGER

## Error: "500 Internal Server Error"

### Step 1: Check Error Logs
```bash
tail -100 storage/logs/laravel.log
```

### Step 2: Common Causes

#### Cause A: No Application Key
```bash
# Check if APP_KEY is set in .env
grep APP_KEY .env

# If empty, generate it
php artisan key:generate
```

#### Cause B: Storage Not Writable
```bash
# Check permissions
ls -la storage/
ls -la bootstrap/cache/

# Fix permissions
chmod -R 777 storage
chmod -R 777 bootstrap/cache
```

#### Cause C: Database Connection Failed
```bash
# Test database connection
php artisan tinker
> DB::connection()->getPdo();
# Should return a PDO object without error

# If fails, check .env:
nano .env
# Verify: DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD
```

#### Cause D: Missing Dependencies
```bash
# Check if vendor folder exists
ls -la vendor/ | head -5

# If missing, install:
composer install --no-dev

# If composer not found:
curl -sS https://getcomposer.org/installer | php
php composer.phar install --no-dev
```

---

## Error: "404 Not Found" on All Routes

### Solution 1: Check Public Folder Configuration
**In cPanel/Hostinger Dashboard:**
1. Go to **Addon Domains** or **Domains**
2. Ensure your domain's **Document Root** is set to `public_html/public`
3. NOT `public_html`

If it shows `public_html`, contact Hostinger support to change it to `public_html/public`.

### Solution 2: Check .htaccess Files
```bash
# Verify public/.htaccess exists
ls -la public/.htaccess

# Verify root .htaccess exists (optional, but helpful)
ls -la .htaccess
```

If missing, create them:

**public/.htaccess:**
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

**.htaccess (root):**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteCond %{REQUEST_URI} !^public
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### Solution 3: Enable mod_rewrite
```bash
# Check if Apache mod_rewrite is enabled
php -r "print_r(apache_get_modules());" | grep rewrite

# If not found, ask Hostinger to enable it
```

---

## Error: "No Application Key Set"

```bash
# Generate the key
php artisan key:generate

# Verify it was added to .env
grep APP_KEY= .env
```

---

## Error: "SQLSTATE[HY000]: General error: 1030 Got error"

### Cause: Database Doesn't Exist or Credentials Wrong

```bash
# 1. Test connection directly
mysql -h localhost -u DB_USERNAME -p DB_PASSWORD -e "SELECT 1;"

# 2. Check database exists
mysql -h localhost -u DB_USERNAME -p DB_PASSWORD -e "SHOW DATABASES;"

# 3. Verify Laravel can connect
php artisan tinker
> DB::select('SELECT 1');
```

### Fix:
1. Go to cPanel > MySQL Databases
2. Create new database if it doesn't exist
3. Create new user if it doesn't exist
4. Grant ALL privileges to user on database
5. Update .env with correct credentials
6. Run migrations: `php artisan migrate --force`

---

## Error: "Composer not found"

### Solution 1: Find Composer
```bash
# Check common locations
which composer
/usr/local/bin/composer --version
/opt/php81/bin/php /usr/local/bin/composer --version
/opt/php80/bin/php /usr/local/bin/composer --version
```

### Solution 2: Install Composer Locally
```bash
# Download and install in project root
curl -sS https://getcomposer.org/installer | php
php composer.phar install --no-dev

# Or ask Hostinger support to install globally
```

### Solution 3: Upload Vendor Folder
1. Run locally: `composer install --no-dev`
2. Upload entire `vendor` folder via FTP to your server
3. Skip the composer install step

---

## Error: "Class 'PDO' not found"

PHP doesn't have MySQL extension.

```bash
# Check available extensions
php -m | grep -i pdo
php -m | grep -i mysql

# If missing, ask Hostinger to enable:
# - pdo_mysql
# - mysqli
```

---

## Error: "Symbolic link not allowed"

Shared hosting sometimes blocks symbolic links.

### Solution:
```bash
# Delete the symlink
rm -rf public/storage

# Manually create symlink
cd public
ln -s ../storage/app/public storage
cd ..

# Or create a redirect in public/index.php (not recommended)
```

---

## Error: "Permission Denied" for storage/logs

Storage directory not writable.

```bash
# Fix permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# More permissive (if above doesn't work)
chmod -R 777 storage
chmod -R 777 bootstrap/cache

# Or change ownership
chown -R nobody:nobody storage
chown -R nobody:nobody bootstrap/cache
```

---

## Website Loads But Assets (CSS/JS) Not Working

### Cause: Incorrect Storage Link or Asset Paths

```bash
# Check if storage link exists
ls -la public/
# Should show: storage -> ../storage/app/public

# If missing, recreate it
php artisan storage:link
# Or manually:
cd public && ln -s ../storage/app/public storage && cd ..
```

### Verify in public/.env (should be correct):
```
APP_URL=https://yourdomain.com
```

---

## Database Migrations Failed

### Error: "SQLSTATE[42S01]: Table already exists"
```bash
# Check if tables already exist
# If you're running migrate multiple times, tables might already exist

# Check tables in database
mysql -h localhost -u USERNAME -p DATABASE -e "SHOW TABLES;"

# If you need to reset (CAUTION - deletes all data):
php artisan migrate:reset
php artisan migrate --force
```

### Error: "migration.php has syntax errors"
```bash
# Check the error log
tail -100 storage/logs/laravel.log

# Fix syntax issues
php artisan migrate --help  # Check available options
```

---

## "Class not found" After Running composer install

```bash
# Clear Laravel's class cache
php artisan cache:clear

# Regenerate autoload
composer dump-autoload

# If still failing:
rm -rf vendor/
composer install --no-dev
```

---

## Email Not Sending from Contact Forms

### Check Configuration
```bash
# Edit .env
nano .env

# Verify these values match your email settings:
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=your_email@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
```

### Test Email
```bash
php artisan tinker
> Mail::raw('Test email', function($message) { $message->to('test@gmail.com'); });
> exit
```

### If Still Not Working:
1. Verify email account exists in cPanel
2. Use an app-specific password if 2FA is enabled
3. Check SMTP host (ask Hostinger - might be mail.yourdomain.com)
4. Check firewall isn't blocking port 587

---

## Website Works Locally But Not on Hostinger

### Step 1: Check App Environment
```bash
# Ensure production settings
grep APP_ENV .env
# Should be: APP_ENV=production

# Ensure debug is off
grep APP_DEBUG .env
# Should be: APP_DEBUG=false
```

### Step 2: Check PHP Version
```bash
php -v
# Should be 8.1 or higher
```

### Step 3: Compare .env Files
```bash
# Compare with local version
# Ensure database, mail, and app settings match
```

### Step 4: Check Laravel Logs
```bash
tail -200 storage/logs/laravel.log
```

---

## Performance Issues / Slow Loading

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Regenerate optimized caches for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optional: Clear browser cache (tell visitors)
# Instruct users to: Ctrl+Shift+Delete (hard refresh)
```

---

## "Call to undefined function" Errors

Usually means a package wasn't installed.

```bash
# Check if vendor exists and has content
ls -la vendor/ | wc -l
# Should show many folders (100+)

# If not, reinstall
composer install --no-dev

# If composer not available, upload vendor folder via FTP
```

---

## Running Out of Time / Need to Deploy Faster?

### Minimal Setup (Just to Get Running)
```bash
# 1. Clone repo
git clone https://github.com/harsha2122/i3realtors.git .

# 2. Copy env
cp .env.example .env

# 3. Install (or upload vendor)
composer install --no-dev

# 4. Generate key
php artisan key:generate

# 5. Configure database in .env
nano .env

# 6. Migrate
php artisan migrate --force

# 7. Create storage link
php artisan storage:link

# 8. Fix permissions
chmod -R 777 storage bootstrap/cache

# 9. Clear cache
php artisan cache:clear
php artisan config:cache
php artisan route:cache

# Done! Visit your domain
```

---

## Need Expert Help?

### Contact Hostinger Support
- **Chat:** Available 24/7 in Dashboard
- **Email:** support@hostinger.com
- **Phone:** Available for certain plans

### Tell them:
```
I'm deploying a Laravel 11 application with these requirements:
- PHP 8.1+
- MySQL 5.7+
- Composer
- mod_rewrite enabled
- Symbolic links allowed (if possible)
- Document root: public_html/public
```

---

## Quick Diagnostic Command

Run this to check your setup:
```bash
#!/bin/bash
echo "=== PHP Info ==="
php -v
echo ""
echo "=== Composer ==="
composer --version 2>/dev/null || echo "Composer not found"
echo ""
echo "=== Database Connection ==="
php artisan tinker -q << 'EOF'
try {
    DB::connection()->getPdo();
    echo "✓ Database connected\n";
} catch (\Exception $e) {
    echo "✗ Database error: " . $e->getMessage() . "\n";
}
exit();
EOF
echo ""
echo "=== Storage Permissions ==="
ls -la storage/ | head -3
echo ""
echo "=== .env Status ==="
grep -E "APP_KEY|APP_ENV|DB_HOST" .env | head -3
```

---

**Still stuck? Check `storage/logs/laravel.log` for detailed error messages!**
