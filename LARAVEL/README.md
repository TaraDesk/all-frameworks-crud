# Laravel Framework 

This project is the **Laravel** implementation of a basic CRUD application for the all-frameworks-crud collection. In addition to CRUD operations, the project also includes a basic authentication system (login/register) and file upload functionality, offering a complete foundation for typical web applications.

## Requirements

- PHP >= 8.2
- Laravel 12
- Composer
- MySQL / SQLite / PostgreSQL

## Installation

### 1. Clone the Main Repository and Navigate to the Laravel Subproject

```bash
git clone https://github.com/TaraDesk/all-frameworks-crud.git
cd all-frameworks-crud/laravel
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment

Copy the example environment file:

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Setup Database

Create the database, then run:

```bash
php artisan migrate
```

### 6. Link Storage for Public Access

```bash
php artisan storage:link
```

### 7. Run the Application

```bash
php artisan serve
```
Once the server starts, click the link shown in your terminal (usually http://localhost:8000) to open the application in your browser.

## Project Structure

| Path                    | Description                              |
| ----------------------- | ---------------------------------------- |
| `routes/web.php`        | Defines all web routes                   |
| `app/Http/Controllers/` | Handles controller logic for each entity |
| `app/Models/`           | Eloquent models                          |
| `resources/views/`      | Blade templates for UI                   |
| `app/Observers/`        | Model observers               |
| `app/Http/Middleware/`  | Custom middleware            |
| `storage/app/public/`   | Stores uploaded files                    |

## Features & Concepts Implemented

| Concept             | Description                                                                 |
|---------------------|-----------------------------------------------------------------------------|
| **Routing**         | Routes are defined in `web.php` using Laravel’s standard route methods      |
| **Middleware**      | Custom middleware added to align with patterns used in other frameworks     |
| **Observer**        | Implements model observers for lifecycle event handling                     |
| **Validation**      | Input validation handled via `$request->validate()`                         |
| **Error Handling**  | Displays validation errors and flash messages in Blade views                |
| **Database Access** | Interacts with the database using Eloquent ORM                              |
| **Authentication**  | Implements basic login and registration with a custom auth setup            |
| **File Upload**     | Supports file uploads with validation and storage via Laravel’s filesystem  |

## Available Routes

| Method  | URI               | Description                                        |
|---------|-------------------|----------------------------------------------------|
| GET     | `/`               | Entrance page (login/register)                    |
| POST    | `/login`          | Process login                                     |
| POST    | `/register`       | Process registration                              |
| GET     | `/tools`          | List all tools created by the authenticated user  |
| POST    | `/tools`          | Create a new tool                                 |
| GET     | `/tools/{slug}`   | View a specific tool                              |
| PUT     | `/tools/{slug}`   | Update the specified tool                         |
| DELETE  | `/tools/{slug}`   | Delete the specified tool                         |
| GET     | `/profile`        | Show the user's profile                           |
| PUT     | `/profile`        | Update the user's profile                         |
| DELETE  | `/profile`        | Delete the user's account                         |
| POST    | `/logout`         | Log out the authenticated user                   |

## License

This project is licensed under the MIT License.

## Part of

**[`all-frameworks-crud`](https://github.com/TaraDesk/all-frameworks-crud)** – a multi-framework learning project showing how CRUD patterns work across languages.
