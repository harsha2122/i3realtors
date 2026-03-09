#!/bin/bash
# I3 REALTORS - QUICK DEPLOYMENT SCRIPT FOR HOSTINGER
# Run this script after SSH into your Hostinger server in public_html

set -e  # Exit on any error

echo "================================"
echo "I3 REALTORS - HOSTINGER DEPLOY"
echo "================================"
echo ""

# Color codes
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[✓]${NC} $1"
}

print_error() {
    echo -e "${RED}[✗]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[!]${NC} $1"
}

# Check if running from public_html
if [[ $(basename "$PWD") != "public_html" && ! "$PWD" =~ public_html ]]; then
    print_warning "You should run this script from public_html directory"
    echo "Current directory: $PWD"
    read -p "Continue anyway? (y/n) " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        exit 1
    fi
fi

# Step 1: Clone or Pull Repository
echo ""
echo "Step 1: Getting Latest Code from GitHub..."
if [ -d ".git" ]; then
    print_status "Repository already exists, pulling latest changes..."
    git pull origin main
else
    print_status "Cloning repository..."
    read -p "Enter GitHub URL (default: https://github.com/harsha2122/i3realtors.git): " GITHUB_URL
    GITHUB_URL=${GITHUB_URL:-https://github.com/harsha2122/i3realtors.git}
    git clone "$GITHUB_URL" .
fi

# Step 2: Create .env file
echo ""
echo "Step 2: Creating .env file..."
if [ ! -f ".env" ]; then
    if [ -f ".env.example" ]; then
        cp .env.example .env
        print_status ".env created from .env.example"
    else
        print_error ".env.example not found!"
        exit 1
    fi
else
    print_warning ".env already exists, skipping..."
fi

# Step 3: Get database details
echo ""
echo "Step 3: Database Configuration"
read -p "Enter database name: " DB_NAME
read -p "Enter database username: " DB_USER
read -sp "Enter database password: " DB_PASS
echo ""
read -p "Enter your domain (e.g., example.com): " DOMAIN

# Update .env file
sed -i "s/^DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" .env
sed -i "s/^DB_USERNAME=.*/DB_USERNAME=$DB_USER/" .env
sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=$DB_PASS/" .env
sed -i "s|^APP_URL=.*|APP_URL=https://$DOMAIN|" .env
sed -i "s/^APP_DEBUG=.*/APP_DEBUG=false/" .env
sed -i "s/^APP_ENV=.*/APP_ENV=production/" .env

print_status "Database credentials configured"

# Step 4: Install Composer Dependencies
echo ""
echo "Step 4: Installing Composer Dependencies..."
if command -v composer &> /dev/null; then
    print_status "Composer found, installing dependencies..."
    composer install --no-dev --optimize-autoloader
else
    print_error "Composer not found!"
    print_warning "Trying alternative paths..."

    if [ -f "/usr/local/bin/composer" ]; then
        /usr/local/bin/composer install --no-dev --optimize-autoloader
        print_status "Dependencies installed with /usr/local/bin/composer"
    elif [ -f "/opt/php81/bin/php" ]; then
        /opt/php81/bin/php /usr/local/bin/composer install --no-dev --optimize-autoloader
        print_status "Dependencies installed"
    else
        print_error "Could not find Composer! Please install manually or upload vendor folder via FTP."
        read -p "Continue without installing dependencies? (y/n) " -n 1 -r
        echo
        if [[ ! $REPLY =~ ^[Yy]$ ]]; then
            exit 1
        fi
    fi
fi

# Step 5: Generate App Key
echo ""
echo "Step 5: Generating Application Key..."
php artisan key:generate
print_status "Application key generated"

# Step 6: Run Migrations
echo ""
echo "Step 6: Running Database Migrations..."
read -p "Run migrations now? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan migrate --force
    print_status "Migrations completed"
else
    print_warning "Skipped migrations. Run manually: php artisan migrate --force"
fi

# Step 7: Create Storage Link
echo ""
echo "Step 7: Creating Storage Symbolic Link..."
if php artisan storage:link 2>/dev/null; then
    print_status "Storage link created"
else
    print_warning "storage:link failed. Creating manual symlink..."
    cd public
    ln -s ../storage/app/public storage 2>/dev/null || print_error "Could not create storage symlink"
    cd ..
fi

# Step 8: Set Permissions
echo ""
echo "Step 8: Setting File Permissions..."
chmod -R 755 storage 2>/dev/null || print_warning "Could not chmod storage"
chmod -R 755 bootstrap/cache 2>/dev/null || print_warning "Could not chmod bootstrap/cache"
chown -R nobody:nobody . 2>/dev/null || print_warning "Could not chown files (you may need sudo)"
print_status "Permissions updated"

# Step 9: Clear Caches
echo ""
echo "Step 9: Clearing Caches..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
print_status "Caches cleared"

# Step 10: Optimize for Production
echo ""
echo "Step 10: Optimizing for Production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
print_status "Production optimization completed"

# Summary
echo ""
echo "================================"
echo -e "${GREEN}DEPLOYMENT COMPLETE!${NC}"
echo "================================"
echo ""
echo "Next steps:"
echo "1. Verify your .env file: nano .env"
echo "2. Check your website: https://$DOMAIN"
echo "3. Access admin panel: https://$DOMAIN/admin"
echo "4. View logs if errors: tail -50 storage/logs/laravel.log"
echo ""
echo "If you get 404 errors:"
echo "  - Ensure your domain points to public_html/public in cPanel"
echo "  - Check that public/.htaccess exists"
echo ""
echo "For issues, see DEPLOYMENT_SOP.md"
echo ""
