# Setup Guide - Rabbit Alley POS on Another PC

This guide will help you set up the Rabbit Alley POS system on a new computer.

## Prerequisites

Before starting, ensure you have the following installed on the new PC:

### Required Software:

1. **PHP 8.2 or higher**
   - Download from: https://www.php.net/downloads.php
   - Or use XAMPP/WAMP which includes PHP, MySQL, and Apache
   - Verify installation: `php -v`

2. **MySQL 5.7+ or MariaDB 10.3+**
   - Download from: https://dev.mysql.com/downloads/
   - Or use XAMPP/WAMP which includes MySQL
   - Verify installation: `mysql --version`

3. **Composer** (PHP dependency manager)
   - Download from: https://getcomposer.org/download/
   - Verify installation: `composer --version`

4. **Node.js and npm** (for frontend assets)
   - Download from: https://nodejs.org/
   - Verify installation: `node -v` and `npm -v`

### PHP Extensions Required:

Make sure these PHP extensions are enabled in your `php.ini`:
- `fileinfo`
- `gd`
- `mysqli`
- `pdo_mysql`
- `mbstring`
- `openssl`
- `curl`
- `zip`

**To enable extensions:**
1. Find your php.ini file: `php --ini`
2. Open php.ini in a text editor (as Administrator on Windows)
3. Remove semicolons (;) before these extension lines
4. Save and restart your web server

---

## Step-by-Step Installation

### Step 1: Copy Project Files

Copy the entire project folder to the new PC. You can:
- Copy via USB drive
- Use Git: `git clone <repository-url>`
- Zip the folder and transfer it

### Step 2: Install PHP Dependencies

Open a terminal/command prompt in the project folder and run:

```bash
composer install
```

This will install all Laravel and PHP packages.

### Step 3: Install Node.js Dependencies

```bash
npm install
```

This will install frontend dependencies (Vite, Tailwind CSS, etc.).

### Step 4: Configure Environment

1. Copy the environment example file:
   ```bash
   copy .env.example .env
   ```
   (On Linux/Mac: `cp .env.example .env`)

2. Open `.env` file in a text editor and configure:

   **Database Configuration:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=rabbit_alley_pos
   DB_USERNAME=root
   DB_PASSWORD=your_mysql_password
   ```
   Replace `your_mysql_password` with your MySQL root password (leave empty if no password).

   **Application Configuration:**
   ```env
   APP_NAME="Rabbit Alley POS"
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost:8000
   ```

### Step 5: Generate Application Key

```bash
php artisan key:generate
```

This creates a unique encryption key for your application.

### Step 6: Create Database

1. Open MySQL command line or phpMyAdmin
2. Create a new database:
   ```sql
   CREATE DATABASE rabbit_alley_pos;
   ```
   Or use phpMyAdmin to create it via the web interface.

### Step 7: Run Database Migrations and Seeders

```bash
php artisan migrate --seed
```

This will:
- Create all database tables
- Create roles and permissions
- Seed default areas, tables, departments, categories, and products
- Create default user accounts

### Step 8: Build Frontend Assets

For production:
```bash
npm run build
```

For development (with hot reload):
```bash
npm run dev
```

### Step 9: Set Storage Permissions (Important!)

**On Windows:**
- Ensure the web server user has write permissions to:
  - `storage/` folder
  - `bootstrap/cache/` folder

**On Linux/Mac:**
```bash
chmod -R 775 storage bootstrap/cache
```

### Step 10: Start the Development Server

```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

---

## Default Login Credentials

After setup, you can login with any of these accounts:

| Role | Email | Password |
|------|-------|----------|
| SuperAdmin | admin@pos.local | password |
| Manager | manager@pos.local | password |
| Cashier | cashier@pos.local | password |
| Waitress | waitress@pos.local | password |
| Bartender | bartender@pos.local | password |
| Kitchen Staff | kitchen@pos.local | password |
| LD Manager | ldmanager@pos.local | password |
| Auditor | auditor@pos.local | password |

**⚠️ Important:** Change these passwords after first login in production!

---

## Quick Setup Checklist

- [ ] PHP 8.2+ installed
- [ ] MySQL installed and running
- [ ] Composer installed
- [ ] Node.js and npm installed
- [ ] PHP extensions enabled (fileinfo, gd, mysqli, pdo_mysql, mbstring, openssl, curl, zip)
- [ ] Project files copied to new PC
- [ ] `composer install` completed
- [ ] `npm install` completed
- [ ] `.env` file created and configured
- [ ] Database created
- [ ] `php artisan key:generate` executed
- [ ] `php artisan migrate --seed` completed
- [ ] `npm run build` completed
- [ ] Storage permissions set
- [ ] Server started with `php artisan serve`

---

## Troubleshooting

### Issue: "Class not found" or "Composer autoload error"
**Solution:** Run `composer dump-autoload`

### Issue: "Permission denied" on storage
**Solution:** Check folder permissions for `storage/` and `bootstrap/cache/`

### Issue: Database connection error
**Solution:** 
- Verify MySQL is running
- Check database credentials in `.env`
- Ensure database exists

### Issue: "Vite not found" or frontend assets not loading
**Solution:** 
- Run `npm install`
- Run `npm run build` (or `npm run dev` for development)

### Issue: PHP extension missing
**Solution:** Enable the required extension in `php.ini` and restart web server

### Issue: Port 8000 already in use
**Solution:** Use a different port:
```bash
php artisan serve --port=8001
```

---

## Production Deployment

For production use:

1. Set in `.env`:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

2. Optimize the application:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. Set up a proper web server (Apache/Nginx) instead of `php artisan serve`

4. Set up daily backup cron job:
   ```
   59 23 * * * cd /path/to/project && php artisan backup:daily
   ```

---

## Need Help?

If you encounter issues:
1. Check the `INSTALLATION.md` file for detailed troubleshooting
2. Verify all prerequisites are installed correctly
3. Check Laravel logs in `storage/logs/laravel.log`
