<div align="center">

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
| Database       | SQLite or MySQL 8.4                               |
| Local services | Docker Compose, MailHog                           |
| Tooling        | Vite 7, ESLint, Prettier, Laravel Pint            |
| Testing        | PHPUnit 11                                        |

### Build & development

<p align="center">
  <img alt="PHP 8.2 or newer" src="https://img.shields.io/badge/PHP-%E2%89%A5_8.2-777BB4?style=for-the-badge&logo=php&logoColor=white">
  <img alt="Composer 2" src="https://img.shields.io/badge/Composer-v2-168AFE?style=for-the-badge&logo=composer&logoColor=white">
  <img alt="Node.js 20 or newer" src="https://img.shields.io/badge/Node.js-%E2%89%A5_20-5FA04E?style=for-the-badge&logo=nodedotjs&logoColor=white">
  <img alt="npm" src="https://img.shields.io/badge/npm-current-CB3837?style=for-the-badge&logo=npm&logoColor=white">
  <img alt="Vite 7.3.6" src="https://img.shields.io/badge/Vite-v7.3.6-646CFF?style=for-the-badge&logo=vite&logoColor=white">
  <img alt="Docker Compose" src="https://img.shields.io/badge/Docker-Compose-2496ED?style=for-the-badge&logo=docker&logoColor=white">
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

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) with Docker Compose
- Git

PHP, Composer, Node.js, MySQL and MailHog are provided by the containers; no local language runtime is required.

### 1. Clone the project

```bash
git clone https://github.com/mustafa-oezdemir/ecommerce_laravel.git
cd ecommerce_laravel
```

### 2. Create the Docker environment

macOS / Linux:

```bash
cp .env.docker.example .env
```

Windows PowerShell:

```powershell
Copy-Item .env.docker.example .env
```

Replace the example database passwords in `.env`, then build the application image and generate a unique Laravel key:

```bash
docker compose build app
docker compose run --rm --no-deps app php artisan key:generate --force
```

### 3. Start MySQL and prepare the database

```bash
docker compose up -d mysql mailhog
docker compose run --rm app php artisan migrate --seed
```

The seeder creates an administrator only when `ADMIN_EMAILS` contains its address:

```env
ADMIN_EMAILS=admin@example.com
```

Default local credentials:

```text
Email:    admin@example.com
Password: password
```

> Change the seeded password immediately outside local development.

### 4. Start the complete stack

```bash
docker compose up -d
```

| Service                 | URL / port            |
| ----------------------- | --------------------- |
| Laravel storefront      | http://localhost:8000 |
| Vite development server | http://localhost:5173 |
| MailHog inbox           | http://localhost:8025 |
| MySQL                   | `127.0.0.1:3306`      |

Follow logs or run Artisan commands without installing PHP locally:

```bash
docker compose logs -f app queue vite
docker compose run --rm test
docker compose exec app php artisan migrate
docker compose exec app php artisan tinker
```

Stop the stack while preserving MySQL data:

```bash
docker compose down
```

To also delete the local MySQL volume and start with an empty database, use `docker compose down --volumes`.

<details>
<summary><strong>Run without Docker</strong></summary>
<br>

Install PHP 8.2+, Composer, Node.js 20+ and SQLite or MySQL. Then run:

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
composer run dev
```

</details>

## ✉️ Local email testing

MailHog is included in the Compose stack. Laravel sends local mail to `mailhog:1025`, and the browser inbox is available at **http://localhost:8025**. No SMTP credentials are required locally.

```bash
docker compose logs -f mailhog
```

## 🔐 Environment and GitHub secrets

`.env.docker.example` is safe to commit and documents every Docker setting. The real `.env`, production variants, private keys, certificates and Docker secret files are ignored by Git.

Use GitHub **Secrets** for sensitive values:

| Secret                  | Purpose                                                                            |
| ----------------------- | ---------------------------------------------------------------------------------- |
| `APP_KEY`               | Production Laravel encryption key generated with `php artisan key:generate --show` |
| `CI_DB_PASSWORD`        | MySQL user password used by the Laravel workflow                                   |
| `CI_DB_ROOT_PASSWORD`   | MySQL root password used by the Laravel workflow                                   |
| `DB_PASSWORD`           | Production database password                                                       |
| `MAIL_PASSWORD`         | Production SMTP password; MailHog does not need one                                |
| `AWS_ACCESS_KEY_ID`     | Optional object-storage access key                                                 |
| `AWS_SECRET_ACCESS_KEY` | Optional object-storage secret key                                                 |

Use GitHub **Variables** for non-sensitive configuration:

| Variable         | Example                    |
| ---------------- | -------------------------- |
| `CI_DB_DATABASE` | `ecommerce_test`           |
| `CI_DB_USERNAME` | `laravel`                  |
| `APP_URL`        | `https://shop.example.com` |
| `ADMIN_EMAILS`   | `admin@example.com`        |

The CI workflow has safe ephemeral fallbacks, so pull requests from forks continue to run. Production values should never reuse the local placeholders from `.env.docker.example`.

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
