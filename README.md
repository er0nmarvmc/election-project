<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Election Results Management System</h1>
    <br>
</p>

# Election Results Management System

This is a specialized application built on the [Yii 2 Framework](https://www.yiiframework.com/) for managing and visualizing election results. The system provides insights into polling unit data and local government area (LGA) summed results.

## Features

- **Polling Unit Results**: View detailed results for individual polling units.
- **LGA Summed Results**: Access aggregated voting data for all polling units within a specific Local Government Area.
- **Add New Results**: A straightforward interface for entering new polling unit results for all parties.
- **Green & White Theme**: A clean, professional UI reflecting a national identity.
- **Login-Free Access**: The application is configured for open access to all result data.

## Local Hosting with ngrok

To share your local development server with the world using **ngrok**, follow these steps:

### 1. Start the Local Server
Start the built-in Yii development server on port 8080:

```bash
php yii serve --port=8080
```

### 2. Launch ngrok
In a new terminal window, start ngrok to tunnel your local server:

```bash
ngrok http 8080
```

### 3. Access the Site
ngrok will provide a public URL (e.g., `https://random-id.ngrok-free.app`). You can use this URL to access the application from any device with internet access.

## Database Setup

### 1. Configuration
Edit the file `config/db.php` with your local database credentials:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=bincomphptest',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

### 2. Schema
The system uses the `bincomphptest` database. You can find the SQL schema and initial data in `config/bincom_test.sql`.

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

---
*Built with Yii 2 Framework*
