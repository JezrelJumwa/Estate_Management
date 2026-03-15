# Estate Management System (Laravel 12)

A modern, secure Estate Management System built with Laravel 12 for property, estate, tenant, and booking management.

## Implementation Status (March 2026)

### Completed Features

- Authentication (login, register, logout, profile)
- Role-based access control (Administrator, Landlord, Tenant)
- Full CRUD for Users (admin only)
- Full CRUD for Houses
- Full CRUD for Estates
- Full CRUD for Bookings
- Landlord ownership enforcement:
   - Landlords only manage their own houses/estates
   - Landlords only view/edit bookings for their own houses
- Tenant experience:
   - Tenants can browse available houses
   - Tenants can create and manage their own bookings
- House image upload and storage via `storage/app/public`
- Dashboard metrics and recent activity panels
- REST API (token-based) for mobile/backend integration
- Payments module with online gateway service abstraction (sandbox/simulated)
- Automated rent reminders (scheduled command + notifications)
- Maintenance request tracking
- Document management and downloads
- Tenant portal view and tenant-centered actions
- Reporting dashboard with CSV export for payments
- Multi-language support (English/Swahili locale switch)
- SMS integration abstraction with delivery logging

### In Progress / Recommended Next

- Convert `system_rights` to fully enforced, fine-grained permissions across all route actions
- Add audit logging for sensitive actions (user updates/deletions, booking status changes)
- Add dedicated Feature tests for ownership and authorization scenarios
- Replace sandbox payment gateway service with real provider credentials/webhooks
- Replace SMS logger with real provider delivery (e.g., Twilio/AfricasTalking)

## Overview

This is a complete rewrite of the legacy PHP Estate Management system, now using the Laravel framework to provide enhanced security, maintainability, and modern development practices.

### Key Features

- **User Management**: Registration and management of users with role-based access (Administrator, Landlord, Tenant)
- **House Management**: Add, edit, delete, and view properties with image uploads
- **Estate Management**: Manage multiple estates and their associated properties
- **Booking System**: Track house availability and tenant bookings
- **Role-Based Access Control**: Different permissions for Administrators, Landlords, and Tenants
- **Secure Authentication**: Laravel's built-in authentication with password hashing
- **REST API**: Token-authenticated endpoints for login, houses, bookings, and payments
- **Payments**: Record and track rent payments via a gateway service layer
- **Notifications & Reminders**: Automated rent reminders using Laravel scheduler and notifications
- **Maintenance Requests**: Capture and manage property maintenance issues
- **Document Management**: Upload metadata and download managed tenant/property documents
- **Reporting**: Revenue and payment reporting with CSV export
- **Internationalization**: Runtime locale switching (English and Swahili)
- **Modern UI**: Responsive interface using Blade templates

## Requirements

- **PHP**: >= 8.2
- **Composer**: Latest version
- **Database**: MySQL 8.0+ or PostgreSQL 13+
- **Node.js**: >= 18.x (for asset compilation)
- **NPM**: Latest version

## Installation

### 1. Clone the Repository

```bash
cd /Users/jezreljumwa/IdeaProjects/Personal/Estate_Management
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Configuration

Copy the example environment file:

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials:

```env
APP_NAME="Estate Management"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=estate_management
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Database Migrations

```bash
php artisan migrate
```

If you are upgrading from an earlier version of this repository, run this new migration too:

```bash
php artisan migrate
```

This includes the landlord ownership column on houses.

This will create all necessary tables and seed initial data including:
- User statuses (ACTIVE, INACTIVE)
- System roles (ADMINISTRATOR, LANDLORD, TENANT)
- Booking statuses (AVAILABLE, UNAVAILABLE)
- Default system rights

### 6. Create Storage Link

```bash
php artisan storage:link
```

This creates a symbolic link from `public/storage` to `storage/app/public` for file access.

### 7. Compile Assets

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 8. Start Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

### 9. Run Scheduler (for rent reminders)

Run Laravel's scheduler in development so automated reminders execute:

```bash
php artisan schedule:work
```

In production, configure cron:

```bash
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

## Database Schema

### Users Table
- **id**: Primary key
- **id_number**: National ID (unique)
- **first_name**: User's first name
- **last_name**: User's last name
- **other_name**: Optional additional name
- **email**: Email address (unique)
- **password**: Hashed password
- **gender**: Male/Female
- **status_id**: Foreign key to statuses
- **system_role_id**: Foreign key to system_roles

### Houses Table
- **id**: Primary key
- **landlord_id**: Owner user ID (landlord)
- **house_number**: Property number
- **rent**: Monthly rent amount
- **house_type**: Type of property (e.g., Bungalow, Apartment)
- **file_path**: Image storage path
- **file_name**: Original filename
- **description**: Property description

### Estates Table
- **id**: Primary key
- **name**: Estate name
- **location**: Physical location
- **house_id**: Foreign key to houses

### House Bookings Table
- **id**: Primary key
- **user_id**: Foreign key to users (tenant)
- **house_id**: Foreign key to houses
- **booking_id**: Foreign key to bookings (status)

## Default Users

After migration, create admin user via tinker:

```bash
php artisan tinker
```

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'id_number' => '12345678',
    'first_name' => 'Admin',
    'last_name' => 'User',
    'email' => 'admin@estate.com',
    'password' => Hash::make('password'),
    'gender' => 'Male',
    'status_id' => 1,
    'system_role_id' => 1,  // Administrator
]);
```

## User Roles & Permissions

### Administrator
- Full system access
- User management (create, edit, delete users)
- House management (all operations)
- Estate management (all operations)
- View all bookings
- System configuration

### Landlord
- Manage only their own properties
- Add/edit/delete only their own houses
- Create/edit estates only for their own houses
- View bookings for their own houses

### Tenant
- View available properties only
- Book houses
- View and manage their own bookings
- Update profile

## Key Laravel Features Used

### Models & Relationships
- Eloquent ORM for database operations
- Relationships: HasMany, BelongsTo
- Model accessors and mutators
- Query scopes

### Security Features
- CSRF protection (automatic in forms)
- SQL injection protection (via prepared statements)
- Password hashing (bcrypt)
- Input validation
- XSS protection
- Mass assignment protection

### File Uploads
- Validated file uploads
- Secure storage in `storage/app/public`
- File size and type validation
- Unique filename generation

## Development Guidelines

### Creating a New Feature

1. **Create Migration**
   ```bash
   php artisan make:migration create_feature_table
   ```

2. **Create Model**
   ```bash
   php artisan make:model Feature -m
   ```

3. **Create Controller**
   ```bash
   php artisan make:controller FeatureController --resource
   ```

4. **Add Routes** in `routes/web.php`:
   ```php
   Route::resource('features', FeatureController::class);
   ```

5. **Create Views** in `resources/views/features/`

### Running Tests

```bash
php artisan test
```

### Security Scanning

Run the PHP dependency vulnerability audit locally:

```bash
composer run security:scan
```

GitHub CI security scanning is configured in `.github/workflows/security-scan.yml` and includes:
- Composer dependency audit
- NPM dependency audit
- Semgrep static security analysis with SARIF upload
- Gitleaks secret scanning

### Code Style

This project follows PSR-12 coding standards. Run PHP CS Fixer:

```bash
./vendor/bin/pint
```

## API Endpoints

Routes are defined in `routes/api.php`:

- `POST /api/auth/login` (returns API token)
- `GET /api/houses`
- `GET /api/houses/{house}`
- `GET /api/bookings` (requires `Authorization: Bearer <token>`)
- `POST /api/bookings` (requires `Authorization: Bearer <token>`)
- `POST /api/payments` (requires `Authorization: Bearer <token>`)

Sample login request:

```bash
curl -X POST http://localhost:8000/api/auth/login \
   -H "Accept: application/json" \
   -H "Content-Type: application/json" \
   -d '{"email":"tenant@example.com","password":"password"}'
```

## What Else Should Be Added Next

1. Authorization Policies:
Define Laravel Policies for `House`, `Estate`, and `HouseBooking` to centralize ownership checks.

2. Fine-grained Rights Integration:
Use `system_rights` as active route/action permissions (not only role groups).

3. Business Constraints:
Prevent double-active bookings for the same house with DB-level constraints and transactional checks.

4. Test Coverage:
Add tests for API token auth, payments, maintenance workflows, and tenant portal flows.

5. Operational Hardening:
Add audit logs, webhook verification for payment callbacks, and optional soft deletes for critical records.

## Deployment

### Production Checklist

1. Set environment to production:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

2. Optimize application:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   composer install --optimize-autoloader --no-dev
   ```

3. Set proper permissions:
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

4. Configure web server (Apache/Nginx)
5. Set up SSL certificate
6. Configure database backups
7. Set up monitoring and logging

### Server Requirements

- PHP >= 8.2
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Migration from Legacy System

### Data Migration Steps

1. Export data from old database:
   ```bash
   mysqldump -u root -p rentals > old_data.sql
   ```

2. Create migration script to transform old data format to new schema

3. Import transformed data:
   ```bash
   php artisan db:seed --class=LegacyDataSeeder
   ```

### Key Changes from Legacy System

| Legacy | Laravel |
|--------|---------|
| Plain PHP | Laravel Framework |
| Procedural code | Object-Oriented (MVC) |
| Manual SQL queries | Eloquent ORM |
| No CSRF protection | Built-in CSRF |
| Session-based auth | Laravel Authentication |
| Mixed HTML/PHP | Blade Templates |
| Manual validation | Form Request Validation |
| Direct file uploads | Laravel Storage |

## Troubleshooting

### Common Issues

**Permission Denied Error**
```bash
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
```

**Database Connection Error**
- Verify credentials in `.env`
- Ensure database exists
- Check MySQL/PostgreSQL is running

**Class Not Found**
```bash
composer dump-autoload
```

**Vite Manifest Not Found**
```bash
npm run dev
```

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Security

If you discover any security-related issues, please email jumwa@outlook.com instead of using the issue tracker.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Credits

**Developer**: Jezrel Jumwa  
**Email**: jumwa@outlook.com  
**LinkedIn**: [https://www.linkedin.com/in/jezrel-jumwa-a20448117](https://www.linkedin.com/in/jezrel-jumwa-a20448117)

## Changelog

### Version 2.0.0 (Laravel Rewrite)
- Complete rewrite using Laravel 12
- Modern MVC architecture
- Enhanced security features
- Improved database design
- Role-based access control
- Responsive UI
- File upload system
- Comprehensive documentation

### Version 1.0.0 (Legacy)
- Original PHP implementation
- Basic CRUD operations
- Simple authentication
- File uploads

## Feature Checklist

- [x] REST API for mobile app integration
- [x] Payment processing module
- [x] Automated rent reminders
- [x] Maintenance request system
- [x] Document management
- [x] Analytics dashboard
- [x] Email notifications
- [x] SMS integration abstraction
- [x] Multi-language support
- [x] Advanced reporting
- [x] Tenant portal
- [x] Online payment gateway abstraction

## Support

For support, email jumwa22@gmail.com or create an issue in the repository.

---

**Built with ❤️ using Laravel**
