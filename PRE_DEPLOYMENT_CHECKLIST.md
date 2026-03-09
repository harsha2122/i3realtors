# PRE-DEPLOYMENT CHECKLIST

Complete this checklist BEFORE starting deployment to avoid issues.

## HOSTINGER ACCOUNT SETUP

- [ ] Hostinger account created
- [ ] Domain registered and pointing to Hostinger
- [ ] SSH access enabled (check in Dashboard > Security)
- [ ] SSH key pair generated (or password ready)
- [ ] Can SSH into server successfully

**SSH Test:**
```bash
ssh username@hostinger_ip
# or
ssh -l username hostinger_ip
```

---

## DATABASE PREPARATION

- [ ] MySQL database created in cPanel/Hostinger
- [ ] Database name noted: ___________________
- [ ] Database username created: ___________________
- [ ] Database password set: ___________________
- [ ] User has ALL privileges on the database

**How to create in Hostinger:**
1. Login to Hostinger Dashboard
2. Go to **Databases** section
3. Click "Create Database"
4. Set Name, Username, Password
5. Grant privileges

---

## GITHUB SETUP

- [ ] Repository is public OR you have SSH key access
- [ ] Repository URL ready: ___________________

**For Public Repo:**
```bash
git clone https://github.com/your-username/i3realtors.git .
```

**For Private Repo:**
```bash
# You'll need SSH key on Hostinger
# Ask Hostinger support to help set up SSH keys
```

---

## LOCAL SYSTEM CHECK (BEFORE UPLOADING)

- [ ] Node.js 18+ installed (for asset compilation)
- [ ] npm or yarn installed
- [ ] Composer installed
- [ ] Git installed
- [ ] PHP 8.1+ installed locally

**Check Commands:**
```bash
node -v
npm -v
composer -v
git -v
php -v
```

---

## REPOSITORY READY

- [ ] Latest code committed and pushed to GitHub
- [ ] .env.example file exists in repo
- [ ] No sensitive data in .env.example
- [ ] All migrations are in database/migrations/
- [ ] All models are properly defined
- [ ] Package dependencies listed in composer.json

**Verify before pushing:**
```bash
# Check .env.example doesn't have secrets
cat .env.example

# Ensure key files exist
ls -la .env.example
ls -la database/migrations/
ls -la composer.json
```

---

## DOMAIN CONFIGURATION

- [ ] Domain name ready: ___________________
- [ ] Domain registered (can be anywhere, just needs to point to Hostinger)
- [ ] Domain nameservers point to Hostinger
- [ ] DNS fully propagated (wait 24-48 hours if just updated)

**Check DNS propagation:**
```bash
nslookup yourdomain.com
# Should show Hostinger's nameservers
```

---

## HOSTINGER PANEL SETUP

In Hostinger Dashboard, have these ready:

- [ ] Addon Domain created (if using subdomain)
- [ ] Document Root set to `public_html/public`
- [ ] SSL/TLS certificate assigned (auto-enabled)
- [ ] File Manager accessible

---

## EMAIL SETUP (For Contact Forms)

- [ ] Email account created for website: noreply@yourdomain.com
  OR use existing email account
- [ ] Email password ready
- [ ] SMTP server address: (usually smtp.hostinger.com)
- [ ] SMTP port: (usually 587 or 465)

**Create in Hostinger:**
1. Dashboard > Email Accounts
2. Create: noreply@yourdomain.com
3. Set strong password

---

## PHP & SERVER REQUIREMENTS

SSH into your Hostinger server and verify:

```bash
# PHP Version (should be 8.1+)
php -v

# Check installed extensions needed
php -m | grep -i pdo
php -m | grep -i mysql
php -m | grep -i curl
php -m | grep -i json

# Check if Composer is available
composer --version

# Check if mod_rewrite is enabled (Apache)
php -m | grep -i rewrite
```

**If missing extensions:** Contact Hostinger support

---

## STORAGE SPACE CHECK

- [ ] At least 500 MB free disk space

**Check available space:**
```bash
df -h ~/public_html
# Look for "Avail" column - should show 500M+
```

---

## BACKUP PLAN

IMPORTANT: Have a backup before deploying!

- [ ] Current website backed up (if exists)
- [ ] Database backed up (if has existing data)
- [ ] Can rollback if needed

**Create backup:**
```bash
# On Hostinger (via cPanel)
1. Go to Backups
2. Click "Backup Now"
3. Wait for completion
```

---

## OPTIONAL BUT RECOMMENDED

- [ ] SSL certificate generated (Hostinger provides free)
- [ ] HTTPS forced in .env (APP_URL=https://...)
- [ ] Cron jobs permission available
- [ ] FTP access available (for manual file uploads if needed)

---

## PRE-DEPLOYMENT STEPS

Before running the deployment script:

1. [ ] Read DEPLOYMENT_SOP.md completely
2. [ ] Have all checklist items marked above
3. [ ] Have credentials written down somewhere safe
4. [ ] Test SSH connection one more time
5. [ ] Clear 1-2 hours for deployment (first time)

---

## DEPLOYMENT ORDER

1. **SSH into Hostinger**
2. **Navigate to public_html**
3. **Clone repository**
4. **Create .env file**
5. **Install dependencies** (composer)
6. **Generate key**
7. **Configure database**
8. **Run migrations**
9. **Create storage link**
10. **Set permissions**
11. **Test website**
12. **Configure email** (if needed)
13. **Set up monitoring** (optional)

---

## QUICK START COMMAND

After SSH and in public_html, run:

```bash
bash QUICK_DEPLOY.sh
```

This will guide you through each step interactively.

---

## POST-DEPLOYMENT VERIFICATION

After deployment, verify:

- [ ] Homepage loads at https://yourdomain.com
- [ ] CSS and JS files load (check in browser Dev Tools)
- [ ] Admin panel accessible at /admin
- [ ] Database connection working (check error logs)
- [ ] No 500 errors in storage/logs/laravel.log
- [ ] Contact form submits (check if email works)
- [ ] Analytics dashboard accessible

---

## COMMON MISTAKES TO AVOID

- ❌ Not setting document root to `public_html/public`
- ❌ Using wrong database credentials
- ❌ Forgetting to run `php artisan migrate`
- ❌ Not creating storage link
- ❌ Pushing sensitive data to GitHub
- ❌ Running `composer install` without `--no-dev` (bloats server)
- ❌ Not fixing file permissions on storage/
- ❌ Using APP_DEBUG=true in production
- ❌ Not verifying .env before running migrations
- ❌ Deploying without backup

---

## GETTING HELP

If you get stuck:

1. **Check error logs:**
   ```bash
   tail -100 storage/logs/laravel.log
   ```

2. **Read TROUBLESHOOTING.md**

3. **Check this checklist** - did you miss a step?

4. **Contact Hostinger Support:**
   - Available 24/7 in Dashboard
   - Mention: "Laravel app deployment issue"

5. **Check Hostinger Forums:**
   - Often have Laravel-specific guides

---

## ESTIMATED TIME

- **First deployment:** 30-60 minutes
- **Re-deployment:** 5-10 minutes
- **Troubleshooting:** Varies (check logs first!)

---

## CREDENTIALS TO HAVE READY

Gather these BEFORE starting:

| Item | Value |
|------|-------|
| Hostinger Username | _________________ |
| SSH Password | _________________ |
| Domain | _________________ |
| Database Name | _________________ |
| DB Username | _________________ |
| DB Password | _________________ |
| Email (for forms) | _________________ |
| Email Password | _________________ |
| GitHub URL | _________________ |

---

**You're ready to deploy when all items are checked! Good luck!** 🚀
