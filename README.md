# Employee Management System

A Laravel-based employee management application for handling workforce records, attendance, leave, reports, notifications, and communication in a single internal system.

## Overview

This project is designed for organizations that need a simple but complete employee administration workflow. It supports:

- employee management
- attendance monitoring
- leave request processing
- role-based access control
- dashboard summaries
- reports and analytics
- announcements and notifications
- activity tracking

## Features

### Admin features
- manage employees, departments, positions, and roles
- review and approve leave requests
- track attendance records
- view dashboard statistics
- generate overview reports
- access activity logs
- publish announcements
- manage notification visibility

### Employee features
- view personal dashboard
- submit leave requests
- check attendance status
- update profile information
- upload profile picture
- view notifications and announcements

## User Roles

- Admin
- Employee

Role checks are enforced through middleware and Laravel gates so that admin-only features remain protected.

## Modules

- Employees
- Departments
- Positions
- Roles
- Attendance
- Leave Types
- Leave Requests
- Dashboard
- Reports
- Activity Logs
- Announcements
- Notifications

## Tech Stack

- Laravel 13
- PHP 8+
- MySQL
- Blade templates
- Pest for testing
- Vite for frontend assets

## Requirements

- PHP 8.2 or newer
- Composer
- Node.js and npm
- MySQL or a compatible database

## Local Setup

1. Clone the repository.
2. Install PHP dependencies:

```bash
composer install
```

3. Install frontend dependencies:

```bash
npm install
```

4. Copy the environment file:

```bash
cp .env.example .env
```

5. Configure the database connection in `.env`.

6. Run database migrations:

```bash
php artisan migrate
```

7. Start the app:

```bash
php artisan serve
```

## Running Tests

Run the full test suite:

```bash
php artisan test
```

Run a condensed version:

```bash
php artisan test --compact
```

## Project Structure

```text
app/
  Http/
    Controllers/
    Middleware/
    Requests/
  Models/
  Policies/
  Providers/
config/
database/
  migrations/
  seeders/
routes/
resources/
  views/
public/
storage/
tests/
```

## Security Notes

The application uses:

- authentication for protected routes
- admin middleware for restricted pages
- Laravel gates for permission checks
- ownership checks for notifications and sensitive actions

This keeps employee data and admin functions protected.

## Usage Flow

1. Log in with an admin or employee account.
2. Use the dashboard to view system or personal metrics.
3. Manage workforce data from the admin modules.
4. Create and review attendance and leave records.
5. Monitor notifications, announcements, and reports.
6. Review audit history through the activity logs.

## Status

The system has reached a completed feature set with automated test coverage for the core workflows.

## License

This project is intended for internal project use and is not a public package by default.
