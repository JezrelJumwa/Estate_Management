# Quick Start Guide - Estate Management System

## 🚀 Get Started in 5 Minutes

### Prerequisites Check
```bash
php --version   # Should be >= 8.2
composer --version
node --version  # Should be >= 18
npm --version
mysql --version # or postgres
```

### Installation Commands

```bash
# 1. Navigate to project
cd /Users/jezreljumwa/IdeaProjects/Personal/Estate_Management_Laravel

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies
npm install

# 4. Copy environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Create database
mysql -u root -p -e "CREATE DATABASE estate_management;"

# 7. Update .env with your database credentials
# DB_DATABASE=estate_management
# DB_USERNAME=root
# DB_PASSWORD=your_password

# 8. Run migrations
php artisan migrate

# 9. Create storage link
php artisan storage:link

# 10. Compile assets
npm run dev

# 11. Create admin user
php artisan tinker
```

In Tinker:
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
    'system_role_id' => 1,
]);
exit
```

```bash
# 12. Start server
php artisan serve
```

Visit: `http://localhost:8000`

Login with:
- Email: `admin@estate.com`
- Password: `password`

## 📊 Project Structure

```
Estate_Management_Laravel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── UserController.php
│   │       ├── HouseController.php
│   │       ├── EstateController.php
│   │       └── HouseBookingController.php
│   └── Models/
│       ├── User.php
│       ├── House.php
│       ├── Estate.php
│       ├── Booking.php
│       ├── HouseBooking.php
│       ├── Status.php
│       ├── SystemRole.php
│       └── SystemRight.php
├── database/
│   └── migrations/
│       ├── 2024_01_01_000001_create_statuses_table.php
│       ├── 2024_01_01_000002_create_system_roles_table.php
│       ├── 2024_01_01_000003_update_users_table.php
│       ├── 2024_01_01_000004_create_houses_table.php
│       ├── 2024_01_01_000005_create_estates_table.php
│       ├── 2024_01_01_000006_create_bookings_table.php
│       ├── 2024_01_01_000007_create_house_bookings_table.php
│       └── 2024_01_01_000008_create_system_rights_table.php
├── resources/
│   └── views/
├── routes/
│   └── web.php
└── public/
    └── storage/ (symlinked)
```

## 🔑 Key Features Implemented

✅ Database schema with proper relationships  
✅ Eloquent models with methods  
✅ Role-based access control structure  
✅ User authentication foundation  
✅ File upload support for house images  
✅ Resource controllers for CRUD operations  
✅ Security features (CSRF, SQL injection protection, password hashing)  

## 📝 Next Steps

To complete the application, you need to:

1. **Install Authentication** (optional - Laravel Breeze):
   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install blade
   npm install && npm run dev
   php artisan migrate
   ```

2. **Implement Controllers**: Add logic to UserController, HouseController, EstateController, HouseBookingController

3. **Create Blade Views**: Build UI in `resources/views/`

4. **Add Routes**: Define routes in `routes/web.php`

5. **Implement Middleware**: Add role-based authorization

6. **Test the Application**: Create and run tests

## 🛠️ Development Commands

```bash
# Run development server
php artisan serve

# Watch for asset changes
npm run dev

# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Fresh migration with seed
php artisan migrate:fresh --seed

# Create new controller
php artisan make:controller NameController --resource

# Create new model
php artisan make:model ModelName -m

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run tests
php artisan test

# Code formatting
./vendor/bin/pint
```

## 🐛 Common Issues

**Port already in use:**
```bash
php artisan serve --port=8001
```

**Storage permission issues:**
```bash
chmod -R 775 storage bootstrap/cache
```

**Database connection refused:**
- Check MySQL is running: `brew services list` (Mac) or `sudo service mysql status` (Linux)
- Verify credentials in `.env`

## 📚 Useful Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Eloquent ORM](https://laravel.com/docs/eloquent)
- [Laravel Blade Templates](https://laravel.com/docs/blade)
- [Laravel Authentication](https://laravel.com/docs/authentication)

## 🎯 Your Old vs New System

### Old System Issues Fixed:
❌ SQL injection vulnerabilities → ✅ Protected by Eloquent ORM  
❌ No CSRF protection → ✅ Built-in CSRF tokens  
❌ Plain passwords → ✅ Bcrypt hashing  
❌ No validation → ✅ Laravel validation rules  
❌ Procedural spaghetti code → ✅ Clean MVC architecture  
❌ Mixed HTML/PHP → ✅ Blade templates  
❌ Manual file handling → ✅ Laravel Storage  

## 💡 Tips

- Use `php artisan tinker` to interact with your database via CLI
- Use `php artisan route:list` to see all available routes
- Use `php artisan make:*` commands to scaffold quickly
- Keep `.env` file secure and never commit it to version control
- Use migrations for all database changes
- Follow PSR-12 coding standards

---

**Need Help?** Email: jumwa@outlook.com
