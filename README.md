
# HR API

## Overview

This project is an HR API built using Laravel

## Project Setup

Follow these steps to set up the project.

### 1. Install Project Dependencies

To install the required vendor dependencies, run:

```bash
composer install
```

This will install all the required PHP dependencies for the Laravel project.

### 2. Set Up the Database

Run the following command to create the necessary database tables:

```bash
php artisan migrate
```

Make sure your `.env` file is properly configured with the database connection settings.

### 3. Set Up the Queue

run the following commands:

```bash
php artisan queue:table
```

This command will generate a migration for the queue tables. Afterward, run:

```bash
php artisan migrate
```

This will apply the migration and create the required queue tables in your database.

To start processing queued jobs, run:

```bash
php artisan queue:listen
```

This command will start listening for new jobs and process them as they are added to the queue.

---

## Development Notes

- **Brevo** is used for email delivery, and emails are processed in the background using Laravel’s queue system.
