# AccStore

A comprehensive account marketplace platform built with Laravel, designed for buying and selling digital accounts (Netflix, Spotify, Udemy, Duolingo, Canva, etc.).

## 📋 About

AccStore is a full-featured e-commerce platform that enables users to browse, purchase, and manage digital account listings. The platform includes a complete admin panel for managing accounts, categories, orders, and transactions, along with a RESTful API for integration with external systems.

## ✨ Features

### Core Functionality
- **Account Management**: Create, update, and manage account listings with details like username, password, price, and status
- **Category System**: Organize accounts into categories with images and descriptions
- **Order Processing**: Complete order management system with status tracking (pending, paid, failed, cancelled)
- **Transaction Handling**: Payment gateway integration with transaction tracking
- **User Management**: User registration, authentication, and profile management
- **Admin Dashboard**: Comprehensive admin panel for managing all aspects of the platform

### Technical Features
- **RESTful API**: Full API endpoints for all resources with Laravel Sanctum authentication
- **Repository Pattern**: Clean architecture with repository pattern implementation
- **Soft Deletes**: Data preservation with soft delete functionality
- **Image Upload**: Category image management
- **Status Management**: Track account availability (available/sold) and order statuses
- **Payment Integration**: Support for multiple payment gateways

## 🛠️ Tech Stack

- **Framework**: Laravel 12
- **PHP**: 8.2+
- **Authentication**: Laravel Sanctum
- **Database**: SQLite (configurable to MySQL/PostgreSQL)
- **Frontend**: Blade Templates
- **API**: RESTful API with JSON responses

## 📁 Project Structure

```
AccStore/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/        # Admin panel controllers
│   │   │   ├── Api/          # API controllers
│   │   │   └── Web/          # Web controllers
│   │   └── Resources/        # API resources
│   ├── Models/               # Eloquent models
│   ├── Repositories/         # Repository pattern implementation
│   └── Traits/               # Reusable traits
├── database/
│   ├── migrations/           # Database migrations
│   ├── factories/           # Model factories
│   └── seeders/             # Database seeders
├── resources/
│   └── views/
│       ├── admin/           # Admin panel views
│       └── layouts/         # Layout templates
└── routes/
    ├── api.php              # API routes
    └── web.php              # Web routes
```

## 🗄️ Database Schema

### Main Models
- **Users**: User accounts and authentication
- **Categories**: Account categories with images
- **Accounts**: Account listings (username, password, price, status)
- **Orders**: Customer orders with status tracking
- **OrderItems**: Items within orders
- **Transactions**: Payment transactions with gateway support

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/AccStore.git
   cd AccStore
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Start the development server**
   ```bash
   php artisan serve
   npm run dev
   ```

## 📡 API Endpoints

### Authentication
- `POST /api/register` - User registration
- `POST /api/login` - User login
- `POST /api/logout` - User logout (requires authentication)

### Resources
- `GET/POST/PUT/DELETE /api/users` - User management
- `GET/POST/PUT/DELETE /api/accounts` - Account management
- `GET/POST/PUT/DELETE /api/categories` - Category management
- `GET/POST/PUT/DELETE /api/orders` - Order management
- `GET/POST/PUT/DELETE /api/order-items` - Order item management
- `GET/POST/PUT/DELETE /api/transactions` - Transaction management

All API endpoints return JSON responses and use Laravel Sanctum for authentication.

## 🔐 Admin Panel

Access the admin panel at `/admin` with the following features:
- Dashboard overview
- User management
- Account management (CRUD operations)
- Category management with image upload
- Order management and tracking
- Transaction monitoring

## 🎯 Key Features Implemented

- ✅ User authentication and authorization
- ✅ Account listing and management
- ✅ Category system with image support
- ✅ Order processing workflow
- ✅ Transaction tracking
- ✅ Admin dashboard
- ✅ RESTful API
- ✅ Repository pattern architecture
- ✅ Soft deletes for data preservation
- ✅ Status management (accounts, orders, transactions)

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📧 Contact

For questions or support, please open an issue on GitHub.

---

Built with ❤️ using Laravel
