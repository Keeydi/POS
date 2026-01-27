# Installation Guide - Rabbit Alley POS

## Prerequisites

- PHP 8.2 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Composer
- Node.js and npm (for frontend assets)

## Step-by-Step Installation

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Environment Configuration

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Edit `.env` and configure your database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rabbit_alley_pos
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Create Database

Create a MySQL database named `rabbit_alley_pos` (or your preferred name).

### 5. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

This will:
- Create all database tables
- Create roles and permissions
- Seed default areas, tables, departments, categories, and products
- Create default users

### 6. Build Frontend Assets

```bash
npm run build
```

For development:

```bash
npm run dev
```

### 7. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Default Login Credentials

After seeding, you can login with:

- **SuperAdmin**: admin@pos.local / password
- **Manager**: manager@pos.local / password
- **Cashier**: cashier@pos.local / password
- **Waitress**: waitress@pos.local / password
- **Bartender**: bartender@pos.local / password
- **Kitchen**: kitchen@pos.local / password
- **LD Manager**: ldmanager@pos.local / password
- **Auditor**: auditor@pos.local / password

## Daily Backup Setup

The system includes automated daily backups. To test manually:

```bash
php artisan backup:daily
```

Backups are stored in `storage/app/backups/` and are automatically compressed as ZIP files. Old backups (older than 30 days) are automatically cleaned up.

## Production Deployment

1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
2. Run `php artisan config:cache`
3. Run `php artisan route:cache`
4. Run `php artisan view:cache`
5. Set up a cron job for daily backups:
   ```
   59 23 * * * cd /path/to/project && php artisan backup:daily
   ```

## Troubleshooting

### PHP Extension Issues (fileinfo, mysqli, etc.)

If you get errors about missing PHP extensions:

1. **Find your php.ini file:**
   ```bash
   php --ini
   ```
   This will show you which php.ini file is being used (e.g., `D:\php\php.ini`)

2. **Open php.ini in a text editor** (as Administrator on Windows)

3. **Find and uncomment (remove the semicolon) these lines:**
   ```ini
   extension=fileinfo
   extension=gd
   extension=mysqli
   extension=pdo_mysql
   extension=mbstring
   extension=openssl
   extension=curl
   extension=zip
   ```
   
   **Note:** The `gd` extension is required for Excel/PDF generation. The `fileinfo` extension is required by Livewire.

4. **Save the file and restart your web server** (if using Apache/Nginx) or restart PHP-FPM

5. **Verify extensions are loaded:**
   ```bash
   php -m
   ```
   You should see `fileinfo`, `mysqli`, `pdo_mysql`, etc. in the list

**Quick workaround (not recommended for production):**
If you need to proceed quickly and can't enable extensions immediately:
```bash
composer install --ignore-platform-req=ext-fileinfo
```
However, you should enable the extension properly as it's required for the application to work correctly.

### Permission Issues

If you encounter permission issues with storage:

```bash
chmod -R 775 storage bootstrap/cache
```

On Windows, ensure the web server user has write permissions to the `storage` and `bootstrap/cache` directories.

### Database Connection Issues

Ensure MySQL is running and credentials in `.env` are correct.

### Livewire Not Working

Clear caches:

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```
