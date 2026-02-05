# HajjFlow Backend

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql)](https://mysql.com)
[![AWS S3](https://img.shields.io/badge/AWS%20S3-Storage-FF9900?style=for-the-badge&logo=amazon-s3)](https://aws.amazon.com/s3/)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

A comprehensive **SaaS platform** for Hajj and Umrah pilgrimage management, built with modern technologies to streamline operations for travel agencies and pilgrimage organizers.

## 🌟 Overview

HajjFlow is an enterprise-grade SaaS solution designed to digitize and automate the entire Hajj and Umrah pilgrimage management process. From initial customer registration to post-pilgrimage accounting, HajjFlow provides agencies with powerful tools to manage their operations efficiently and compliantly.

### Key Features

- **🏢 Multi-Agency Support**: Complete isolation between agencies with secure data management
- **👥 Pilgrim Management**: Comprehensive pilgrim registration, tracking, and documentation
- **👨‍💼 Group Leader Management**: Assign and manage group leaders for organized pilgrimages
- **📦 Package Management**: Create and manage Hajj/Umrah packages with pricing and itineraries
- **💰 Financial Management**: Complete accounting system with transactions, bills, and reporting
- **📊 Analytics Dashboard**: Real-time insights and performance metrics
- **🌐 Multi-Language Support**: English, Bangla, and Arabic language support
- **📱 RESTful API**: Modern API architecture for seamless integrations
- **🔒 Enterprise Security**: Laravel Sanctum authentication with role-based access control

## 🏗️ Architecture

### Tech Stack

**Backend:**

- **Framework**: Laravel 12.x (PHP 8.2+)
- **Database**: MySQL 8.0+
- **Authentication**: Laravel Sanctum
- **File Storage**: AWS S3
- **Monitoring**: Laravel Telescope
- **Testing**: Pest PHP
- **Code Quality**: Laravel Pint

**Frontend:**

- **Framework**: React 19 with Vite
- **Styling**: Tailwind CSS with Radix UI components
- **State Management**: TanStack Query
- **Forms**: React Hook Form with Zod validation
- **Internationalization**: i18next
- **Charts**: Recharts

### System Architecture

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   React SPA     │    │   Laravel API   │    │     MySQL DB    │
│                 │◄──►│                 │◄──►│                 │
│ • Dashboard     │    │ • REST API      │    │ • Agencies      │
│ • Pilgrim Mgmt  │    │ • Authentication │    │ • Pilgrims      │
│ • Analytics     │    │ • Business Logic │    │ • Transactions  │
│ • Reports       │    │ • File Upload    │    │ • Packages      │
└─────────────────┘    └─────────────────┘    └─────────────────┘
                              │
                              ▼
                    ┌─────────────────┐
                    │     AWS S3      │
                    │ • File Storage  │
                    │ • Documents     │
                    │ • Images        │
                    └─────────────────┘
```

## 🚀 Quick Start

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- MySQL 8.0+
- AWS S3 account (for file storage)

### Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/sehabkhanzehad/hajjflow-backend.git
   cd hajjflow-backend
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Environment setup**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure environment variables**

   ```env
   APP_NAME="HajjFlow"
   APP_ENV=production
   APP_URL=https://your-domain.com

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=hajjflow
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_db_password

   AWS_ACCESS_KEY_ID=your_aws_key
   AWS_SECRET_ACCESS_KEY=your_aws_secret
   AWS_DEFAULT_REGION=us-east-1
   AWS_BUCKET=your_bucket_name
   ```

5. **Database setup**

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Storage setup**

   ```bash
   php artisan storage:link
   ```

7. **Start the application**

   ```bash
   php artisan serve
   ```

## 📊 Core Modules

### 🏢 Agency Management

- Multi-tenant architecture with complete data isolation
- Agency profile management with branding
- Team member management and permissions
- License and compliance tracking

### 👥 Pilgrim Lifecycle Management

- Pre-registration and registration workflows
- Document management (passports, visas, etc.)
- Package assignment and itinerary management
- Health and emergency contact tracking

### 👨‍💼 Group Leader Operations

- Group leader assignment and management
- Performance tracking and analytics
- Communication tools and reporting
- Transfer and reassignment capabilities

### 💰 Financial Operations

- Transaction management and reconciliation
- Bill generation and payment tracking
- Profit/loss analysis by package/agency
- Financial reporting and compliance

### 📊 Business Intelligence

- Real-time dashboard with KPIs
- Performance analytics for agencies and packages
- Revenue and expense tracking
- Custom reporting capabilities

## 🔧 API Documentation

The API follows RESTful conventions and includes comprehensive documentation. Key endpoints:

```
POST   /api/auth/login          - User authentication
GET    /api/analytics/dashboard - Dashboard analytics
GET    /api/pilgrims            - Pilgrim management
POST   /api/packages            - Package creation
GET    /api/transactions        - Financial transactions
PUT    /api/user/profile        - User profile updates
```

### Authentication

Uses Laravel Sanctum for secure API authentication with token-based access.

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test suite
php artisan test --testsuite=Feature
```

## 🚀 Deployment

### Production Checklist

- [ ] Environment variables configured
- [ ] Database migrations run
- [ ] Storage permissions set
- [ ] SSL certificate installed
- [ ] Queue workers configured
- [ ] Monitoring tools set up

### Recommended Hosting

- **Web Server**: Nginx or Apache
- **Database**: AWS RDS MySQL
- **File Storage**: AWS S3
- **Cache**: Redis
- **Queue**: AWS SQS or Redis

## 🤝 Contributing

We welcome contributions! Please see our [Contributing Guidelines](CONTRIBUTING.md) for details.

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

For support and questions:

- **Email**: <support@hajjflow.com>
- **Documentation**: [docs.hajjflow.com](https://docs.hajjflow.com)
- **Issues**: [GitHub Issues](https://github.com/sehabkhanzehad/hajjflow-backend/issues)

## 🙏 Acknowledgments

- Laravel Framework for the robust backend foundation
- React ecosystem for the modern frontend experience
- AWS for reliable cloud infrastructure
- The Laravel and React communities for continuous inspiration

---

**Built with ❤️ for the global Muslim community**

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
