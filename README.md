# Rabbit Alley POS (Offline)

A comprehensive offline-first Point of Sale system for club operations with multi-department printing, table management, and automated daily commission-based payroll.

## Features

- **Offline-First**: Works completely without internet, using localhost MySQL
- **Multi-Department Printing**: Kitchen, Bar, and LD tracking slips
- **Table Management**: Support for multiple areas (Lounge, Club, LD) with table status tracking
- **Role-Based Access Control**: 8 distinct roles with granular permissions
- **Commission Engine**: Automated daily payroll with allowance and commission computation
- **Audit Trail**: Comprehensive logging of all system events
- **Two-Person Approval**: Manager approval required for voids, discounts, and adjustments

## Tech Stack

- Laravel 11
- MySQL (localhost)
- Livewire 3 (for fast POS UI)
- Spatie Permissions (for RBAC)
- DomPDF (for reports)

## Installation

1. Install dependencies:
```bash
composer install
```

2. Copy environment file:
```bash
cp .env.example .env
```

3. Generate application key:
```bash
php artisan key:generate
```

4. Configure database in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rabbit_alley_pos
DB_USERNAME=root
DB_PASSWORD=your_password
```

5. Run migrations and seeders:
```bash
php artisan migrate --seed
```

6. Start the development server:
```bash
php artisan serve
```

## Default Login

After seeding, you can login with:
- **SuperAdmin**: admin@pos.local / password
- **Manager**: manager@pos.local / password
- **Cashier**: cashier@pos.local / password

## Daily Backup

The system includes automated daily backups. Configure backup settings in the admin panel.

## License

MIT
