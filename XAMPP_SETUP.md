# XAMPP Setup Guide - Rabbit Alley POS

## Option 1: Using Laravel's Built-in Server (Recommended)

**You can keep your project anywhere** (e.g., `E:\CoreDev\Projects\POS`)

1. **Start XAMPP MySQL** (from XAMPP Control Panel)
   - Click "Start" next to MySQL

2. **Run Laravel's development server:**
   ```bash
   cd E:\CoreDev\Projects\POS
   php artisan serve
   ```

3. **Access the application:**
   - Open browser: `http://localhost:8000`

**Advantages:**
- ✅ No need to move files
- ✅ No Apache configuration needed
- ✅ Works with XAMPP MySQL
- ✅ Easy to start/stop

---

## Option 2: Using XAMPP Apache (Optional)

If you prefer to use XAMPP's Apache server:

### Method A: Project in htdocs

1. **Move or create symlink:**
   - Option 1: Copy project to `C:\xampp\htdocs\pos`
   - Option 2: Create symlink (recommended):
     ```bash
     mklink /D C:\xampp\htdocs\pos E:\CoreDev\Projects\POS
     ```

2. **Configure Virtual Host** (optional but recommended):
   
   Edit `C:\xampp\apache\conf\extra\httpd-vhosts.conf`:
   ```apache
   <VirtualHost *:80>
       ServerName pos.local
       DocumentRoot "C:/xampp/htdocs/pos/public"
       <Directory "C:/xampp/htdocs/pos/public">
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```

3. **Edit hosts file** (`C:\Windows\System32\drivers\etc\hosts`):
   ```
   127.0.0.1    pos.local
   ```

4. **Access:** `http://pos.local` or `http://localhost/pos`

### Method B: Project Outside htdocs (Virtual Host)

1. **Keep project where it is** (e.g., `E:\CoreDev\Projects\POS`)

2. **Configure Virtual Host:**
   
   Edit `C:\xampp\apache\conf\extra\httpd-vhosts.conf`:
   ```apache
   <VirtualHost *:80>
       ServerName pos.local
       DocumentRoot "E:/CoreDev/Projects/POS/public"
       <Directory "E:/CoreDev/Projects/POS/public">
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```

3. **Edit hosts file** (`C:\Windows\System32\drivers\etc\hosts`):
   ```
   127.0.0.1    pos.local
   ```

4. **Restart Apache** from XAMPP Control Panel

5. **Access:** `http://pos.local`

---

## Database Configuration

Regardless of which option you choose, configure your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rabbit_alley_pos
DB_USERNAME=root
DB_PASSWORD=
```

**Note:** XAMPP MySQL default password is usually empty (blank).

---

## Quick Start (Recommended)

1. Start XAMPP MySQL
2. Run `php artisan serve` from your project directory
3. Access `http://localhost:8000`

**That's it!** No need to touch htdocs or Apache configuration.

---

## Troubleshooting

### Port 8000 already in use?

Use a different port:
```bash
php artisan serve --port=8001
```

### Can't connect to MySQL?

1. Check XAMPP Control Panel - MySQL should be running (green)
2. Verify credentials in `.env`
3. Create database manually in phpMyAdmin if needed:
   - Go to `http://localhost/phpmyadmin`
   - Create database: `rabbit_alley_pos`

### Permission errors?

On Windows, ensure:
- You have write permissions to `storage` and `bootstrap/cache` folders
- If using Apache, check Apache user permissions
