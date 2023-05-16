# Kangaroo Tracker

## Getting Started

### Prerequisites

* [Composer](https://getcomposer.org/)
* [Node.js](https://nodejs.org)

### Installation

1. Install composer dependencies ```composer install```
2. Install npm dependencies ```npm install```
3. Compile front end assets and scripts ```npm run dev```
4. Setup ```.env``` file
5. Generate an app encryption key ```php artisan key:generate```
6. Migrate database ```php artisan migrate```

### For Docker

1. Go to ```docker-config``` directory
2. Execute ```docker-compose up -d```
3. Set ```DB_HOST``` to ```mysql``` in ```.env``` file.
3. Set ```DB_PASSWORD``` to ```root``` in ```.env``` file.
4. And then proceed to installation.

## User Credential
Username: admin\
Password: Sys@dm1n

## Technologies used
* [Laravel 9](https://laravel.com/)
* [MySQL](https://www.mysql.com/)

## Developed and tested in:
* [Docker](https://www.docker.com/)
