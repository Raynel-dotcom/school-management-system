# School Management System

A web-based School Management System built with **Laravel 12**, **Tailwind CSS**, and **Spatie Laravel-Permission**.

---

## 🚀 Getting Started (Contributor Setup Guide)

When you clone this repository, you must set up your local environment before running the application. Follow the step-by-step instructions below.

### Prerequisites

Ensure you have the following installed on your machine:
- **PHP >= 8.2** (with `pdo_sqlite` or `pdo_mysql` enabled)
- **Composer** ([Download](https://getcomposer.org/))
- **Node.js & npm** ([Download](https://nodejs.org/))
- **Git**

---

### Step-by-Step Installation

#### 1. Clone the repository
```bash
git clone https://github.com/Raynel-dotcom/school-management-system.git
cd school-management-system
```

#### 2. Install PHP dependencies
```bash
composer install
```

#### 3. Set up the Environment Configuration
Copy the sample `.env.example` file to create your `.env` file:

- **Windows (PowerShell):**
  ```powershell
  Copy-Item .env.example .env
  ```
- **Windows (CMD):**
  ```cmd
  copy .env.example .env
  ```
- **macOS / Linux:**
  ```bash
  cp .env.example .env
  ```

#### 4. Generate the Application Encryption Key
```bash
php artisan key:generate
```

#### 5. Set Up the Database & Seed Data
By default, the project uses SQLite for zero-configuration local setup.
Run migrations and database seeders:
```bash
php artisan migrate --seed
```
> **Note:** If the terminal asks: `Database file does not exist, would you like to create it? (yes/no)`, type **`yes`**.

#### 6. Install Frontend Assets & Build
Install Node dependencies and compile Tailwind CSS:
```bash
npm install
npm run build
```

#### 7. Start the Local Server
```bash
php artisan serve
```
Open your browser and navigate to: **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 👥 Seeded Test Accounts

The seeder creates predefined users with assigned roles. All accounts use the default password: **`password123`**

| Role | Name | Email | Password |
| :--- | :--- | :--- | :--- |
| **Administrator** | System Administrator | `admin@school.ac.ug` | `password123` |
| **Lecturer** | Dr. John Smith | `dr.smith@school.ac.ug` | `password123` |
| **Lecturer** | Prof. Sarah Mukasa | `prof.mukasa@school.ac.ug` | `password123` |
| **Student** | Raynel Natukunda | `student@school.ac.ug` | `password123` |
| **Student** | Ivan Tumwine | `ivan@school.ac.ug` | `password123` |

---

## 🛠️ Development & Asset Compilation

For live reload of CSS/JS changes while editing blade templates or styles, run:
```bash
npm run dev
```
In a separate terminal window, keep the Laravel server running:
```bash
php artisan serve
```

---

## ❓ Troubleshooting Common Setup Errors

* **Error: `No application encryption key has been specified`**
  * **Fix:** Run `php artisan key:generate`.
* **Error: `Failed to open stream: .../vendor/autoload.php`**
  * **Fix:** Run `composer install`.
* **Error: `Vite manifest not found` (or broken CSS/styling)**
  * **Fix:** Run `npm install && npm run build`.
* **Error: `could not find driver (SQL: ...)`**
  * **Fix:** Enable `extension=pdo_sqlite` or `extension=pdo_mysql` in your `php.ini` file.
