# Estate Management System (Laravel)

A modern, secure Estate Management System built with Laravel 12, providing comprehensive property and tenant management capabilities.

## Overview

This is a complete rewrite of the legacy PHP Estate Management system, now using the Laravel framework to provide enhanced security, maintainability, and modern development practices.

### Key Features

- **User Management**: Registration and management of users with role-based access (Administrator, Landlord, Tenant)
- **House Management**: Add, edit, delete, and view properties with image uploads
- **Estate Management**: Manage multiple estates and their associated properties
- **Booking System**: Track house availability and tenant bookings
- **Role-Based Access Control**: Different permissions for Administrators, Landlords, and Tenants
- **Secure Authentication**: Laravel's built-in authentication with password hashing
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
cd /Users/jezreljumwa/IdeaProjects/Personal/Estate_Management_Laravel
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
- Manage their own properties
- Add/edit/delete houses
- View bookings for their properties
- Limited user management (tenants only)

### Tenant
- View available properties
- Book houses
- View their own bookings
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

### Code Style

This project follows PSR-12 coding standards. Run PHP CS Fixer:

```bash
./vendor/bin/pint
```

## API Endpoints (Future Enhancement)

Routes are defined in `routes/web.php`:

- **Auth**: `/login`, `/register`, `/logout`
- **Dashboard**: `/dashboard`
- **Users**: `/users` (CRUD operations)
- **Houses**: `/houses` (CRUD operations)
- **Estates**: `/estates` (CRUD operations)
- **Bookings**: `/bookings` (CRUD operations)

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

**Mix Manifest Not Found**
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

## Future Enhancements

- [ ] REST API for mobile app integration
- [ ] Payment processing integration
- [ ] Automated rent reminders
- [ ] Maintenance request system
- [ ] Document management
- [ ] Analytics dashboard
- [ ] Email notifications
- [ ] SMS integration
- [ ] Multi-language support
- [ ] Advanced reporting
- [ ] Tenant portal
- [ ] Online payment gateway

## Support

For support, email jumwa22@gmail.com or create an issue in the repository.

---

**Built with ❤️ using Laravel**
