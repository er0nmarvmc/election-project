<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Election Results Management System</h1>
    <br>
</p>

# Election Results Management System

This is a specialized application built on the [Yii 2 Framework](https://www.yiiframework.com/) for managing and visualizing election results. The system is designed to provide clear insights into polling unit data and local government area (LGA) summed results.

## Features

- **Polling Unit Results**: View detailed results for individual polling units.
- **LGA Summed Results**: Access aggregated voting data for all polling units within a specific Local Government Area.
- **Add New Results**: A secure and straightforward interface for entering new polling unit results for all parties.
- **Green & White Theme**: A clean, professional UI reflecting a national identity.
- **Login-Free Access**: The application is configured for open access to all result data.

## Directory Structure

```text
assets/             contains assets definition
commands/           contains console commands (controllers)
config/             contains application configurations (db.php, web.php, etc.)
controllers/        contains Web controller classes (ElectionController, SiteController)
models/             contains model classes (AnnouncedPuResults, PollingUnit, etc.)
views/              contains view files for the Web application
web/                contains the entry script and Web resources (site.css)
```

## Setup Instructions

### 1. Database Configuration
Edit the file `config/db.php` with your database credentials:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=127.0.0.1;dbname=bincomphptest',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

The system uses the `bincomphptest` database. You can find the schema in `config/bincom_test.sql`.

### 2. Local Server
You can start the built-in Yii development server using:

```bash
php yii serve --port=8080
```

Access the application at `http://localhost:8080`.

### 3. Deployment with Docker (Render)
This project includes a `Dockerfile` and `apache.conf` for easy deployment on platforms like Render.

**Environment Variables:**
- `DB_DSN`: The database DSN (e.g., `mysql:host=your-db-host;dbname=your-db-name`)
- `DB_USERNAME`: Database username
- `DB_PASSWORD`: Database password

## Key Components

- **ElectionController**: Handles the logic for displaying polling unit results, LGA summaries, and the creation of new results.
- **SiteController**: Manages the homepage and generic site actions.
- **Models**: Includes `PollingUnit`, `AnnouncedPuResults`, `Lga`, `Ward`, and `Party` to interact with the election database.
- **Theme**: Custom green and white styling is defined in `web/css/site.css`.

---
*Built with Yii 2 Framework*
