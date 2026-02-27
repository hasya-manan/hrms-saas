# HRMS SaaS Application

This is a multi-tenant Human Resource Management System (HRMS) built using the Laravel framework, featuring Vite for bundling, Vue 3 for the frontend, and Javascript for type safety.

but still in early development
## 🚀 Technologies Used

* **Framework:** Laravel (PHP)
* **Frontend:** Vue 3 (Composition API)
* **Language:** Javascript
* **Authentication/Scaffolding:** Laravel Breeze (Vue Inertia stack)
* **Build Tool:** Vite
* **Styling:** Tailwind CSS

## 📋 Features

* **Multi-tenancy:** Isolated data per company/tenant.
* **RBAC:** Role-Based Access Control (Admin, HR, Employee).
* **Employee Management:** Onboarding and profiles.
* **Payroll System:** Automated payroll calculation.
* **Leave Management:** Request and approval workflow.

## 🛠️ Installation & Setup

### Prerequisites
* PHP >= 8.2
* Composer
* Node.js & NPM

### Setup Instructions

1.  **Clone the repository:**
    ```bash
    git clone <your-repository-url>
    cd hrms-saas
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install Node dependencies:**
    ```bash
    npm install --legacy-peer-deps
    ```

4.  **Configure Environment:**
    Copy the `.env.example` file to `.env` and configure your database settings:
    ```bash
    cp .env.example .env
    ```

5.  **Generate App Key:**
    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations:**
    ```bash
    php artisan migrate
    ```

7.  **Run Development Server:**
    Open two terminals:

    *Terminal 1 (Backend):*
    ```bash
    php artisan serve
    ```

    *Terminal 2 (Frontend):*
    ```bash
    npm run dev
    ```

## 📝 License

This project is proprietary software.