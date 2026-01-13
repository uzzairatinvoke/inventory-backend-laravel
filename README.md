# Document App Backend (Laravel)

A Laravel 12 REST API backend application for managing products with authentication using Laravel Sanctum.

## Prerequisites

Before you begin, ensure you have the following installed on your system:

- **PHP** >= 8.2
- **Composer** (PHP dependency manager)
- **Node.js** >= 18.x and **npm** (for frontend assets)
- **SQLite** (default database) or **MySQL/PostgreSQL** (optional)
- **Git**

### Checking Your Environment

```bash
# Check PHP version
php -v

# Check Composer
composer --version

# Check Node.js and npm
node -v
npm -v
```

## Installation Steps

### 1. Clone the Repository

```bash
git clone git@github.com:uzzairatinvoke/inventory-backend-laravel.git
cd inventory-backend-laravel
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Environment Configuration

Copy the environment example file and create your `.env` file:

```bash
cp .env.example .env
```

If `.env.example` doesn't exist, create a `.env` file manually with the following content:

```env
APP_NAME=Inventory
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite

# If using Postgresql instead of SQLite:
# DB_CONNECTION=pgsql
# DB_HOST=127.0.0.1
# DB_PORT=5432
# DB_DATABASE=your_database_name
# DB_USERNAME=your_database_user
# DB_PASSWORD=your_database_password

SESSION_DRIVER=database
SESSION_LIFETIME=120

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

SANCTUM_STATEFUL_DOMAINS=localhost:8000
SESSION_DOMAIN=localhost
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Database Setup

#### Option A: Using SQLite (Default)

Create the SQLite database file:

```bash
touch database/database.sqlite
```

Or ensure the path in your `.env` file points to the correct location:

```env
DB_DATABASE=/absolute/path/to/inventory-backend-laravel/database/database.sqlite
```

#### Option B: Using MySQL/PostgreSQL

1. Create a database in your MySQL/PostgreSQL server
2. Update your `.env` file with the database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 6. Run Database Migrations

```bash
php artisan migrate
```

### 7. Seed the Database (Optional)

If you have seeders, run:

```bash
php artisan db:seed
```

### 8. Install Frontend Dependencies

```bash
npm install
```

### 9. Build Frontend Assets

```bash
npm run build
```

## Running the Application

### Development Mode

You can run the development server using the convenience script:

```bash
composer run dev
```

This will start:
- Laravel development server (http://localhost:8000)
- Queue worker
- Log viewer (Pail)
- Vite dev server

Alternatively, run them separately:

```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start Vite dev server (if needed)
npm run dev
```

### Production Mode

```bash
# Build assets
npm run build

# Start server
php artisan serve
```

## API Endpoints

The API is available at: `http://localhost:8000/api/v1/`

### Authentication Endpoints

- `POST /api/v1/login` - Login and get authentication token
  - Body: `{ "email": "user@example.com", "password": "password" }`
  
- `POST /api/v1/logout` - Logout (requires authentication)
  - Headers: `Authorization: Bearer {token}`

### Product Endpoints (All require authentication)

- `GET /api/v1/products` - List all products
- `GET /api/v1/products/{id}` - Get a specific product
- `POST /api/v1/products` - Create a new product
- `PATCH /api/v1/products/{id}` - Update a product
- `DELETE /api/v1/products/{id}` - Delete a product

All authenticated endpoints require the following header:
```
Authorization: Bearer {your_token_here}
```

## Testing

Run the test suite:

```bash
composer run test
# or
php artisan test
```

## Code Quality

Laravel Pint is included for code formatting:

```bash
./vendor/bin/pint
```

## Troubleshooting

### Permission Issues

If you encounter permission issues with storage or cache:

```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

### Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Database Issues

If you need to reset your database:

```bash
php artisan migrate:fresh
# or with seeders
php artisan migrate:fresh --seed
```

### Port Already in Use

If port 8000 is already in use, specify a different port:

```bash
php artisan serve --port=8001
```

Remember to update the frontend API URL accordingly.

## Project Structure

```
inventory-backend-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # API controllers
│   │   ├── Requests/       # Form request validation
│   │   └── Resources/      # API resources
│   ├── Models/             # Eloquent models
│   ├── Policies/           # Authorization policies
│   └── Providers/          # Service providers
├── config/                 # Configuration files
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── routes/
│   └── api.php            # API routes
├── storage/               # File storage
└── tests/                 # Test files
```

## Key Dependencies

- **Laravel Framework** ^12.0
- **Laravel Sanctum** ^4.0 - API authentication
- **Spatie Laravel Permission** ^6.24 - Role and permission management
- **Pest** ^3.8 - Testing framework

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Sanctum Documentation](https://laravel.com/docs/sanctum)
- [Spatie Laravel Permission Documentation](https://spatie.be/docs/laravel-permission)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
