# I3 REALTORS - HOSTINGER DEPLOYMENT SOP

## Prerequisites
- SSH access to Hostinger server
- Domain pointing to Hostinger
- MySQL database created in cPanel/Hostinger dashboard
- GitHub access (public or via SSH key)
- PHP 8.1+ (check with `php -v` over SSH)

---

## STEP 1: SSH INTO YOUR SERVER

```bash
ssh -l username hostinger_server_ip
# or
ssh username@hostinger_server_ip
```

When prompted, enter your password.

---

## STEP 2: NAVIGATE TO PUBLIC_HTML

```bash
cd ~/public_html
```

Or if you have a subdomain:
```bash
cd ~/public_html/subdomain_name
```

---

## STEP 3: REMOVE DEFAULT FILES (IF ANY)

```bash
ls -la
# Delete default files/folders (index.html, etc.) if they exist
rm -f index.html
rm -f .htaccess
```

---

## STEP 4: CLONE THE REPOSITORY

### Option A: Public Repository (No SSH key needed)
```bash
git clone https://github.com/harsha2122/i3realtors.git .
```

### Option B: Private Repository (SSH key setup needed)
If private, you'll need to set up SSH key on Hostinger first. Ask your hosting provider about their git setup.

**Note:** The `.` at the end clones the repo contents directly into public_html without creating a subfolder.

---

## STEP 5: VERIFY GIT CLONE

```bash
ls -la
# You should see: app, routes, public, database, vendor, etc.
```

---

## STEP 6: CREATE .ENV FILE

```bash
cp .env.example .env
# OR if .env.example doesn't exist, create it manually
```

Edit the .env file:
```bash
nano .env
```

**Update these values with YOUR Hostinger details:**

```env
APP_NAME="I3 Realtors"
APP_ENV=production
APP_KEY=                    # Leave blank for now, we'll generate it
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database Configuration (from cPanel)
DB_CONNECTION=mysql
DB_HOST=localhost           # Usually localhost on shared hosting
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Mail Configuration (Optional - for contact forms)
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=your_email@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# Disable Analytics Tracking (Optional)
ANALYTICS_ENABLED=true
```

**Save:** Press `Ctrl + X`, then `Y`, then `Enter`

---

## STEP 7: INSTALL COMPOSER DEPENDENCIES

```bash
# Check if composer is installed
composer --version

# If not found, check with full path
/usr/local/bin/composer --version
# or
/opt/php81/bin/php /usr/local/bin/composer --version
```

**If Composer is available:**
```bash
composer install --no-dev --optimize-autoloader
```

**If Composer is NOT available:**
You'll need to upload `vendor` folder via FTP or ask Hostinger to install Composer.

---

## STEP 8: GENERATE APP KEY

```bash
php artisan key:generate
```

This will automatically update your .env file with the APP_KEY.

---

## STEP 9: CREATE DATABASE & RUN MIGRATIONS

**First, verify your database credentials in cPanel:**
1. Log in to cPanel/Hostinger Dashboard
2. Go to MySQL Databases
3. Note: Database name, username, password

**Then run migrations:**
```bash
php artisan migrate --force
```

The `--force` flag is needed in production.

**Expected output:**
```
Running migrations...
2024_01_15_... ............................ DONE
2024_01_16_... ............................ DONE
...
```

---

## STEP 10: SEED DATABASE (Optional - Create Demo Data)

```bash
php artisan db:seed --class=DatabaseSeeder
```

Skip this if you don't want demo data.

---

## STEP 11: CREATE SYMBOLIC LINKS

```bash
# This makes storage/app/public accessible via web
php artisan storage:link
```

Expected output:
```
The [public/storage] link has been successfully created.
```

---

## STEP 12: SET CORRECT FILE PERMISSIONS

```bash
# Make storage writable
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Make everything group-writable for web server
chown -R nobody:nobody .
chmod -R 755 .
```

**More permissive (if above doesn't work):**
```bash
chmod -R 777 storage
chmod -R 777 bootstrap/cache
```

---

## STEP 13: CONFIGURE .HTACCESS FOR LARAVEL

Your public folder needs specific Apache configuration. The repo should include:

**Check if `/public/.htaccess` exists:**
```bash
cat public/.htaccess
```

**If it doesn't exist, create it:**
```bash
nano public/.htaccess
```

**Paste this content:**
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{TYPE} ^application/x-www-form-urlencoded$
    RewriteCond %{REQUEST_METHOD} ^POST$
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

## STEP 14: SET UP ROOT .HTACCESS

Hostinger might need a root-level .htaccess to point to public folder:

```bash
nano .htaccess
```

**Paste this content:**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteCond %{REQUEST_URI} !^public
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

---

## STEP 15: VERIFY PUBLIC FOLDER IS SET

**In cPanel:**
1. Go to **Public_html** or **Addon Domains**
2. Make sure your domain points to `public_html/public` (NOT `public_html`)

**OR set it via command:**
```bash
# If using addon domain, edit the public_html/public configuration
# Contact Hostinger support if you can't access cPanel for this
```

---

## STEP 16: SET UP CRON JOB (Optional - For Scheduled Tasks)

For daily analytics summaries and queue processing:

**In cPanel:**
1. Go to **Cron Jobs**
2. Add this cron job:

```
* * * * * /usr/local/bin/php /home/username/public_html/artisan schedule:run
```

Replace `username` with your actual username.

---

## STEP 17: VERIFY INSTALLATION

### Check PHP Version
```bash
php -v
# Should be 8.1 or higher
```

### Check Laravel Installation
```bash
php artisan --version
# Should output: Laravel Framework X.X.X
```

### Check Database Connection
```bash
php artisan tinker
# Then type: DB::connection()->getPdo();
# Should return a PDO object (no error)
# Then type: exit
```

### Check Storage Link
```bash
ls -la public/storage
# Should show a symlink arrow: -> ../storage/app/public
```

---

## STEP 18: TEST YOUR WEBSITE

Open your browser and visit:
```
https://yourdomain.com
```

**You should see:**
- Homepage loads without errors
- Assets (CSS, JS) load correctly
- No 500 errors in console

---

## STEP 19: CHECK ERROR LOGS

If something breaks:

```bash
# Laravel error log
tail -50 storage/logs/laravel.log

# PHP error log
tail -50 /var/log/php-fpm/www-error.log

# Apache error log
tail -50 /var/log/apache2/error_log
```

---

## TROUBLESHOOTING COMMON ISSUES

### Issue 1: "404 Not Found" on Everything
**Solution:**
```bash
# Re-check public folder setup in cPanel
# Verify .htaccess exists in public/
# Make sure APP_URL in .env matches your domain
```

### Issue 2: "500 Internal Server Error"
**Solution:**
```bash
# Check storage permissions
chmod -R 777 storage bootstrap/cache

# Check logs
tail -50 storage/logs/laravel.log
```

### Issue 3: "No Application Key Set"
**Solution:**
```bash
php artisan key:generate
```

### Issue 4: "Could not find driver" (Database)
**Solution:**
```bash
# Check database credentials in .env
# Verify database exists in cPanel MySQL Databases
# Check PHP has mysqli extension: php -m | grep mysql
```

### Issue 5: "Storage Symbolic Link Error"
**Solution:**
```bash
# If storage:link fails, manually create symlink
cd public
ln -s ../storage/app/public storage
```

### Issue 6: "Composer Not Found"
**Solution:**
Option A - Ask Hostinger to install Composer
Option B - Upload vendor folder via FTP from your local machine
Option C - Use this command:
```bash
curl -sS https://getcomposer.org/installer | php
php composer.phar install --no-dev
```

---

## STEP 20: OPTIMIZE PRODUCTION

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## FINAL CHECKLIST

- [ ] SSH access working
- [ ] Repository cloned to public_html
- [ ] .env file created with correct credentials
- [ ] Composer dependencies installed
- [ ] APP_KEY generated
- [ ] Database migrated
- [ ] Storage link created
- [ ] File permissions set correctly
- [ ] .htaccess configured in public folder
- [ ] Domain properly configured (points to public folder)
- [ ] Website loads without 500 errors
- [ ] Admin panel accessible
- [ ] API endpoints working
- [ ] Cron job set up
- [ ] Error logs checked

---

## ROLLBACK IF NEEDED

If something goes wrong:

```bash
# Delete everything
rm -rf /home/username/public_html/*

# Restore from backup (if available)
# OR re-clone the repository and start over
```

---

## SUPPORT

**Common Hostinger Features:**
- File Manager: In cPanel under "File Manager"
- Terminal/SSH: In Hostinger Dashboard under "Advanced > Terminal"
- Database: In Hostinger Dashboard under "Databases"
- Email: In Hostinger Dashboard under "Email Accounts"

**For specific Hostinger issues:** Contact their 24/7 support chat.

---

## POST-DEPLOYMENT

After deployment, you should:

1. **Set up domain email** (for contact forms)
   - Go to Hostinger Dashboard > Email Accounts
   - Create email for noreply@yourdomain.com

2. **Enable HTTPS/SSL**
   - Hostinger provides free SSL (usually auto-enabled)
   - Verify in Dashboard > Security > SSL

3. **Set up backups**
   - Enable automatic backups in Dashboard

4. **Monitor errors**
   - Regularly check `storage/logs/laravel.log`

5. **Update analytics**
   - Visit `/admin/analytics/dashboard` to see visitor stats

---

**Deployment completed! Your website is now live.** 🎉
