Car4Sure

Car4Sure is a Laravel and Vue.js-based web application designed to manage and track vehicle insurance policies. This project provides a backend API built with Laravel and a frontend interface using Vue.js.
## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Additional Information](#additional-information)
- [Troubleshooting](#troubleshooting)
- [License](#license)

---

## Prerequisites

Before setting up the project locally, ensure you have the following installed on your system:

- **Composer** (for Laravel dependencies): [Get Composer](https://getcomposer.org/)
- **Laravel** (latest version recommended): [Get Laravel](https://laravel.com/docs/installation)
- **Node.js and npm** (for Vue.js dependencies): [Get Node.js and npm](https://nodejs.org/)
- **PrimeVue** (for Vue UI components)
- **MariaDB** (for database setup): [Get MariaDB](https://mariadb.org/download/)

> **Note**: This project also uses **Tailwind CSS** and **DaisyUI** for styling.

Installation

Follow these steps to install and set up the Car4Sure project:

    Clone the Repository
  

git clone https://github.com/yourusername/car4sure.git
cd car4sure

Backend Setup (Laravel)

Navigate to the backend directory:


cd backend

    Install Laravel dependencies:


composer install

Copy the .env.example file to .env:



cp .env.example .env

Generate an application key:



    php artisan key:generate

Frontend Setup (Vue.js)

Navigate to the frontend directory:



cd ../frontend

    Install Node.js dependencies:


        npm install

        Configure the frontend environment settings if necessary by creating a .env file in the frontend directory (not required in this setup unless there are specific frontend settings).

Database Setup

    Setting Up MariaDB Database

        Start your MariaDB server. You can follow the official MariaDB guide if you're unsure.

        Connect to your MariaDB server and create a new database and user:


CREATE DATABASE car4sure_db;
CREATE USER 'car4sure_user'@'127.0.0.1' IDENTIFIED BY 'carforsure';
GRANT ALL PRIVILEGES ON car4sure_db.* TO 'car4sure_user'@'127.0.0.1';
FLUSH PRIVILEGES;

Update the .env file in the backend directory with your database settings (these should already be configured if you used the sample .env):

plaintext

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=car4sure_db
    DB_USERNAME=car4sure_user
    DB_PASSWORD=carforsure

Running Migrations and Seeders

    Run migrations to set up the database tables:


php artisan migrate

(Optional) Seed the database with sample data:


        php artisan db:seed

Running the Application

Once everything is set up, follow these steps to run the backend and frontend:

    Run Laravel Backend

    In the backend directory, start the Laravel development server:


php artisan serve

This will start the backend API on http://localhost:8000 (or a different port if specified).

Run Vue.js Frontend

In the frontend directory, run the frontend development server:

    npm run dev

    This will start the Vue.js application 

Additional Information

    Tailwind CSS and DaisyUI: This project uses Tailwind CSS for styling with DaisyUI as a plugin. Configuration can be modified in the tailwind.config.js file located in the frontend directory.

    API Endpoints: You can access the API endpoints at the backend URL (e.g., http://localhost:8000/api/...). Refer to the project documentation for specific endpoints.

    Frontend Routing: The Vue application uses Vue Router for page navigation. Routes are defined in the frontend/src/router directory.

Troubleshooting

If you encounter issues during setup, check the following:

    Ensure all prerequisites are installed and properly configured.
    Verify your .env file configuration matches your local MariaDB setup.
    Ensure MariaDB is running and accessible from your development environment.

License

This project is licensed under the MIT License. See the LICENSE file for more information.

