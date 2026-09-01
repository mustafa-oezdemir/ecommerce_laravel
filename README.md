<div align="center">

# Laravel Ecommerce

### A modern, full-stack ecommerce starter built with Laravel, Inertia and React.

[![Laravel](https://img.shields.io/badge/Laravel-12.52.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![React](https://img.shields.io/badge/React-19.2.8-20232A?style=for-the-badge&logo=react&logoColor=61DAFB)](https://react.dev)
[![TypeScript](https://img.shields.io/badge/TypeScript-5.9.3-3178C6?style=for-the-badge&logo=typescript&logoColor=white)](https://www.typescriptlang.org)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.3.3-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)

[Features](#-features) · [Screenshots](#-screenshots) · [Installation](#-installation) · [Project structure](#-project-structure)

</div>

---

## About the project

Laravel Ecommerce combines a customer-facing storefront, account management and a complete administration experience in one codebase. It includes a stock-aware checkout, tier-based pricing, product management, order workflows and interactive analytics.

The backend is powered by Laravel 12, while Inertia.js connects it to a type-safe React 19 interface—without the overhead of maintaining a separate API application.

## ✨ Features

### Storefront

- Responsive landing page and product catalogue
- Category, brand, model and price filters
- Detailed product pages with image galleries and variants
- Persistent shopping cart
- Stock-aware checkout and order confirmation emails
- Customer-specific bronze, silver, gold and platinum pricing

### Customer account

- Secure registration, sign-in and password recovery
- Email verification and two-factor authentication
- Order history
- Address book with default-address support
- Payment method management
- Profile, password and appearance settings

### Administration

- Analytics dashboard with KPIs, category breakdowns and time-series charts
- Category and product CRUD workflows
- Product image uploads, soft deletion, restoration and permanent deletion
- Order overview, order details and status management
- Email notifications for placed, shipped and cancelled orders
- Gate- and policy-based authorization

## 🧰 Tech stack

| Layer          | Technology                                        |
| -------------- | ------------------------------------------------- |
| Backend        | PHP 8.2+, Laravel 12.52.0                         |
| Frontend       | React 19.2.8, TypeScript 5.9.3, Inertia.js 2.3.27 |
| Styling        | Tailwind CSS 4.3.3, Radix UI, Headless UI         |
| Charts         | Recharts 3.10.1                                   |
| Authentication | Laravel Fortify 1.34.1                            |
| Routing        | Laravel Wayfinder 0.1.13                          |
| Database       | SQLite or MySQL                                   |
| Tooling        | Vite 7, ESLint, Prettier, Laravel Pint            |
| Testing        | PHPUnit 11                                        |

### Build & development

<p align="center">
  <img alt="PHP 8.2 or newer" src="https://img.shields.io/badge/PHP-%E2%89%A5_8.2-777BB4?style=for-the-badge&logo=php&logoColor=white">
  <img alt="Composer 2" src="https://img.shields.io/badge/Composer-v2-168AFE?style=for-the-badge&logo=composer&logoColor=white">
  <img alt="Node.js 20 or newer" src="https://img.shields.io/badge/Node.js-%E2%89%A5_20-5FA04E?style=for-the-badge&logo=nodedotjs&logoColor=white">
  <img alt="npm" src="https://img.shields.io/badge/npm-current-CB3837?style=for-the-badge&logo=npm&logoColor=white">
  <img alt="Vite 7.3.6" src="https://img.shields.io/badge/Vite-v7.3.6-646CFF?style=for-the-badge&logo=vite&logoColor=white">
  <img alt="Docker optional" src="https://img.shields.io/badge/Docker-optional-2496ED?style=for-the-badge&logo=docker&logoColor=white">
</p>

## 📸 Screenshots

<table>
  <tr>
    <td width="50%"><img src="public/screenshots/cart/home.png" alt="Storefront home page"></td>
    <td width="50%"><img src="public/screenshots/cart/shop.png" alt="Product catalogue"></td>
  </tr>
  <tr>
    <td align="center"><strong>Storefront</strong></td>
    <td align="center"><strong>Product catalogue</strong></td>
  </tr>
  <tr>
    <td width="50%"><img src="public/screenshots/cart/area1.png" alt="Shopping cart"></td>
    <td width="50%"><img src="public/screenshots/cart/dashboard.png" alt="Admin analytics dashboard"></td>
  </tr>
  <tr>
    <td align="center"><strong>Shopping cart</strong></td>
    <td align="center"><strong>Analytics dashboard</strong></td>
  </tr>
</table>

<details>
<summary><strong>View email previews</strong></summary>
<br>

| Order placed                                                | Order shipped                                                 | Order cancelled                                                   |
| ----------------------------------------------------------- | ------------------------------------------------------------- | ----------------------------------------------------------------- |
| ![Order confirmation](public/screenshots/cart/mailhog2.png) | ![Shipping notification](public/screenshots/cart/shipped.png) | ![Cancellation notification](public/screenshots/cart/mailhog.png) |

</details>

## 🚀 Installation

### Prerequisites

- PHP 8.2 or newer with the required Laravel extensions
- [Composer](https://getcomposer.org)
- Node.js 20 or newer and npm
- SQLite (quickest option) or MySQL

### 1. Clone and install

```bash
git clone https://github.com/mustafa-oezdemir/ecommerce_laravel.git
cd ecommerce_laravel
composer install
npm install
```

### 2. Create the environment file

macOS / Linux:

```bash
cp .env.example .env
touch database/database.sqlite
```

Windows PowerShell:

```powershell
Copy-Item .env.example .env
New-Item database/database.sqlite -ItemType File
```

Then generate the application key:

```bash
php artisan key:generate
```

The example environment uses SQLite by default. To use MySQL, update `DB_CONNECTION` and the other `DB_*` values in `.env`.

### 3. Configure an administrator

Add one or more comma-separated addresses to `.env` before seeding:

```env
ADMIN_EMAILS=admin@example.com
```

### 4. Prepare the database

```bash
php artisan migrate --seed
php artisan storage:link
```

Seeded administrator credentials:

```text
Email:    admin@example.com
Password: password
```

> The administrator is only created when its address is present in `ADMIN_EMAILS`. Change the default password immediately outside local development.

### 5. Start developing

```bash
composer run dev
```

Open **http://localhost:8000**. The development command starts the Laravel server, queue listener, log viewer and Vite development server together.

## ✉️ Local email testing

The default `log` mailer writes messages to the application log. For a visual inbox, start [MailHog](https://github.com/mailhog/MailHog):

```bash
docker run --rm -p 1025:1025 -p 8025:8025 mailhog/mailhog
```

Update `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

Apply the change and open the inbox at **http://localhost:8025**:

```bash
php artisan config:clear
```

## 🗺️ Application routes

| Area           | Routes                                                                                    | Access                 |
| -------------- | ----------------------------------------------------------------------------------------- | ---------------------- |
| Store          | `/`, `/shop`, `/shop/{product}`, `/cart`                                                  | Public                 |
| Dashboard      | `/dashboard`                                                                              | Verified customer      |
| Account        | `/account/orders`, `/account/addresses`, `/account/payment-methods`                       | Verified customer      |
| Administration | `/admin/overview`, `/admin/categories`, `/admin/products`, `/admin/orders`                | Administrator          |
| Settings       | `/settings/profile`, `/settings/password`, `/settings/appearance`, `/settings/two-factor` | Authenticated customer |

## 🗂️ Project structure

```text
app/
├── Http/Controllers/       HTTP and Inertia controllers
├── Http/Requests/          Validation and authorization
├── Models/                 Eloquent domain models
├── Policies/               Resource authorization
└── Services/               Pricing, analytics and storage logic
database/
├── factories/              Test-data factories
├── migrations/             Database schema
└── seeders/                Demo catalogue and accounts
resources/js/
├── components/             Shared React and UI components
├── hooks/                  Reusable client-side behavior
├── layouts/                Application and marketing shells
└── pages/                  Inertia pages
routes/                     Store, account, admin and settings routes
tests/Feature/              Application-level test suite
```

## 🧪 Quality checks

```bash
# Run the PHP test suite
php artisan test

# Check PHP formatting
composer run test:lint

# Lint and type-check the frontend
npm run lint
npm run types

# Verify formatting without changing files
npm run format:check

# Create a production build
npm run build
```

## 📄 License

This project is open-source software distributed under the MIT license.

---

<div align="center">
Built with Laravel, React and a fondness for well-designed commerce experiences.
</div>
